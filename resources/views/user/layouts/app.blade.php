<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Houserenovation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="" crossorigin="">
    <style>
        #app .my-3 {
            margin-top: 2rem !important;
            margin-bottom: 2rem !important;
        }

        #app h4 {
            font-size: 1.2rem;
            margin-bottom: 1.2rem;
            margin-top: 1.2rem;
        }

        #app label {
            margin-right: 1.2rem;
        }

        #app label for {
            margin-bottom: 0.25rem;
            margin-top: 1.2rem;
        }

        .form-check-input[type=checkbox] {
            margin-top: 1.2rem;
        }

        #app button.btn.btn-primary.btn-sm {
            width: 120px;
            color: #ffff;
            font-weight: 500;
            background-color: #000;
            text-align: center;
        }

        #app .form-check-input[type=radio] {
            border-radius: 50%;
            margin-top: 1.2rem;
            margin-right: 0.25rem;
        }

        #app .form-check-input[type=checkbox] {
            border-radius: 0.25em;
            margin-top: 0rem;
        }

        #app .form-check-input[type=radio] {
            border-radius: 50%;
            margin-top: 0.25rem;
            margin-right: 0.25rem;
        }
    </style>
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity=""
        crossorigin="anonymous"></script>
</body>

</html>
