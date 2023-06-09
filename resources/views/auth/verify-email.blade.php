<!DOCTYPE html>
<html lang="en">
<style>
    body {
        background-image: url('http://minsu.edu.ph/template/images/slides/slides_2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top center;
        border-top-right-radius: 8px;
        border-top-left-radius: 8px;
        height: 100vh !important;

    }
</style>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-rjKzzx1VcPB+CGZvbtV/s8OfzX9XVIZ+OosyJ7V3A1e+Ja2sOKs1s4Zz0JQUd8l9A+DUJL0Tf1YjKlJ6xHYxkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-lm3X9D1b11mrU6dRyGp5+Z5oz5f5i5Z6iv2q3B1/c6dy1y6UfM6YRy6U/SiZPhKT05b0Nx0ZawELTxIzH9XQ2Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Welcome</title>
</head>

<body>

    <div class="container my-5 text-center">
        <img src="http://minsu.edu.ph/template/images/logo.png" alt="Logo" />
        <h3 class="my-3 text-white">Welcome to Mindoro State University</h3>
        <h1 class="my-3 text-white">MinSU-AlumConnect</h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
