<div id="modal-trainings-list" class="modal modal-trainings-list fade-in" data-function="trainings-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<div class="modal-header__title">Trainings list </div>-->
                <div class="modal-header__date" data-function="date-time"></div>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" role="alert" style="display:none;"></div>

                <input type="hidden" name="selectedDate" value="" />
                <input type="hidden" name="selectedHolidayId" value="0" />

                <div class="steps">
                    <div class="step1 trainings-select">
                        <div class="content table">

                            <!-- Templates -->
                            <div class="training-item template" style="display:none;">
                                
                                <div class="training-item__label-dot">
                                    <div class="icon-remove" data-record-title="Training Event" data-toggle="modal" data-target="#confirm-delete"></div>
                                </div>
                                
                                <div class="training-item__name">
                                    <span></span>
                                </div>
                                <div class="training-item__name-contents">
                                    <span></span>
                                </div> 
                                <div class="training-item__add">
                                </div>
                                <div class="training-item__time">

                                </div>
                                <div class="training-item__label-dot-edit" data-toggle="edit-training">
                                   <span class="glyphicon glyphicon-pencil glyphicon-blue" aria-hidden="true"></span>
                                </div>  
                            </div>
                            <!-- End of templates -->
                            <div class="col-trainings">
                                <div class="no-trainings" style="font-size: 28px; color: #ccc; text-align:center; display:block; padding-top: 50px;">
                                    No trainings
                                </div>
                                <div class="trainings-list">

                                    <!-- All trainings list -->

                                </div>
                            </div>
                        </div>   
                    </div>

                    <div class="step2 training-add" style="display:none;">
                        <div class="room-list__title" style="margin: 0 auto; height: 50px; width: 200px; color: #167efb; font-size: 18px; text-align: center;">Choose room</div>

                        <div class="room-list__dropdown" style="margin: 0 auto; text-align: center;">
                            <select  id="select-room" class="selectpicker" data-live-search="true">
                            </select>
                        </div> 

                    </div>

                    <div class="step3 training-add" style="display:none;">
                        <div class="users-list__title" style="margin: 0 auto; height: 25px; width: 200px; color: #167efb; font-size: 18px; text-align: center;">Users</div>
                        <div class="main-header__search">
                            <div class="search-bar">
                                <div class="search-bar__wrapper">
                                    <input type="text" class="search-bar__input noselect" name="search" placeholder="Search user" data-function="search">
                                </div>
                            </div>
                        </div>
                        <div class="users-list__items" data-function = "users-list">
                            <div class="user-item"> 
                                test user
                            </div>
                                <label for="inlineCheckbox1"> Inline One <input type="checkbox" id="inlineCheckbox1" value="option1"></label>

                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer" data-function="modal-footer">

                <div class="table">

                    <div class="row list">
                        <div class="col-xs-5">
                            <button id="button-cancel" type="button" class="btn btn-modal left blue" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-xs-2" style="text-align: center;">
                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                        </div>
                        <div class="col-xs-5">
                            <button id="button-ok" type="button" class="btn btn-modal primary right" data-dismiss="modal">OK</button>
                        </div>
                    </div>

                    <div class="row add" style="display:none;">
                        <div class="col-xs-5">
                        </div>
                        <div class="col-xs-2" style="text-align: center;">
                        </div>
                        <div class="col-xs-5">
                            <button id="button-cancel" type="button" class="btn btn-modal right">Cancel</button>
                            <div class="separator line"></div>
                            <i id="button-add" class="glyphicon glyphicon-menu-right right-arrow"></i>

                        </div>
                    </div>

                    <div class="row edit" style="display:none;">
                        <div class="col-xs-5">
                            <button id="button-delete" type="button" class="btn btn-modal red left">Delete training</button>
                        </div>
                        <div class="col-xs-2" style="text-align: center;">
                        </div>
                        <div class="col-xs-5">
                            <button id="button-cancel" type="button" class="btn btn-modal right">Cancel</button>
                            <div class="separator line"></div>
                            <button id="button-save" type="button" class="btn btn-modal primary right">Save</button>
                        </div>
                    </div>


                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



