<div id="modal-group-edit" data-modal="room-group-edit" class="modal modal-group-edit fade-in">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header menu">
                <div class="row components tabview">
                    <div class="col-xs-2 icon separate-line selected" data-content-name="group" data-tab-index="1">
                        <div class="img document"></div>
                        <div class="desc">Group</div>
                    </div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-2"></div>
                </div>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" role="alert" style="display:none;"></div>

                <input type="hidden" name="groupId" value="" />
                <div class="steps">

                    <div class="step-content step1" data-function="tab-content" data-tab-content-index="1">
                        <div class="content table">
                            
                            <div class="details-row margin-row">
                                <div class="col-label">
                                    <div class="label-text">Group Name</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-text">
                                        <div class="data-input">
                                            <textarea name="name" value="" style="height:25px; font-size: 13px; line-height: 16px; width: 285px" placeholder="Name: "></textarea>
                                        </div>
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
                                            <textarea name="description" value="" style="height:70px; font-size: 13px; line-height: 16px; width: 285px" placeholder="Information about group:"></textarea>
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
                            <button data-toggle="edit-delete" type="button" class="btn btn-modal left red">Delete group</button>
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



