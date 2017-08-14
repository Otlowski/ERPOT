@extends('layout')

@section('title_section', 'users page')

@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Users/users.css?rev={{ \Config::get('revision.rev') }}">
    <link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Rooms/modals.css?rev={{ \Config::get('revision.rev') }}">
    <link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Users/usersEdit.css?rev={{ \Config::get('revision.rev') }}"> 
    <link media="all" type="text/css" rel="stylesheet" href="/css/Modules/Users/usersAdd.css?rev={{ \Config::get('revision.rev') }}"> 
@endsection

@section('content')
@include('Users.modals.userGroupAdd')
@include('Users.modals.userGroupEdit')
<div class="main-header row ">
    <div class="main-header__col-name" data-toggle="main-menu">
            <div class="col-name-content">Users</div>
    </div>
    <div class="main-header__col-search">
            <div class="search-bar">
                <div class="search-bar__wrapper">
                        <input type="text" class="search-bar__input noselect" name="search" placeholder="Search user" data-function="search">
                </div>
            </div>
    </div>
    <div class="main-header__col-details">
            <div class="col-details-content"></div>
    </div>
</div> 
<div class="main-content">
    <div class="main-content__wrapper">      
        <div class="col-groups col" data-function="col-groups">   
            <div class="col-groups-content" data-function="col-groups-content">
                <div class="col-groups-list">
                    <div class="col-groups-list__item">
                        <div class="col-groups-list__item-content">
                        All groups
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-items-list col" data-function="users-list">
            <div class="col-items-list-content">
                <div class="col-items-list-list" >
                    <div class="col-items-list-list__item">
                        <div class="col-items-list-list__item-name">
                            <b>Kuziemski</b> Jakub
                        </div> 
                    </div>
                </div>
            </div>
        </div>
       @include('Users.usersDetails')
       @include('Users.usersEdit')
       @include('Users.userAdd') 
    </div>
</div>
<div class="main-footer" data-function="main-footer">
    <div class="main-footer__col-group" data-function="col-group">
            <button class="btn btn-plus right" data-toggle="add-user-group"></button>
    </div>
    <div class="main-footer__col-item" data-function="col-item">
            <button class="btn btn-plus right" data-toggle="add-user"></button>
    </div>
    <div class="main-footer__col-edit" data-function="col-edit">
            <div class="col-edit__button--edit btn right" data-toggle="edit-user">Edit</div>
            <div class="col-edit__button--cancel" data-toggle="cancel-item" style="display: none;">Cancel</div>
            
            <div class="col-edit__button--add  btn right" data-toggle="add-save" style="display: none;">Add Item</div>
            <div class="col-edit__button--add  btn right" data-toggle="edit-save">Save</div>
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
    <script src="/js/Modules/Users/userEditVC.js"></script>
    <script src="/js/Modules/Users/userAddVC.js"></script>
    <script src="/js/AppCore/Libraries/errors.js?rev={{ \Config::get('revision.rev') }}" type="text/javascript"></script>
    <script src="/js/Modules/Users/modals/groupEditVC.js"></script>
    <script src="/js/Modules/Users/modals/groupAddVC.js"></script>
    <script src="/js/Modules/Users/userDetailsVC.js"></script>
    <script src="/js/Modules/Users/usersGroups.js"></script>
    <script src="/js/Modules/Users/usersVC.js"></script>
    
@endsection