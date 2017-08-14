@extends('layout')

@section('title_section', 'users page')

@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Users/courses.css">
@endsection

@section('content')


<div class="main-header row">
    <div class="col-xs-4">
        <div class="main-header__h1" data-toggle="main-menu">Training App Users</div>
    </div>
    <div class="col-xs-4">
    </div>
    <div class="col-xs-4">
    </div>
</div> 
<div class="main-content">
    <div class="main-content__wrapper">      
        <div class="col-courses-list col">   
            <div class="col-courses-list-header">
                <div class="col-courses-list-header__h1">Courses</div>
            </div>
            <div class="col-courses-list-content">
                <div class="col-courses-list-list">
                    <div class="col-courses-list-list__item">NK</div>
                    <div class="col-courses-list-list__item">Auto CAD</div>
                    <div class="col-courses-list-list__item">MS Office Excell</div>
                    <div class="col-courses-list-list__item">MS Office Word</div>
                    <div class="col-courses-list-list__item">MS Office Power Point</div>
                    <div class="col-courses-list-list__item">MS Office Excell dcdssssasdasdasdasdasdasd</div>
                    <div class="col-courses-list-list__item">MS Office Excell</div>
                </div>
            </div>
            <div class="col-courses-list-footer">
                <div class="col-courses-list-footer__item">
                Groups footer
                </div>
            </div>
        </div>
        <div class="col-raports col">
            <div class="col-raports-header">
                <div class="col-raports-header__h1">T-Media Developer</div>
            </div>
            <div class="col-raports-search-bar">
                <div class="search-bar__search">
                    <input type="text" class="search-bar__search-input" name="search" placeholder="Search raport">
                </div>
            </div>
            <div class="col-raports-content">  
                <div class="raports-header">
                    <div class="raports-header__name col col-25">
                        Document name
                        <div class="raports-header__name__details">
                            Raports name
                        </div>
                    </div>
                    <div class="raports-header__description col col-30">
                        Description
                    </div>
                    <div class="raports-header__attachments col col-15">
                        Attached files
                    </div>
                    <div class="raports-header__modyfied col col-15">
                        Modyfied
                    </div>
                    <div class="raports-header__download col col-15">
                        Download
                    </div>                   
                </div>
                <div class="raports-list">
                    <div class="raports-list__item row height-70px">
                        <div class="raports-list__item__name col col-25">
                            Raport 1
                        </div>
                        <div class="raports-list__item__description col col-30">
                            Description 1
                        </div>
                        <div class="raports-list__item__attachments col col-15">
                            Attached files 1
                        </div>
                        <div class="raports-list__item__modyfied col col-15">
                            <div class="raports-list__item__modyfied__date">
                                2016-09-06
                            </div>
                            <div class="raports-list__item__modyfied__time">
                                12:33:21
                            </div>
                        </div>
                        <div class="raports-list__item__download col col-15">
                            Download 1
                        </div>      
                    </div>
                </div>
                <div class="raports-footer">
                    number of raports: 1
                </div>
            </div>
            <div class="col-raports-footer">
                <div class="col-raports-footer__item">Raports footer</div>
            </div>
        </div>
    </div>
</div>
<div class="main-footer col">
    <div class="col-xs-12">
        <div class="main-footer__links">
            <div class="main-footer__links__item"><a href="#">Server & system</a></div>
            <div class="main-footer__links__separator"></div>
            <div class="main-footer__links__item"><a href="#">Marenco Wiki</a></div>
            <div class="main-footer__links__separator"></div>
            <div class="main-footer__links__item"><a href="mailto:developers@t-media.pl">Developer contact</a></div>
            <div class="main-footer__links__separator"></div>
            <div class="main-footer__links__item">Copyright &copy <?= date("Y") ?> T-Media</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- JavaScript :: Custom scripts for module -->
    <script>
    $(document).ready(function(){
        var sessionHash = localStorage.getItem('sessionHash');
        console.info( sessionHash );
    });
    </script>
    <script src="/js/Modules/Users/coursesVC.js"></script>
@endsection