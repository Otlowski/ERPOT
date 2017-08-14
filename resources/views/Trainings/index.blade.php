@extends('layout')

@section('title_section', 'users page')

@section('style')
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Trainings/modals.css?rev={{ \Config::get('revision.rev') }}">
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Trainings/trainingsList.css?rev={{ \Config::get('revision.rev') }}">
@endsection

@section('content')
@include('Trainings.modals.trainingAdd')
<div id="employees" class="main-module comployees noselect">
    <div class="main-header">
        <div class="row">
            <header data-function="header-module">
                <div class="main-header__module-name">
                    <label class="main-header__h1" data-function="main-menu" data-toggle="main-menu">
                        Trainings
                    </label>
                </div>
                <div class="main-header__search">

                    <div class="search-bar">
                        <div class="search-bar__wrapper">
                            <input type="text" class="search-bar__input noselect" name="search" placeholder="Search training" data-function="search" />
                        </div>
                    </div>

                </div>
                <div class="main-header__user-info user-info">
                    <div class="user-controls">
                    </div>
                </div>
            </header>
        </div>
    </div>
    <div class="main-content">
        <div class="row">

            <div class="main-col__groups" data-function="groups">

                <div class="groups-list groups-list--scroll-y">
                    <div class="groups-list__header">

                    </div>
                    <div class="groups-list__content" data-function="groups-list__all">

                        <div class="groups-list__item">
                            <div class="groups-list__item-content">

                                <div class="groups-list__item-text">All Trainings</div>

                            </div>
                        </div>

                    </div>

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
            
            <div class="main-col__items" data-function="items">
                    
                    <div class="training_content-list"> 
                        <div class="training_content__header">
                                
                        </div>
                        <div class="training_content__content" data-function="trainings-list">
                            
                        </div>
                        <div class="training_content__footer">
                            Items count: 0
                        </div>
                    </div>
                    
            </div> 
            <div class="main-col__details trainings-details" >
            
                <div class="trainings-alert__content" data-function="alert-form">
                    <div class="trainings-alert__h3">No training selected</div>
                </div>
                    <!-- Include empty details layout -->
                    @include('Trainings.trainingDetails')
            </div>
        </div>
    </div>
    <div class="main-footer">
        <div class="main-footer__col-groups">
            <button type="button" data-function="add-group" class="main-footer__btn-add btn btn-blue btn-xs">Add Group <i class="glyphicon glyphicon-plus"></i></button>
        </div>
        <div class="main-footer__col-items">

            <div style="float:left;" class="btn-group btn-group-xs" role="group" aria-label="">
<!--                <button type="button" data-function="filter-employees" class="main-footer__btn-filter btn btn-blue btn-xs">Filter <i class="glyphicon glyphicon-filter"></i></button>
                <button type="button" data-function="filter-employees" class="main-footer__btn-filter btn btn-blue btn-xs">Export XLS <i class="glyphicon glyphicon-cloud-download"></i></button>-->
            </div>
            <button type="button" data-function="add-training" class="main-footer__btn-add btn btn-blue btn-xs">Add training <i class="glyphicon glyphicon-plus"></i></button>

        </div>
        <div class="main-footer__col-details">

        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- JavaScript :: Custom scripts for module -->
<!--//<script>
//    $(document).ready(function(){
//       var sessionHash = localStorage.getItem('sessionHash');
//        console.info( sessionHash );
//    });
//</script>-->
<script src="/js/AppCore/Libraries/errors.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
<script src="/js/Modules/Trainings/trainingsPreviewVC.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
<script src="/js/Modules/Trainings/trainingsListVC.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
<script src="/js/Modules/Trainings/modals/trainingsGroupAddVC.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
@endsection