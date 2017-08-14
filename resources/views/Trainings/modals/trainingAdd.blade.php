<div id="modal-training-add" data-modal="training-add" class="modal modal-training-add fade-in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header menu">
                <div class="row components tabview">
                    <div class="col-xs-2 icon separate-line selected" data-content-name="contract" data-tab-index="1">
                        <div class="img document"></div>
                        <div class="desc">Training</div>
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

                            <div class="details-row margin-row">
                                <div class="col-label">
                                    <div class="label-text">Name</div>
                                </div>
                                <div class="col-data">
                                    <div class="data-text">
                                        <div class="data-input">
                                            <input name="name" value=""  placeholder="Name:"></input>
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
                                            <textarea name="description" value=""  placeholder="Information about training group:"></textarea>
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
                            <button data-toggle="add-save" type="button" class="btn btn-modal primary right">Add group</button>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



