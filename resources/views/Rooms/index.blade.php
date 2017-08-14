@extends('layout')

@section('style')
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Rooms/rooms.css?rev={{ \Config::get('revision.rev') }}">
<link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Rooms/modals.css?rev={{ \Config::get('revision.rev') }}">

@stop


@section('content')
@include('Rooms.modals.roomGroupAdd')
@include('Rooms.modals.roomGroupEdit')
@include('Rooms.modals.roomAdd')
@include('Rooms.modals.roomEdit')
<div id="rooms" class="main-module rooms noselect">


    <!-- Main Header -->
    <div class="main-header">
        <div class="row">
            <header data-function="header-module">
                <div class="col col-xs-2 header">
                    <label class="main-header__h1" data-toggle="main-menu">
                        Rooms
                    </label>
                </div>
                <div class="col col-xs-7">

                </div>
                <div class="col col-xs-3 user-info">
                    <div class="user-controls">
                    </div>
                </div>
            </header>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="row">

            <div class="main-col__groups" data-function="groups-list">

                <div class="groups-list groups-list--scroll-y">
                    <div class="groups-list__header">

                    </div>
                    <div class="groups-list__content all-groups" data-function="groups-list__content">

                        <div class="groups-list__item">
                            <div class="groups-list__item-content">
                                All rooms
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="main-col__items" data-function="items">
                <div>
                    <div class="search-bar">
                        <div class="search-bar__wrapper">
                            <input type="text" class="search-bar__input noselect" name="search" placeholder="Search room by objectId" data-function="search"/>
                        </div>
                    </div>

                    <div class="items-list" data-function="room-list"> 
                        <div class="items-list__header">

                            <div class="room-item--header">
                                <div class="room-item__row">
                                    <div class="room-item__col room-item__col--5">
                                        <div class="col__header-status">Status</div>
                                    </div>
                                    <div class="room-item__col room-item__col--15">
                                        <div class="col__header-room-no">Room no</div>
                                    </div>
                                    <div class="room-item__col room-item__col--30">
                                        <div class="col__header-location">Location</div>
                                    </div>
                                    <div class="room-item__col room-item__col--20">
                                        <div class="col__header-seats">Free seats</div>
                                    </div>
                                    <div class="room-item__col room-item__col--30">
                                        <div class="col__header-floor">Floor</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="items-list__content" >
                            List of items
                        </div>
                        <div class="items-list__footer">
                            <div>
                                    Number of rooms: 0
                            </div>  
                        </div>
                        <!--<div class="section-footer">-->
                                
                        <!--</div>-->
                    </div>

                </div>
            </div>





            <!-- Footers -->
            <div class="details-footer" data-function="preview-footer" style="display: none;">
                <a href="javascript:;" class="btn btn-blue right margin-lr" data-toggle="edit-contractor">Edit</a>
            </div>
            <div class="details-footer" data-function="edit-footer" style="display: none;">                    
                <a href="javascript:;"  class="btn btn-blue left margin-l" data-toggle="edit-cancel">Cancel</a>
                <a href="javascript:;"  class="btn btn-blue primary right margin-lr " data-toggle="edit-save">Save</a>
            </div>

            <div class="details-footer" data-function="add-footer" style="display: none;">
                <a href="javascript:;"  class="btn btn-blue left margin-l" data-toggle="add-cancel">Cancel</a>
                <a href="javascript:;"  class="btn btn-blue primary right margin-lr" data-toggle="add-save">Add contractor</a>
            </div>
            <!-- End of footers -->

        </div>

    </div>
</div>

<!-- Main Footer -->
<div class="main-footer main-footer--botder-top">
    <div class="groups-footer">
        
        <button class="btn btn--plus right" data-toggle="add-room-group"></button> 
        
    </div>
    <div class="row">
        <footer data-function="footer-module">
            <div class="main-footer__wrapper">
                <button class="btn btn--plus" data-toggle="add-room"></button> 
            </div>        
        </footer>
    </div>
</div>

</div>

<div class="dragging-handler" style="display:none;">
    <div class="drag-icon">
    </div>
</div>

@stop

@section('scripts')
<script src="/js/AppCore/Libraries/tabView.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
<script src="/js/AppCore/Libraries/errors.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>

<script src="/js/Modules/Rooms/modals/roomGroupAddVC.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
<script src="/js/Modules/Rooms/modals/roomGroupEditVC.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
<script src="/js/Modules/Rooms/modals/roomAddVC.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
<script src="/js/Modules/Rooms/modals/roomEditVC.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>

<script src="/js/Modules/Rooms/groups.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
<script src="/js/Modules/Rooms/roomsVC.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>


@stop
