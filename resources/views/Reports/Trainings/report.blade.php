@extends('layout')

@section('title_section', 'login page')

@section('style')
@endsection

@section('content')
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Reports/Reports.css?rev={{ \Config::get('revision.rev') }}">
<div class="main-module noselect">
    <div class="main-header">
        <div class="row">
            <header data-function="header-module">
                <div class="main-header__module-name">
                    <label class="main-header__h1" data-function="main-menu" data-toggle="main-menu">
                        Reports Trainings
                    </label>
                </div>
<!--                <div class="main-header__search">

                    <div class="search-bar">
                        <div class="search-bar__wrapper">
                            <input type="text" class="search-bar__input noselect" name="search" placeholder="Search Report" data-function="search" />
                        </div>
                    </div>

                </div>-->
                <div class="main-header__user-info user-info">
                    <div class="main-header__selector">
                    <select class="training-select">
                        <option value="c++">C++ Training</option>
                        <option value="html">HTML Training</option>
                        <option value="Design">Design Training</option>
                        <option value="Design">Business Course</option>
                        <option value="Design">Php Course</option>
                        <option value="Design">WebOps Course</option>
                        <option value="Design">Java Course</option>
                    </select>
                        
                    <div class="select-button">Select</div>
                    </div>
                    
                    
                    <div class="user-controls">
                    </div>
                </div>
            </header>
        </div>
    </div>
    <div class="chart-content">
        <div class="chart-content__tile" id="chart"         data-function="chart-trainig"></div>
        <div class="chart-content__tile" id="chart-two"     data-function="chart-training-two"></div>
        <div class="chart-content__tile" id="chart-three"   data-function="chart-training-three"></div>
        <div class="chart-content__tile" id="chart-four"    data-function="chart-training-four"></div>
        <div class="chart-content__tile" id="chart-five"    data-function="chart-training-five"></div>
        <div class="chart-content__tile" id="chart-six"     data-function="chart-training-six"></div>
        <div class="chart-content__tile" id="chart-seven"   data-function="chart-training-seven"></div>
        <div class="chart-content__tile" id="chart-eight"   data-function="chart-training-eight"></div>
    </div>


    <div class="main-footer">
        <div class="main-footer__col-groups">

        </div>
        <div class="main-footer__col-items">

        </div>
        <div class="main-footer__col-details">
            <button type="button" data-function="add-report" class="main-footer__btn-add btn btn-blue btn-xs">Add report <i class="glyphicon glyphicon-plus"></i></button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- JavaScript :: Custom scripts for module -->
<script src="/js/AppCore/Extensions/highcharts-4.2.4/js/highcharts.js"></script>
<script src="/js/AppCore/Extensions/highcharts-4.2.4/js/highcharts-3d.js"></script>
<script src="/js/AppCore/Extensions/highcharts-4.2.4/js/modules/exporting.js"></script>
<script src="/js/AppCore/Extensions/highcharts-4.2.4/js/modules/drilldown.js"></script>

<script src="/js/Modules/Reports/Trainings/chartTrainings.js"></script>
<script src="/js/Modules/Reports/Trainings/reportsVC.js"></script>
@endsection