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
                        <h3 class="card-title">Cadangan data</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <button onclick="event.preventDefault();
                          document.getElementById('new-backup-form').submit();" class="btn btn-success mb-2" style="font-size: 14px;">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fas fa-plus"></i>
                            </span>
                            {{ __('Cadangkan (.sql)') }}
                        </button>

                        <!-- <button class="bx--btn bx--btn--primary" type="button" id="swal_upload">Apri</button> -->
                        <!-- <a href="#" class="btn btn-info mb-2 " data-toggle="modal" data-target="#upload" style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Pulihkan (.xlsx)
                        </a> -->
<!-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    @if (session()->has('failures'))

                        <table class="table table-danger">
                            <tr>
                                <th>Row</th>
                                <th>Attribute</th>
                                <th>Errors</th>
                                <th>Value</th>
                            </tr>

                            @foreach (session()->get('failures') as $validation)
                                <tr>
                                    <td>{{ $validation->row() }}</td>
                                    <td>{{ $validation->attribute() }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($validation->errors() as $e)
                                                <li>{{ $e }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        {{ $validation->values()[$validation->attribute()] }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    @endif -->
                       
                        <!-- <button onclick="event.preventDefault();
                          document.getElementById('pulihkan').submit();" class="btn btn-info mb-2" style="font-size: 14px;"
                          type="file">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fas fa-plus"></i>
                            </span>
                            {{ __('Pulihkan (.xlsx)') }}
                        </button> -->
                        <form id="new-backup-form" action="{{ route('cadang.create') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <!-- <form id="pulihkan" action="/users/import" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="file" name="file" />

                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                        </form> -->

                        <!-- <form id="new-backup-form" action="{{ route('cadang.create') }}" method="POST" style="display: none;">
                            @csrf
                        </form> -->

                       

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
                                    <?php
                                        $file_name = $backup['file_name'];
                                    ?>
                                    <td class="text-center text-muted">{{$data->firstItem() + $key  }}</td>
                                    <td class="text-center">
                                        <code><?php echo $file_name;?></code>
                                    </td>
                                    <td class="text-center">{{ $backup['file_size'] }}</td>
                                    <td class="text-center">{{ $backup['created_at'] }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('cadang.download',$backup['file_name']) }}"><i class="fas fa-download"></i>
                                            <span>Download (.sql)</span>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" title="Delete" onclick="deleteData('<?php echo $file_name;?>')">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                            </a>
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
    <!-- <script>
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
                    document.getElementById('delete-form-'+id).submit();
                }
                
            })
        }
    </script> -->

    <script type="text/javascript">
        function deleteData(id) {
            swal.fire({
                title: "Hapus?",
                icon: 'question',
                text: "Apakah Anda yakin?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Iya, hapus!",
                cancelButtonText: "Batal!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{url('cadang/delete')}}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Berhasil!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                swal.fire("Gagal!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>

    <script>

        $('#swal_upload').click(function() {
            Swal({
                title: 'Select a file',
                showCancelButton: true,
                confirmButtonText: 'Upload',
                input: 'file',
                onBeforeOpen: () => {
                    $(".swal2-file").change(function () {
                        var reader = new FileReader();
                        reader.readAsDataURL(this.files[0]);
                    });
                }
            }).then((file) => {
                if (file.value) {
                    var formData = new FormData();
                    var file = $('.swal2-file')[0].files[0];
                    formData.append("fileToUpload", file);
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        method: 'post',
                        url: '/file/upload',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (resp) {
                            Swal('Uploaded', 'Your file have been uploaded', 'success');
                        },
                        error: function() {
                            Swal({ type: 'error', title: 'Oops...', text: 'Something went wrong!' })
                        }
                    })
                }
            })
        })

    </script>
    

</section>

@endsection()