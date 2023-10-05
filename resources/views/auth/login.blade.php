<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>MHF || Login</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <!-- CSRF TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicons -->
        <link href="{{ asset('assets_dashboard/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('assets_dashboard/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">
        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets_dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets_dashboard/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets_dashboard/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets_dashboard/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        @stack('css')
        <!-- Template Main CSS File -->
        <link href="{{ asset('assets_dashboard/css/style.css') }}" rel="stylesheet">
    </head>


</head>
<style>
section{
    min-height: 100vh;

    /* padding: 1rem 9% 2rem; */
}
.header{
    position: fixed;
    top: 0;
    left: 0;
    height: 15vh;
    width: 100%;
    display: flex;
    justify-content: space-between;
    z-index: 100;
}
.header .logo-header{
    margin-bottom: 10px;
    padding-top: 10px;
    width: 200px;

}
.header .login-input{
    padding: 15px;
    justify-content: space-between;

}
.login {
    background: url('assets_dashboard/img/mhf.jpg');
    object-fit: cover;
    background-size: cover;

}
.login .login-content img{
    padding-top: 80px;
    width: 35%;

}

.login-input input{
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.375rem;
    margin-bottom: 20px;
}
.login-input .label-form{
    font-weight: bold;
    font-size: 1.2rem;
}
.login-input .button{
    margin-left: 115px;
    /* float: right; */
}
.login-img img{
    width: 100%;
    height: 100vh;
    object-fit: cover;
}


.header.sticky{
    border-bottom: .1rem solid rgba(0, 0, 0, .2);
}
.logo{
    font-size: 1.5rem;
    color: var(--text-color);
    font-weight: 600;
    cursor: default;
}
@media (max-width: 1200px) {

    .header .logo-header{
        width: 30%;
    }
    .header .login-input{
        font-size: 2rem;
        /* margin-left: 450px; */
    }
    .header .login-input input{
        height: 50%;
        width: 200px;

    }
    .login .login-content img{
        padding-top: 160px;
        width: 55%;
    }
}
@media (max-width: 991px) {

    .header .logo-header {
        width: 30%;
    }
    .login{
        padding-top: 195px;
    }
    .login-content img{
        width: 40%;
    }
    .login-input input{
        size: 2rem;

    }

}
@media (max-width: 768px)
{
    body{
        background: #ffd70b;
        /* margin: 0 4rem 0; */
    }
    .header{
        width: 100%;
        /* border: 2px solid red; */
    }
    .header .login-input{
        width: 100%;
    }
    .login-input .label-form{
        font-size: 1rem;
    }
    .header .login-input input{
        font-size: 20px;
        /* margin-right: 100px; */
    }
    .header .logo-header{
        margin-top: 20px;
        width: 100px;
        /* height: 50px; */
    }

    .login{
        background-size: 90%;
        background-repeat: no-repeat;
    }
    .login .login-content img{
        right: 200px;
    }


}
@media (max-width: 617px) {
    .header .logo-header{
        width: 50%
    }
    .header .login-input{
        width: 100%;
        left: 20px;
    }

    .header .login-input input{
        width: 50%;
        /* font-size: 20px; */
    }
    .login{
        bottom: 0;
        background-size: 50%;
        background-repeat: no-repeat;
    }
    .login{
        margin: 0;
    }
    .login .login-content img{
        width: 100%;
        top: 0;
    }
}
@media (max-width: 450px) {
    body{
        /* margin: 4rem; */
    }
    .header .logo-header{
        width: 45%
    }
    .login {
        margin: 0;
    }
    .login .login-input input{
        font-size: 0.5rem;
        width: 100%;
        margin: 0;
    }
    .login-input{
        width: auto;
        padding: 0;
        margin: 0;
        font-size: 1rem;
    }
    .login .login-content img{
        width: 100%;
        padding-top: 180px;
        height: 100%;
    }
    .login-input .label-form{
        font-size: 1rem;
    }

}
@media (max-width: 365px) {
    .header .logo-header{
        width: 28%;
        height: 90px;
    }

    .login .login-input .label-form{
        font-size: 10px;
    }
    .login-input .button {
        display: inline;
        font-size: 15px;

    }
    .logo{
        margin-top: 100px;
    }
    .login .login-content img{
        padding-top: 300px;
    }
}
</style>


<body>
    <header class="header">
        <img src="{{ asset('assets_dashboard/img/logo.jpg') }}" alt="" class="logo-header">
        <div class="login-input">
            <form action="{{ route('login') }}" method="POST">
                @csrf
            <label for="" class="label-form">Username : </label>
            <input type="text" name="username" placeholder="username" value="{{ old('username') }}">
            <label for="" class="label-form">Password : </label>
            <input type="password" name="password" placeholder="password" value="{{ old('password') }}">
            <div class="button">
                <button class="btn btn-dark btn-sm btn-register" type="submit">Masuk</button>
                {{-- <a href="{{ route('register') }}" class="btn btn-dark btn-sm btn-login">Daftar</a> --}}
                {{-- <a href="{{ route('password.request') }}" class="btn btn-dark btn-sm btn-forget-pw">Lupa Password?</a> --}}
                @error('username')
                    <p class="" style="color: black" >{{ $message }}</p>
                @enderror
            </div>
        </form>
        </div>
    </header>
    <section class="login">
        <div class="login-content">
            <img src="{{ asset('assets_dashboard/img/people.png') }}" alt="" >
        </div>
    </section>
</body>
</html>
