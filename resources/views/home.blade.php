<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
        aria-controls="offcanvasExample">
        Sidebar
    </a>

    <div class="container">
        <h1>Selamat Datang</h1>
    </div>
    <div class="container">
        <h2>Siswa Kelas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($murids as $murid)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $murid->name }}</td>
                    <td>
                        {{ $murid->kelas->name }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Siswa Guru</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Guru</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($murids as $murid)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $murid->name }}</td>
                    <td>
                        <ul>
                            @foreach ($murid->gurus() as $guru)
                            <li>
                                {{ $guru->name}}
                            </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Sidebar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('murids') }}">Murid</a>
                </li>
                <li>
                    <a href="{{ route('gurus') }}">Guru</a>
                </li>
                <li>
                    <a href="{{ route('kelas') }}">Kelas</a>
                </li>
            </ul>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>