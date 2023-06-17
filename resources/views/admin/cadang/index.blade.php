@extends('admin.mainIndex')
@section('content')

<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cadangan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Cadangan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h3 class="card-title">Cadangan & pulihkan data</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <button onclick="event.preventDefault();
                          document.getElementById('new-backup-form').submit();" class="btn btn-success mb-2" style="font-size: 14px;">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fas fa-plus"></i>
                            </span>
                            {{ __('Cadangkan') }}
                        </button>
                        <form id="new-backup-form" action="{{ route('cadang.create') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama File</th>
                                    <th>Ukuran Data</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key=>$backup)
                                <tr>
                                    <td class="text-center text-muted">{{$data->firstItem() + $key  }}</td>
                                    <td class="text-center">
                                        <code>{{ $backup['file_name'] }}</code>
                                    </td>
                                    <td class="text-center">{{ $backup['file_size'] }}</td>
                                    <td class="text-center">{{ $backup['created_at'] }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('cadang.download',$backup['file_name']) }}"><i class="fas fa-download"></i>
                                            <span>Download</span>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $key }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $key }}" action="{{ route('cadang.destroy',$backup['file_name']) }}" method="POST" style="display: none;">
                                            @csrf()
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br />
                        {{ $data->links() }}
                        <br />



                    </div>

                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </div>
    <script>
        function deleteData(id) {
            Swal.fire({
                title: "Hapus?",
                icon: 'question',
                text: "Apakah Anda yakin?",
                type: "warning",
                showCancelButton: !0,
                cancelButtonText: "Batal!",
                confirmButtonText: "Iya, hapus!",
                reverseButtons: !0
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</section>

@endsection()