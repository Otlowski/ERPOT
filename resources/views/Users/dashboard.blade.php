@extends('layout')

@section('title_section', 'dashboard page')

@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Users/dashboard.css">
@endsection

@section('content')


<div class="main-header row">
    <div class="col-xs-4">
        <h1 class="main-header__h1" data-toggle="main-menu">Training App Dashboard</h1>
    </div>
    <div class="col-xs-4">
    </div>
    <div class="col-xs-4">
    </div>
</div>
<div class="main-content">
    <div class="main-content__wrapper">
        <div class="flexbox flexbox--center">
           <ul class="dashboard-menu flexbox__item">
                <li class="dashboard-menu__item">
                    <a href="/trainings" class="dashboard-menu__link">
                            <span class="dashboard-menu__square">
                                <svg class="dashboard-menu__icon icon icon--x-large icon--colored">
                                    <use xlink:href="#trainings"/>
                                </svg>
                            </span>
                        <span class="dashboard-menu__text">Trainings</span>
                    </a>
                </li>
                <li class="dashboard-menu__item">
                   <a href="/rooms" class="dashboard-menu__link">
                            <span class="dashboard-menu__square">
                                <svg class="dashboard-menu__icon icon icon--x-large icon--colored">
                                    <use xlink:href="#rooms"/>
                                </svg>
                            </span>
                        <span class="dashboard-menu__text">Rooms</span>
                    </a>
                </li>
                <li class="dashboard-menu__item">
                    <a href="/trainings/calendar" class="dashboard-menu__link">
                            <span class="dashboard-menu__square">
                                <svg class="dashboard-menu__icon icon icon--x-large icon--colored">
                                    <use xlink:href="#calendar"/>
                                </svg>
                            </span>
                        <span class="dashboard-menu__text">Calendar</span>
                    </a>
                </li>
                <li class="dashboard-menu__item">
                    <a href="/users" class="dashboard-menu__link">
                            <span class="dashboard-menu__square">
                                <svg class="dashboard-menu__icon icon icon--x-large icon--colored">
                                    <use xlink:href="#users"/>
                                </svg>
                            </span>
                        <span class="dashboard-menu__text">Users</span>
                    </a>
                </li>
                <li class="dashboard-menu__item">
                    <a href="/settings" class="dashboard-menu__link">
                            <span class="dashboard-menu__square">
                                <svg class="dashboard-menu__icon icon icon--x-large icon--colored">
                                    <use xlink:href="#settings"/>
                                </svg>
                            </span>
                        <span class="dashboard-menu__text">Settings</span>
                    </a>
                </li>
            </ul>
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
    <script src="/js/Modules/Users/dashboardVC.js"></script>
@endsection
