<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use ZipArchive;
use App\Imports\PengungsiImport;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;

class CadangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zip = new ZipArchive;

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $file_name = str_replace(config('backup.backup.name') . '/', '', $f);
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => $file_name,
                    'file_size' => $this->bytesToHuman($disk->size($f)),
                    'created_at' => Carbon::parse($disk->lastModified($f))->diffForHumans(),
                    // 'download_link' => action('Backend\BackupController@download', [$file_name]),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        $data = $this->paginate($backups, 5);
        $data->withPath('');
        return view('admin.cadang.index', compact('data'));
        // return view('admin.cadang.index');
    }

    public function paginate($items, $perPage = 4, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage;
        $itemstoshow = array_slice($items, $offset, $perPage);
        return new LengthAwarePaginator($itemstoshow, $total, $perPage);
    }

    /**
     * Convert bytes to human readable
     * @param $bytes
     * @return string
     */
    private function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Downloads a backup zip file.
     *
     * @param  int  $file_name
     * @return \Illuminate\Http\Response
     */
    public function download($file_name)
    {
        // Gate::authorize('cadang.download');
        // return "kamu";

        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        // echo $disk;
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                // "Content-Type" => $fs->getMimetype($file),
                // "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // Gate::authorize('app.backups.create');
        // start the backup process
        // Artisan::call('backup:run');

        $projectDir = substr(getcwd(), 0, strpos(getcwd(), '\public'));
        $command = 'cd /d ' . $projectDir . '&& php artisan backup:run --only-db';
        exec($command);
        Alert::success('Success', 'Data berhasil dicadangkan');

        // notify()->success('Backup Created Successfully.', 'Added');
        return back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $file = $request->file('file');

        // Excel::import(new ExcelImport, $file);
        // //
        // Alert::success('Success', 'Data berhasil dipulihkan');
        // return back();
        // // return back()->withStatus('Excel file succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    // public function destroy($id)
    // {
    //     //
    // }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function delete($id)
    {
        if (File::exists(public_path('../storage/app/Laravel/' . $id))) {
            File::delete(public_path('../storage/app/Laravel/' . $id));
            $success = true;
            $message = "Data berhasil dihapus";

        } else {
            $success = true;
            // dd('File does not exists.');
            $message = "Data berhasil dihapus";
            // $message = "Data gagal dihapus";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
        return back();
    }

}
