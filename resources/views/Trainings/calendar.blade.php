@extends('layout')

@section('title_section', 'users page')

@section('style')
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Trainings/trainingsCalendar.css?rev={{ \Config::get('revision.rev') }}">
@endsection

@section('content')
<div id="calendar" class="main-module noselect">
    <div class="main-header">
        <div class="row">
            <header data-function="header-module">
                <div class="main-header__module-name">
                    <label class="main-header__h1" data-function="main-menu" data-toggle="main-menu">
                        Calendar
                    </label>
                </div>
                <div class="search-bar">
                        <div class="search-bar__wrapper">
                            <input type="text" class="search-bar__input noselect" name="search" placeholder="Search event" data-function="search">
                        </div>
                </div>
            </header>
        </div>
    </div>
    <div class="main-content">
        <!--<div class="row">-->
        <div class="col-day wrapper" >

            <div class="col-day__header">
                <!--<div class="col-day__header-content">-->
                <div class="col-day__header-date">2016-11-28</div>
                <div class="circle-day">
                    <div class ="circle-day__name">
                        Mo
                    </div>
                </div>               
            </div>

            <div class="col-day__content">
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-day__footer" data-function="items">
                <div class="plus-icon" data-toggle="add-event"></div>
            </div>

        </div> 
         <div class="col-day wrapper" >

            <div class="col-day__header">
                <!--<div class="col-day__header-content">-->
                <div class="col-day__header-date">2016-11-29</div>
                <div class="circle-day">
                    <div class ="circle-day__name">
                        Tu
                    </div>
                </div>               
            </div>

            <div class="col-day__content">
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            08:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C# Course
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            10:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Java Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Web Dev.
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            13:30
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Lunch Break
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> --<br> --</div><div class="cell cell--40">--<br>--</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> --<br> --</div><div class="cell cell--40">--<br>--</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-day__footer" data-function="items">
                <div class="plus-icon" data-toggle="add-event"></div>
            </div>

        </div> 
        <div class="col-day wrapper" >

            <div class="col-day__header">
                <!--<div class="col-day__header-content">-->
                <div class="col-day__header-date">2016-11-30</div>
                <div class="circle-day">
                    <div class ="circle-day__name">
                        We
                    </div>
                </div>               
            </div>

            <div class="col-day__content">
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-day__footer" data-function="items">
                <div class="plus-icon" data-toggle="add-event"></div>
            </div>

        </div> 
         <div class="col-day wrapper" >

            <div class="col-day__header">
                <!--<div class="col-day__header-content">-->
                <div class="col-day__header-date">2016-11-31</div>
                <div class="circle-day">
                    <div class ="circle-day__name">
                        Th
                    </div>
                </div>               
            </div>

            <div class="col-day__content">
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            08:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C# Course
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            10:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Java Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Web Dev.
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            13:30
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Lunch Break
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> --<br> --</div><div class="cell cell--40">--<br>--</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> --<br> --</div><div class="cell cell--40">--<br>--</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-day__footer" data-function="items">
                <div class="plus-icon" data-toggle="add-event"></div>
            </div>

        </div> 
        <div class="col-day wrapper" >

            <div class="col-day__header">
                <!--<div class="col-day__header-content">-->
                <div class="col-day__header-date">2016-12-01</div>
                <div class="circle-day">
                    <div class ="circle-day__name">
                        Fr
                    </div>
                </div>               
            </div>

            <div class="col-day__content">
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            10:00
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Java Course
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            13:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Java Basic
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            14:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Web Dev.
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            15:30
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            Lunch Break
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> --<br> --</div><div class="cell cell--40">--<br>--</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> --<br> --</div><div class="cell cell--40">--<br>--</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event">
                    <div class="event__date">
                        <div class="event__date-watch">
                            12:15
                        </div>

                    </div>
                    <div class="event__information">
                        <div class="event__information-title">
                            C++ Training
                        </div>
                        <div class="event__information-details">
                            <div class="event__information-details-col col--separator">
                                <div class="cell cell--60 cell--label"> Chapters<br> Language</div><div class="cell cell--40">15<br>DE</div>
                            </div>
                            <div class="event__information-details-col ">
                                <div class="cell cell--60 cell--label"> Room<br> Users</div><div class="cell cell--40">W125<br>15/20</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-day__footer" data-function="items">
                <div class="plus-icon" data-toggle="add-event"></div>
            </div>

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

@endsection 