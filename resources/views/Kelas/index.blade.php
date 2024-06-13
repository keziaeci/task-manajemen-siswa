<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>data kelas</h1>
        {{-- <button type="button" class="btn btn-primary">Tambah</button> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah
        </button>

        <!-- Modal Create-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah kelas baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            {{-- <div class="mb-3">
                                <label for="name" class="form-label">Grade</label>
                                <input type="text" class="form-control" required id="grade" name="grade"
                                    aria-describedby="emailHelp">
                            </div> --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" required id="name" name="name"
                                    aria-describedby="emailHelp">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit-->
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditLabel">Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <input type="hidden" id="id">
                            {{-- <div class="mb-3">
                                <label for="grade-edit" class="form-label">Grade</label>
                                <input type="text" class="form-control" required id="grade-edit" name="grade-edit"
                                    aria-describedby="emailHelp">
                            </div> --}}
                            <div class="mb-3">
                                <label for="name-edit" class="form-label">Name</label>
                                <input type="text" class="form-control" required id="name-edit" name="name-edit"
                                    aria-describedby="emailHelp">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="update" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    {{-- <th scope="col">Tingkat</th> --}}
                    <th scope="col">Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($kelases as $kelas)
                <tr id="tr">
                    <th scope="row">{{ $loop->iteration }}</th>
                    {{-- <td>{{ $kelas->grade }}</td> --}}
                    <td>{{ $kelas->name }}</td>
                    <td>
                        <button id="btnDelete" data-id="{{ $kelas->id }}" class="btn btn-danger">Delete</button>
                        <button id="btnEdit" data-id="{{ $kelas->id }}" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modalEdit">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function () {
            $("#submit").click(function (e) { 
                e.preventDefault();
                
                let name = $('#name').val();
                let token = $("meta[name='csrf-token']").attr('content');
    
                $.ajax({
                    type: "POST",
                    url: "{{ route('kelas-store') }}",
                    data: {
                        "name": name,
                        "_token" : token
                    },
                    dataType: "JSON",
                    success: function (response) {
                        
                        $('#name').val('');
                        $('#exampleModal').hide();

                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        setTimeout(() => {
                            window.location.reload()
                        }, 3500);
                        console.log(response.data)
                    },
                    error: function (response) {
                        console.log(response)
            
                        Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    }
                });
            });

            $('body').on('click','#btnEdit', function () {
                let kelas_id = $(this).attr('data-id')
                
                $.ajax({
                    type: "GET",
                    url: `/kelas/${kelas_id}`,
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response.data)
                        $('#id').val(response.data.id);
                        $('#name-edit').val(response.data.name);
                        $('#modalEdit').show();
                    },
                });
            });

            $('#update').click(function (e) { 
                e.preventDefault();
                let kelas_id = $("#id").val();
                let token = $("meta[name='csrf-token']").attr('content');
                let name = $('#name-edit').val();

                $.ajax({
                    type: "PATCH",
                    url: `/kelas/${kelas_id}`,
                    data: {
                        "name" : name,
                        "_token" : token
                    },
                    dataType: "JSON",
                    success: function (response) {
                        $('#name-edit').val('');
                        $('#modalEdit').hide();

                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        setTimeout(() => {
                            window.location.reload()
                        }, 3500);
                        console.log(response.data)
                    },
                    error: function (response) {
                        console.log(response)
            
                        Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    }
                });
            });

            $('body').on('click','#btnDelete', function () {
                let kelas_id = $(this).attr('data-id')
                let token = $("meta[name='csrf-token']").attr('content');
                
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "ingin menghapus data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'TIDAK',
                    confirmButtonText: 'YA, HAPUS!'
                }).then((result) => {
                    // execute when user confirmed
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: `/kelas/${kelas_id}`,
                            data:{
                                "_token" : token
                            },
                            success: function (response) {
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: `${response.message}`,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                setTimeout(() => {
                                    window.location.reload()
                                }, 3500);
                                console.log(response.data)
                            },  
                            error: function (response) {
                                console.log(response)
                    
                                Swal.fire({
                                    type: 'error',
                                    icon: 'error',
                                    title: `${response.message}`,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        });

                    }
                })
                
            });

        });
    </script>
</body>

</html>