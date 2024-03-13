<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        type="text/css">
</head>

<body class="vh-100" style="background-color: #4CAF50;">
    @yield('main')




    <script src="{{ asset('ad/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('ad/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('ad/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('ad/js/app.min.js') }}"></script>


    @yield('customjs')
</body>
</html>