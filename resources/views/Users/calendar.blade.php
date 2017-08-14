@extends('layout')

@section('title_section', 'users page')

@section('style')
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Calendar/calendar.css">
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Calendar/modals.css">
<!--<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Calendar/jquery.datetimepicker.css">-->
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Calendar/bootstrap-datetimepicker.css">
@endsection

@section('content')

@include('Users.modals.trainingsList')
@include('Users.modals.trainingEventAdd')
@include('Users.modals.trainingEventEdit')
@include('Users.modals.trainingEventDelete')
<div class="main-header">
    <div class="row">
        <header data-function="header-module">
            <div class="main-header__module-name">
                <label class="main-header__h1" data-function="main-menu" data-toggle="main-menu">
                    Calendar
                </label>
            </div>
        </header>
    </div>
</div>
<div class="main-content">
    <div class="main-col__groups" data-function="groups">

        <div class="groups-list groups-list--scroll-y">
        
            <div class="groups-list__header">
                Groups
            </div>

            <div class="groups-list__content" data-function="groups-list__groups">
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">Siemens NX</div>
                    </div>
                </div>
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">Siemens TC</div>
                    </div>
                </div>
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">AutoCAD</div>
                    </div>
                </div>
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">SAP Business One</div>
                    </div>
                </div>
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">SAP Pronovia</div>
                    </div>
                </div>
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">MSH Processes</div>
                    </div>
                </div>
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">MSH HQM</div>
                    </div>
                </div>
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">MSH Materials</div>
                    </div>
                </div>
                <div class="groups-list__item">
                    <div class="groups-list__item-content">
                        <div class="groups-list__item-label">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                        </div>
                        <div class="groups-list__item-text">MSE Introduction</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-calendar-content" data-function="calendar-content">  
        <div class="col-calendar-content__wrapper">

            <div class="calendar__month col col-25">
                <div class="calendar__month-name">
                    January
                </div>
                <div class="calendar__month-content january">
                    <div class="calendar__month-content row"> 
                        <div class="calendar__day col">1</div>
                        <div class="calendar__day col">2</div>
                        <div class="calendar__day col">3</div>
                        <div class="calendar__day col">4</div>
                        <div class="calendar__day col">5</div>
                        <div class="calendar__day col">6</div>
                        <div class="calendar__day col">7</div>      
                        <div class="calendar__day col">8</div>
                        <div class="calendar__day col">9</div>
                        <div class="calendar__day col">10</div>
                        <div class="calendar__day col">11</div>
                        <div class="calendar__day col">12</div>
                        <div class="calendar__day col">13</div>
                        <div class="calendar__day col">14</div>
                        <div class="calendar__day col">15</div>
                        <div class="calendar__day col">16</div>
                        <div class="calendar__day col">17</div>      
                        <div class="calendar__day col">18</div>
                        <div class="calendar__day col">19</div>
                        <div class="calendar__day col">20</div>
                        <div class="calendar__day col">21</div>
                        <div class="calendar__day col">22</div>
                        <div class="calendar__day col">23</div>
                        <div class="calendar__day col">24</div>
                        <div class="calendar__day col">25</div>
                        <div class="calendar__day col">26</div>
                        <div class="calendar__day col">27</div>      
                        <div class="calendar__day col">28</div>
                        <div class="calendar__day col">29</div>
                        <div class="calendar__day col">30</div>
                        <div class="calendar__day col">31</div>
                        <div class="calendar__day col">1</div>
                        <div class="calendar__day col">2</div>
                        <div class="calendar__day col">3</div>
                        <div class="calendar__day col">4</div>
                        <div class="calendar__day col">5</div>
                        <div class="calendar__day col">6</div>
                        <div class="calendar__day col">7</div>      
                        <div class="calendar__day col">8</div>
                        <div class="calendar__day col">9</div>
                        <div class="calendar__day col">10</div>
                        <div class="calendar__day col">11</div>

                        <div class="calendar__month-content row">
                        </div>
                    </div>

                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            February
                        </div>
                        <div class="calendar__month-content february">
                            <div class="calendar__day col">1</div>
                            <div class="calendar__day col">2</div>
                            <div class="calendar__day col">3</div>
                            <div class="calendar__day col">4</div>
                            <div class="calendar__day col">5</div>
                            <div class="calendar__day col">6</div>
                            <div class="calendar__day col">7</div>      
                            <div class="calendar__day col">8</div>
                            <div class="calendar__day col">9</div>
                            <div class="calendar__day col">10</div>
                            <div class="calendar__day col">11</div>
                            <div class="calendar__day col">12</div>
                            <div class="calendar__day col">13</div>
                            <div class="calendar__day col">14</div>
                            <div class="calendar__day col">15</div>
                            <div class="calendar__day col">16</div>
                            <div class="calendar__day col">17</div>      
                            <div class="calendar__day col">18</div>
                            <div class="calendar__day col">19</div>
                            <div class="calendar__day col">20</div>
                            <div class="calendar__day col">21</div>
                            <div class="calendar__day col">22</div>
                            <div class="calendar__day col">23</div>
                            <div class="calendar__day col">24</div>
                            <div class="calendar__day col">25</div>
                            <div class="calendar__day col">26</div>
                            <div class="calendar__day col">27</div>      
                            <div class="calendar__day col">28</div>
                            <div class="calendar__day col">29</div>
                            <div class="calendar__day col">30</div>
                            <div class="calendar__day col">31</div>
                            <div class="calendar__day col">1</div>
                            <div class="calendar__day col">2</div>
                            <div class="calendar__day col">3</div>
                            <div class="calendar__day col">4</div>
                            <div class="calendar__day col">5</div>
                            <div class="calendar__day col">6</div>
                            <div class="calendar__day col">7</div>      
                            <div class="calendar__day col">8</div>
                            <div class="calendar__day col">9</div>
                            <div class="calendar__day col">10</div>
                            <div class="calendar__day col">11</div>
                        </div>
                    </div>
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            March
                        </div>  
                        <div class="calendar__month-content march">
                        </div>
                    </div>
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            April
                        </div>
                        <div class="calendar__month-content april">
                        </div>

                    </div>
                    <!--</div>-->
                    <!--<div class="row height-33percent">-->
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            May
                        </div>
                        <div class="calendar__month-content may">
                        </div>

                    </div>
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            June
                        </div>
                        <div class="calendar__month-content june">
                        </div>

                    </div>
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            July
                        </div>
                        <div class="calendar__month-content july">
                        </div>

                    </div>
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            August
                        </div>
                        <div class="calendar__month-content august">
                        </div>

                    </div>
                    <!--</div>-->
                    <!--<div class="row height-33percent">-->
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name september">
                            September
                        </div>
                        <div class="calendar__month-content september">
                        </div>
                    </div>
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            October
                        </div>

                    </div>
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            November
                        </div>

                    </div>
                    <div class="calendar__month col col-25">
                        <div class="calendar__month-name">
                            December
                        </div>

                    </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
        <!--</div>-->

    </div>
    <!--</div>-->
    <div class="main-footer">
        <div class="main-footer__col-groups">
            <button type="button" data-function="add-group" class="main-footer__btn-add btn btn-blue btn-xs">Add Group <i class="glyphicon glyphicon-plus"></i></button>
        </div>
        <div class="main-footer__col-details">

        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- JavaScript :: Custom scripts for module -->
<script>
    $(document).ready(function () {
        var sessionHash = localStorage.getItem('sessionHash');
        console.info(sessionHash);  
    });
</script>
<script src="/js/AppCore/Libraries/errors.js?rev=0.1b" type="text/javascript"></script>
<script src="/js/Modules/Calendar/modals/bootstrap-datetimepicker.js"></script>
<!--<script src="/js/Modules/Calendar/modals/jquery.datetimepicker.full.min.js"></script>
<script src="/js/Modules/Calendar/modals/jquery.datetimepicker.full.js"></script>-->
<script src="/js/Modules/Calendar/modals/trainingEventEditVC.js"></script>
<script src="/js/Modules/Calendar/modals/trainingEventAddVC.js"></script>
<script src="/js/Modules/Calendar/modals/trainingsList.js"></script>
<script src="/js/Modules/Calendar/calendarVC.js"></script>
@endsection