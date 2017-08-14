@extends('layout')

@section('title_section', 'register page')

@section('style')
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Users/register.css">
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
        <div id="box-register" class="box-register" data-function="box-register">
            <div class="box-register__logo">
                <div class="box-register__logo__logo-image"> </div>                  
            </div> 
            <div class="box-register__form">                    
                <input type="email" name="email" placeholder="Enter your e-mail" class="box-register__form__input"><br>
                <input type="text" name="username" placeholder="Username" class="box-register__form__input"><br>
                <input type="password" name="password" placeholder="Password" class="box-register__form__input"><br> 
                <input type="password" name="password_confirm" placeholder="Repeat password" class="box-register__form__input"><br> 
                <!--<div class="box-register__button-register" data-function="button-register" style=""></div>-->
                <div class="box-register__form__line-gray--down"></div>
                <button class="btn btn-block btn-danger" data-function="button-register">Register</button>
            </div>
            <div class="box-register__links">
                <!--<div class="box-register__links__item"><a href="/passwordChange">Change your password to Training App.</a></div><br>
                <div class="box-register__links__item"><a href="/register">Do not have account to Training App? Register now.</a></div>-->
            </div>
        </div>
    </div>
</div>       
<div class="main-footer col">
    <div class="col-xs-12">
        <div class="main-footer__links">
            <div class="main-footer__links__item"><a href="#">Server & system</a></div>
            <!--<div class="main-footer__links__separator"></div>-->
            <div class="main-footer__links__item"><a href="#">Marenco Wiki</a></div>
            <!--<div class="main-footer__links__separator"></div>-->
            <div class="main-footer__links__item"><a href="mailto:developers@t-media.pl">Developer contact</a></div>
            <!--<div class="main-footer__links__separator"></div>-->
            <div class="main-footer__links__item">Copyright &copy <?= date("Y") ?> T-Media</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- JavaScript :: Custom scripts for module -->
    <script src="/js/Modules/Users/registerVC.js"></script>
@endsection