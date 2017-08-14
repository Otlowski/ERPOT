<div id="modal-event-edit" class="modal fade-in"  data-function="training-event-edit">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header modal-header--padding">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <div class="modal-header__training-name">Name
                    <input type="text" class="training-name__content" value="" placeholder="Training's name" data-function="training-name"/>
                </div>
                <div class="separator line" style="display: inline-block; float:left; height: 62px;"></div>
                <div class="modal-header__training-start">Start at
                    <input type="text"  id="datetime-start" class="datetimepicker-start" data-function="training-start"/>
                       <div class="datetimepicker-icon">
                            <span class="glyphicon glyphicon-calendar" style="top:3px;"></span>
                       </div>
                </div>
                <div class="modal-header__training-finish">Finish at  
                    <input type="text"  id="datetime-finish" class="datetimepicker-finish" data-function="training-finish" style="pointer-events: none;"/>
                       <div class="datetimepicker-icon">
                            <span class="glyphicon glyphicon-calendar" style="top:3px;"></span>
                       </div>
                </div>
            </div>
            <div class="modal-body modal-body--dimensions ">
                <div class="alert alert-danger" role="alert" style="display:none;"></div>
                <div class="modal-body__select-buttons">
                    <div class="horizontal-line horizontal-line--left"></div>
                    <div class="col-data">
                        <div class="col-buttons">
                            <div class="btn-group btn-group-xs">
                                <button type="button" data-toggle="rooms-tab" class="btn btn-blue selected" style="width: 100px;">Rooms</button>
                                <button type="button" data-toggle="users-tab" class="btn btn-blue" style="width: 100px;">Users</button>
                                <button type="button" data-toggle="trainings-contents-tab" class="btn btn-blue" style="width: 100px;">Contents</button>
                            </div>
                        </div>
                    </div>
                    <div class="horizontal-line horizontal-line--right"></div>
                </div>
                <div class="modal-body__select-group">
                  <div class="select-group__header">Select Training Group</div>
                  <select id="select-group">
                    <option value="" selected>--select trainings group--</option>
                    <option value="1">Siemens TC</option>
                    <option value="2">AutoCad</option>
                    <option value="3">Sap Business One</option>
                    <option value="4">Sap Pronovia</option>
                    <option value="5">MSH Processes</option>
                    <option value="6">MSH HQM</option>
                    <option value="7">MSH Materials</option>
                  </select><br/>
                </div>
                <!--Rooms Tab-->
                <div class="content-table" style="display: block;" data-function="rooms-content">
                    <div class="content-table__col-select-rooms">
                        <div class="rooms-header">Rooms</div>
                        <div class="search-bar">
                            <div class="search-bar__wrapper">
                                <input type="text" class="search-bar__input noselect" name="search" placeholder="Search room" data-function="search-room">
                            </div>
                        </div>
                        <div class="rooms-list" data-function="rooms-list">
                            <div class="rooms-list__content">
                                <!--Example items-->
                                <div class="rooms-list__item">
                                    <div class="rooms-list__item-content">
                                        <div class="rooms-list__item-label"></div>
                                        <div class="rooms-list__item-text">Room 001</div>
                                        <div class="rooms-list__item-plus" data-toggle="select-room">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="rooms-list__item">
                                    <div class="rooms-list__item-content">
                                        <div class="rooms-list__item-label"></div>
                                        <div class="rooms-list__item-text">Room 100</div>
                                        <div class="rooms-list__item-plus" data-toggle="select-room">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="rooms-list__item">
                                    <div class="rooms-list__item-content">
                                        <div class="rooms-list__item-label"></div>
                                        <div class="rooms-list__item-text">Room 101</div>
                                        <div class="rooms-list__item-plus" data-toggle="select-room">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="rooms-list__item">
                                    <div class="rooms-list__item-content">
                                        <div class="rooms-list__item-label"></div>
                                        <div class="rooms-list__item-text">Room 200</div>
                                        <div class="rooms-list__item-plus" data-toggle="select-room">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="rooms-list__item">
                                    <div class="rooms-list__item-content">
                                        <div class="rooms-list__item-label"></div>
                                        <div class="rooms-list__item-text">Room 201</div>
                                        <div class="rooms-list__item-plus" data-toggle="select-room"> 
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="rooms-list__item">
                                    <div class="rooms-list__item-content">
                                        <div class="rooms-list__item-label"></div>
                                        <div class="rooms-list__item-text">Room 300</div>
                                        <div class="rooms-list__item-plus" data-toggle="select-room">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="rooms-list__item">
                                    <div class="rooms-list__item-content">
                                        <div class="rooms-list__item-label"></div>
                                        <div class="rooms-list__item-text">Room 301</div>
                                        <div class="rooms-list__item-plus" data-toggle="select-room">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--                            </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="content-table__col-details">
                        <div class="col-details__title">Select Room</div>
                        <div style="border-bottom: 1px solid #ccc;">
                            <div class="row-form">
                                <div class="col-label">
                                    <label>Name</label>
                                </div>
                                <div class="col-data">
                                    <div id="name" class="data-text">Room 201</div>    
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="col-label">
                                    <label>Floor</label>
                                </div>
                                <div class="col-data">
                                    <div id="floor" class="data-text">2nd floor</div>    
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="col-label">
                                    <label>Seats Amount</label>
                                </div>
                                <div class="col-data">
                                    <div id="seats" class="data-text">140</div>    
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="col-label">
                                    <label>Location</label>
                                </div>
                                <div class="col-data">
                                    <div id="location" class="data-text">
                                        1251 Judy Cove Suite 026 North Nedraborough, GA 46419
                                    </div>    
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="col-label">
                                    <label>Description</label>
                                </div>
                                <div class="col-data">
                                    <div id="firstname" class="data-text">Rosalee</div>    
                                </div>
                            </div>
                        </div>
                        <div class="col-details__buttons">
                            <button type="button" class="btn right" data-toggle="remove-select">Remove selected room</button>
                        </div>
                    </div>
                </div>
                <!--Users Tab-->
                <div class="content-table" style="display: none;" data-function="users-content">
                    <div class="content-table__col-select-users">
                        <div class="users-header">Users</div>
                        <div class="search-bar">
                            <div class="search-bar__wrapper">
                                <input type="text" class="search-bar__input noselect" name="search" placeholder="Search user" data-function="search-user">
                            </div>
                        </div>
                        <div class="users-list" data-function="users-list">
                            <div class="users-list__content">
                                <!--Example items-->
                                <div class="users-list__item">
                                    <div class="users-list__item-content">
                                        <div class="users-list__item-label"></div>
                                        <div class="users-list__item-name">Maciej Otlowski</div>
                                        <div class="users-list__item-plus" data-toggle="select-user">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="users-list__item">
                                    <div class="users-list__item-content">
                                        <div class="users-list__item-label"></div>
                                        <div class="users-list__item-name">Jaroslaw Baniewski</div>
                                        <div class="users-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="users-list__item">
                                    <div class="users-list__item-content">
                                        <div class="users-list__item-label"></div>
                                        <div class="users-list__item-name">Jan Kowalski</div>
                                        <div class="users-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="users-list__item">
                                    <div class="users-list__item-content">
                                        <div class="users-list__item-label"></div>
                                        <div class="users-list__item-name">Marcin Karol</div>
                                        <div class="users-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="users-list__item">
                                    <div class="users-list__item-content">
                                        <div class="users-list__item-label"></div>
                                        <div class="users-list__item-name">Jan Kowalski</div>
                                        <div class="users-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="users-list__item">
                                    <div class="users-list__item-content">
                                        <div class="users-list__item-label"></div>
                                        <div class="users-list__item-name">Malgorzata Andrzejewicz</div>
                                        <div class="users-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="users-list__item">
                                    <div class="users-list__item-content">
                                        <div class="users-list__item-label"></div>
                                        <div class="users-list__item-name">Dorota Robczewska</div>
                                        <div class="users-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--                            </div>-->
                            </div>
                        </div>

                    </div>
                    <div class="content-table__col-details" data-function="users-table-details">
                        <div class="col-details__title">Select Users</div>
                        <div style="border-bottom: 1px solid #ccc;">
                            <div class="row-form">
                                <div class="col-remove-user">
                                    <div class="icon-remove" data-toggle="remove-user"></div>
                                </div>
                                <div class="col-data-user">
                                    <div class="col-data-user__name">Jan Dąbrowski</div>
                                    <div class="col-data-user__email">j.dabrowski@hotmail.com</div>
                                    <div class="col-data-user__phone">+48514514804</div>
                                    <!--<div id="name" class="data-text">Room 201</div>-->    
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="col-remove-user">
                                    <div class="icon-remove" data-toggle="remove-user"></div>
                                </div>
                                <div class="col-data-user">
                                    <div class="col-data-user__name">Andrzej Winiarski</div>
                                    <div class="col-data-user__email">aaaaaandrzej.winiarski@hotmail.com</div>
                                    <div class="col-data-user__phone">+48555333444</div>
                                    <!--<div id="name" class="data-text">Room 201</div>-->    
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="col-remove-user">
                                    <div class="icon-remove" data-toggle="remove-user"></div>
                                </div>
                                <div class="col-data-user">
                                    <div class="col-data-user__name">Adam Kowal</div>
                                    <div class="col-data-user__email">adam.kowal@hotmail.com</div>
                                    <div class="col-data-user__phone">+48600534600</div>
                                    <!--<div id="name" class="data-text">Room 201</div>-->    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <!--Content Tab-->
                <div class="content-table" style="display: none;" data-function="trainings-content">
                    <div class="content-table__col-select-users">
                        <div class="trainings-header">Trainings</div>
                        <div class="search-bar">
                            <div class="search-bar__wrapper">
                                <input type="text" class="search-bar__input noselect" name="search" placeholder="Search training" data-function="search-training-content">
                            </div>
                        </div>
                        <div class="trainings-list" data-function="trainings-contents-list">
                            <div class="trainings-list__content">
                                <!--Example items-->
                                <div class="trainings-list__item">
                                    <div class="trainings-list__item-content">
                                        <div class="trainings-list__item-label"></div>
                                        <div class="trainings-list__item-name">C++</div>
                                        <div class="trainings-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="trainings-list__item">
                                    <div class="trainings-list__item-content">
                                        <div class="trainings-list__item-label"></div>
                                        <div class="trainings-list__item-name">Java</div>
                                        <div class="trainings-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="trainings-list__item">
                                    <div class="trainings-list__item-content">
                                        <div class="trainings-list__item-label"></div>
                                        <div class="trainings-list__item-name">PHP</div>
                                        <div class="trainings-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="trainings-list__item">
                                    <div class="trainings-list__item-content">
                                        <div class="trainings-list__item-label"></div>
                                        <div class="trainings-list__item-name">Saas</div>
                                        <div class="trainings-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="trainings-list__item">
                                    <div class="trainings-list__item-content">
                                        <div class="trainings-list__item-label"></div>
                                        <div class="trainings-list__item-name">Javascript</div>
                                        <div class="trainings-list__item-plus">
                                            <i class="glyphicon glyphicon-plus glyphicon-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="content-table__col-details" data-function="trainings-table-details">
                        <div class="col-details__title">Select Trainings</div>
                        <div style="border-bottom: 1px solid #ccc;">
                            <div class="row-form">
                                <div class="col-data-training">
                                    <div class="col-remove-training">
                                        <div class="icon-remove" data-toggle="remove"></div>
                                    </div>
                                    <div class="col-data-training__name">Gimp 2.0</div>
                                    <div class="col-data-training__description">Gimp 2.0 of work training concerns Sit incidunt et tempore reprehenderit.</div>
                                    <div class="col-data-training__chapters">
                                        <div class="chapters-button">chapters : 4</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="col-data-training">
                                    <div class="col-remove-training">
                                        <div class="icon-remove" data-toggle="remove"></div>
                                    </div>
                                    <div class="col-data-training__name">Photoshop</div>
                                    <div class="col-data-training__description">Photoshop of work training concerns Sit incidunt et tempore reprehenderit.</div>
                                    <div class="col-data-training__chapters">
                                        <div class="chapters-button">chapters : 5</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-form">
                                <div class="col-data-training">
                                    <div class="col-remove-training">
                                        <div class="icon-remove" data-toggle="remove"></div>
                                    </div>
                                    <div class="col-data-training__name">AngularJS</div>
                                    <div class="col-data-training__description">AngularJS of work training concerns Sit incidunt et tempore reprehenderit.</div>
                                    <div class="col-data-training__chapters">
                                        <div class="chapters-button">chapters : 22</div>
                                    </div>
                                </div>
                            </div>
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
                            <!--<i class="glyphicon glyphicon-plus glyphicon-blue"></i>-->
                        </div>
                        <div class="col-xs-5">
                            <button id="button-ok" type="button" class="btn btn-modal primary right" data-toggle="add-event">Edit Event</button>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



