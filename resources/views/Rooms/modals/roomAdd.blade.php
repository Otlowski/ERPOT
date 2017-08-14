<div id="modal-room-add" data-modal="contract-add" class="modal modal-contract-add fade-in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header menu">
                <div class="row components tabview">
                    <div class="col-xs-2 icon separate-line selected" data-content-name="contract" data-tab-index="1">
                        <div class="img document"></div>
                        <div class="desc">Room</div>
                    </div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-2"></div>
                </div>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" role="alert" style="display:none;"></div>

                <input type="hidden" name="contractId" value="" />
                <div class="steps">

                    <div class="step-content step1" data-function="tab-content" data-tab-content-index="1">
                        <div class="content table">

                            <div class="details-row">
                                <div class="col-label">
                                    <div class="label-text">Rooms Group</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-input" style="overflow: visible;">
                                        <div class="btn-group btn-group-xs" role="group" data-function="groups-list">
                                            <button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="groups-list__value" data-group-id=""> ---- select group ---- </span> 
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="line-row"></div>

                            <div class="details-row margin-row">
                                <div class="col-label">
                                    <div class="label-text">Room's Number</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-input">
                                        <input type="text" name="roomNumber" value="" placeholder="Room's Number">
                                    </div>
                                </div>
                            </div> 

                            <div class="details-row">
                                <div class="col-label">
                                    <div class="label-text">Floor</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-input">
                                        <input class="date-picker" type="text" name="floor" value="" placeholder="Floor">
                                    </div>
                                </div>
                            </div> 
                            <div class="details-row">
                                <div class="col-label">
                                    <div class="label-text">Free seats</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-input">
                                        <input class="date-picker" type="text" name="freeSeats" value="" placeholder="Free seats">
                                    </div>
                                </div>
                            </div> 
                            <div class="details-row">
                                <div class="col-label">
                                    <div class="label-text">Location</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-input">
                                        <input type="text" name="address1" value="" placeholder="Street">
                                    </div>
                                    <div class="data-input">
                                        <input type="text" name="address2" value="" placeholder="City">
                                    </div>
                                </div>
                            </div> 

                            <!-- oferta wysłana do klienta -->

                            <div class="details-row margin-row">
                                <div class="col-label">
                                    <div class="label-text">Description</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-text">
                                        <div class="data-input">
                                            <textarea name="description" value="" style="height:70px; font-size: 13px; line-height: 16px; width: 285px" placeholder="Information about room:"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                        </div> 
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <div class="table">
                    <div class="row">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6">
                            <button data-toggle="add-cancel" type="button" class="btn btn-modal" data-dismiss="modal">Cancel</button>
                            <div class="separator line"></div>
                            <button data-toggle="add-save" type="button" class="btn btn-modal primary right">Add room</button>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



