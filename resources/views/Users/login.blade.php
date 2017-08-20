@extends('layout')

@section('title_section', 'login page')

@section('style')
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Users/login.css">
@endsection

@section('content')

<div class="main-header row">
    <div class="col-xs-4">
        <h1 class="main-header__h1">Training App</h1>
    </div>
    <div class="col-xs-4">
    </div>
    <div class="col-xs-4">
    </div>
</div>
<div class="main-content">
    <div class="main-content__wrapper">
        <div id="box-login" class="box-login" data-function="box-login">
            <div class="box-login__logo">
                <div class="box-login__logo__logo-image"> </div>
                <!-- <h1>Erpot</h1> -->
            </div>
            <div class="box-login__form">
                <input type="email" name="email" placeholder="Enter your e-mail" class="box-login__form__input"><br>
                <input type="password" name="password" placeholder="Password" class="box-login__form__input"><br>
                <!--<div class="box-login__button-login" data-function="button-login" style=""></div>-->
                <div class="box-login__form__line-gray--down"></div>
                <button class="btn btn-block btn-danger" data-function="button-login">Login</button>
            </div>
            <div class="box-login__links">
                <div class="box-login__links__item"><a href="/passwordChange">Change your password to Training App.</a></div><br>
                <div class="box-login__links__item"><a href="/register">Do not have account to Training App? Register now.</a></div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="main-footer col">
    <div class="col-xs-12">
        <div class="main-footer__links">
            <div class="main-footer__links__item"><a href="#">Server & system</a></div>-->
            <!--<div class="main-footer__links__separator"></div>-->
            <!-- <div class="main-footer__links__item"><a href="#">Marenco Wiki</a></div> -->
            <!--<div class="main-footer__links__separator"></div>-->
            <!-- <div class="main-footer__links__item"><a href="mailto:developers@t-media.pl">Developer contact</a></div> -->
            <!--<div class="main-footer__links__separator"></div>-->
            <!-- <div class="main-footer__links__item">Copyright &copy <?= date("Y") ?> T-Media</div> -->
        <!-- </div> -->
    <!-- </div> -->
<!-- </div> -->
@endsection

@section('scripts')
<!-- JavaScript :: Custom scripts for module -->
    <script src="/js/Modules/Users/loginVC.js"></script>
@endsection
