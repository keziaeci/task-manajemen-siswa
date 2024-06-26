<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>data murid</h1>
        {{-- <button type="button" class="btn btn-primary">Tambah</button> --}}
        <!-- Button trigger modal -->
        <button type="button" id="btnCreate" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Tambah
        </button>


        <div class="input-group my-3">
            <input type="text" class="form-control" id="search" placeholder="kelas" aria-label="Recipient's username"
                aria-describedby="buttonSearch">
            <button class="btn btn-outline-secondary" type="submit" id="buttonSearch">Cari</button>
        </div>

        <!-- Modal Create-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah murid baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formCreate">
                            {{-- <div class="mb-3">
                                <label for="name" class="form-label">Grade</label>
                                <input type="text" class="form-control" required id="grade" name="grade"
                                    aria-describedby="emailHelp">
                            </div> --}}
                            <div class="mb-3" id="mbName">
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
                        <form action="" id="formEdit">
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
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($murids as $murid)
                <tr id="tr">
                    <th scope="row">{{ $loop->iteration }}</th>
                    {{-- <td>{{ $murid->grade }}</td> --}}
                    <td>{{ $murid->name }}</td>
                    <td>{{ $murid->kelas->name }}</td>
                    <td>
                        <button id="btnDelete" data-id="{{ $murid->id }}" class="btn btn-danger">Delete</button>
                        <button id="btnEdit" data-id="{{ $murid->id }}" class="btn btn-warning" data-bs-toggle="modal"
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
            let append = false
            $("body").on('click','#btnCreate', function () {
                if (!append) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('murid-create') }}",
                        dataType: "JSON",
                        success: function (response) {
                            console.log(response)
                            let kelases = response.kelases
                            let options = '';
                            kelases.forEach(kelas => {
                                options += `<option value="${kelas.id}">${kelas.name}</option>`;
                            });
        
                            $('#formCreate').append(`
                            <div class="mb-3">
                                        <label for="kelas" class="form-label">Kelas</label>
                                        <select class="form-select" name="kelas_id" id="kelas_id" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            ${options}
                                        </select>
                            </div>
                            `);
                            append = true
                        },
                        error: function (response) { 
                            console.log(response)
                        }
                    });
                }

            });
            
        });

        // $(document).ready(function () {
            $('#buttonSearch').click(function (e) { 
                e.preventDefault();
                let search = $('#search').val();
                console.log(search)
                $.ajax({
                    type: "GET",
                    url: `/murids/search?search=${search}`,
                    dataType: "JSON",
                    success: function (response) {
                        // console.log(response.murids)
                        let rows = '';
                        let murids = response.murids;
                        console.log(murids)

                        let i = 0
                        murids.forEach(murid => {
                            i++
                            rows += `
                                <tr>
                                    <td>${i}</td>
                                    <td>${murid.name}</td>
                                    <td>${murid.kelas.name}</td>
                                    <td>
                                        <button id="btnDelete" data-id="${murid.id}" class="btn btn-danger">Delete</button>
                                        <button id="btnEdit" data-id="${murid.id}" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit">Edit</button>
                                    </td>
                                    <!-- Add other data fields as needed -->
                                </tr>
                            `;
                        });

                        $('.table tbody').html(rows); 
                    }
                });
            });
        // });

        $(document).ready(function () {
            $("#submit").click(function (e) { 
                e.preventDefault();
                
                let name = $('#name').val();
                let kelas_id = $('#kelas_id').val();
                let token = $("meta[name='csrf-token']").attr('content');
    
                $.ajax({
                    type: "POST",
                    url: "{{ route('murid-store') }}",
                    data: {
                        "name": name,
                        "kelas_id": kelas_id,
                        "_token" : token
                    },
                    dataType: "JSON",
                    success: function (response) {
                        
                        $('#name').val('');
                        $('#kelas_id').val('');
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

            $(document).ready(function () {
                let append = false
                $('body').on('click','#btnEdit', function () {
                    if (!append) {
                        let murid_id = $(this).attr('data-id')
                        
                        $.ajax({
                            type: "GET",
                            url: `/murid/${murid_id}`,
                            dataType: "JSON",
                            success: function (response) {  
                                console.log(response)
                                $('#id').val(response.murid.id);
                                $('#name-edit').val(response.murid.name);
                                let kelases = response.kelases
                                let options = '';
                                kelases.forEach(kelas => {
                                    let selected = kelas.id === response.murid.kelas_id ? 'selected' : '';
                                    options += `<option value="${kelas.id}" ${selected}>${kelas.name}</option>`;
                                });
        
                                $('#formEdit').append(`
                                    <div class="mb-3">
                                        <label for="kelas" class="form-label">Kelas</label>
                                        <select class="form-select" name="kelas_id_edit" id="kelas_id_edit" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            ${options}
                                        </select>
                                    </div>
                                `);
                                append = true
                                $('#modalEdit').show();
                            },
                        });
                    }

                });
            });

            $('#update').click(function (e) { 
                e.preventDefault();
                let murid_id = $("#id").val();
                let token = $("meta[name='csrf-token']").attr('content');
                let name = $('#name-edit').val();
                let kelas_id = $('#kelas_id_edit').val();

                $.ajax({
                    type: "PATCH",
                    url: `/murid/${murid_id}`,
                    data: {
                        "name" : name,
                        "kelas_id": kelas_id,
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
                let murid_id = $(this).attr('data-id')
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
                            url: `/murid/${murid_id}`,
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