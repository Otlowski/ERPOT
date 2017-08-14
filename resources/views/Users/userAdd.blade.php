<div class="col-items-informations col" style="display:none;" data-function="add-user-content">
    <div class="items-informations-content" >
        <div class="content-wpapper">

            <div class="row-form">
                <div class="col-label">
                    <div class="image-item">
                        <div class="image-thumb"></div>
                    </div>
                </div>
                <div class="col-inputs line">
                    <div class="input border">
                        <input type="text" name="fullname" placeholder="Full Name">
                    </div>
                    <div class="input border">
                        <input type="text" name="username" placeholder="Username">
                    </div>
                    <input class="input-add-user" type="hidden" name="objectId" value="" placeholder="objectId"/>
                </div>
            </div>

            <div class="row-form">
                <div class="col-label"></div>
                <div class="col-buttons">
                    <div class="btn-group btn-group-xs">
                        <button type="button" data-tab-index="1" class="btn btn-blue selected">User details</button>
                        <button type="button" data-tab-index="2" class="btn btn-blue">Permissions</button>
                    </div>
                </div>
            </div>


            <div class="separate-all"></div>     

            <div class="row-form">
                <div class="col-label">
                    <label>Email</label>
                </div>
                <div class="col-inputs">
                    <div class="input border">
                        <input type="text" name="email" placeholder="Email">
                    </div>
                </div>
            </div>  
            <div class="row-form">
                <div class="col-label">
                    <label>Password</label>
                </div>
                <div class="col-inputs">
                    <div class="input border">
                        <input type="password" name="password" placeholder="">
                    </div>
                </div>
            </div>
            <div class="row-form">
                <div class="col-label">
                    <label>Confirm Password</label>
                </div>
                <div class="col-inputs">
                    <div class="input border">
                        <input type="password" name="confirmPassword" placeholder="">
                    </div>
                </div>
            </div>

            <div class="col-separate">
                <div class="separate"></div>     
            </div>

            <div class="row-form">
                <div class="col-label">
                    <label>Firstname</label>
                </div>
                <div class="col-inputs">
                    <div class="input border">
                        <input type="text" name="firstname" placeholder="Firstname">
                    </div>
                </div>
            </div>
            <div class="row-form">
                <div class="col-label">
                    <label>Lastname</label>
                </div>
                <div class="col-inputs">
                    <div class="input border">
                        <input type="text" name="lastname" placeholder="Lastname">
                    </div>
                </div>
            </div>
            <div class="row-form">
                <div class="col-label">
                    <label>Is Admin</label>
                </div>
                <div class="col-inputs">
                    <div class="input border">
                        <input type="text" name="admin" placeholder="1">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-separate">
            <div class="separate"></div>     
        </div>

        <div class="row-form">
            <div class="col-label">
                <label>Group</label>
            </div>
            <div class="col-inputs">
                <div class="input border">
                    <input type="text" name="group" placeholder="1">
                </div>
            </div>
        </div>
        <div class="row-form">
            <div class="col-label">
                <label>Status</label>
            </div>
            <select id="input-status" name="status">
                <option value="1">activated</option>
                <option value="2">inactivated</option>
                <option value="3">blocked</option>
                <option value="4">archived</option>
            </select>   
        </div>
        <div class="col-separate">
            <div class="separate"></div>     
        </div>
        <div class="row-form"> 
            <div class="col-label"></div>
            <div class="col-data">
                <div class="col-edit__button--delete left btn" data-toggle="delete-item">Delete</div>
            </div>
        </div>

    </div>
</div>


