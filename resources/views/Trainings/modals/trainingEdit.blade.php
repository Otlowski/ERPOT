<div id="modal-training-edit" data-modal="training-edit" class="modal modal-training-edit fade-in">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header menu">
                <div class="row components tabview">
                    <div class="col-xs-2 icon separate-line selected" data-content-name="contract" data-tab-index="1">
                        <div class="img document"></div>
                        <div class="desc">Training</div>
                    </div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-2"></div>
                </div>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" role="alert" style="display:none;"></div>

                <input type="hidden" name="roomObjectId" value="" />
                <input type="hidden" name="roomsGroupId" value="" />
                <div class="steps">

                    <div class="step-content step1" data-function="tab-content" data-tab-content-index="1">
                        <div class="content table">

                            <div class="details-row">
                                <div class="col-label">
                                    <div class="label-text">Room number</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-text name">
                                        <span class="firstname" data="roomNumber"></span>
                                    </div>  
                                </div>
                            </div> 
                            <div class="details-row">
                                <div class="col-label">
                                    <div class="label-text" style="font-size: 13px">Group</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-text contractor-name" style="padding-top: 7px; font-size: 13px; font-weight: normal;line-height: 16px;color: #666;" data="roomGroupNumber">

                                    </div>
                                </div>
                            </div> 

                            <!-- numer zapytania ofertowego klienta -->
                            <div class="details-row margin-row">
                                <div class="col-label">
                                    <div class="label-text">Floor</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-input">
                                        <input type="text" name="floor" value="" placeholder="Floor">
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="details-row margin-row">
                                <div class="col-label">
                                    <div class="label-text">Free Seats</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-input">
                                        <input type="text" name="freeSeats" value="" placeholder="Free Seats">
                                    </div>
                                </div>
                            </div> 

                            <div class="details-row margin-row">
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

                            <div class="details-row margin-row">
                                <div class="col-label">
                                    <div class="label-text">Description</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-text">
                                        <div class="data-input">
                                            <textarea name="description" value="" style="height:70px; font-size: 13px; line-height: 16px; width: 285px" placeholder="Information about training:"></textarea>
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
                            <button data-toggle="edit-delete" type="button" class="btn btn-modal left red">Delete training</button>
                        </div>
                        <div class="col-xs-6">
                            <button data-toggle="edit-cancel" type="button" class="btn btn-modal" data-dismiss="modal">Cancel</button>
                            <div class="separator line"></div>
                            <button data-toggle="edit-save" type="button" class="btn btn-modal primary right">Save</button>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



