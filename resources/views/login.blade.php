<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <form class="m-5" id="form">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" required id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" required id="password">
        </div>
        <p id="alert"></p>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>

    {{-- <script src="jquery-3.7.1.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function () {
            $('#submit').click(function (e) { 
                e.preventDefault();
                
                let username = $('#username').val();
                let password = $('#password').val();
                let token = $("meta[name='csrf-token']").attr('content');
                // console.log(token)

                $.ajax({
                    type: "POST",
                    url: "{{ route('auth') }}",
                    data: {
                        "username" : username,
                        "password" : password,
                        "_token": token
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.success) {
                            console.log('OK');
                            window.location.href = "{{ route('home') }}"
                        }
                        // else {
                        //     // console.log(response.success);
                        //     let alert = $("<p></p>").text('Login gagal!').addClass('red');
                        //     $('#form').append(alert);
                        // }
                        // console.log(response);
                    },
                    error: function (response) {
                        // let alert = $("<p></p>").text('Login gagal!')
                        $('#alert').text('Login Gagal!').css('color','red');
                        // $('#form').append(alert);
                        console.log(response)
                    }
                });
            });
        })
    </script>
</body>

</html>