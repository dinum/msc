<div class="card mt-4">
    <div class="card-header">
        <h4 class="pull-left">Add User</h4>
    </div> 
    <div class="card-body">
        <?php echo form_open(base_url() . 'users/add', array('class' => 'form-group', 'id' => 'form-id')); ?>
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required id="name" value="<?php echo (isset($fData['name'])) ? $fData['name'] : ""; ?>" name="name">
                <?php echo (isset($error['name']) && !empty($error['name'])) ? $error['name'] : ''; ?>
            </div>
        </div>        
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required id="email" value="<?php echo (isset($fData['email'])) ? $fData['email'] : ""; ?>" name="email">
                <?php echo (isset($error['email']) && !empty($error['email'])) ? $error['email'] : ''; ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select class="form-control" name="status">
                    <option <?php echo (isset($fData['status']) && $fData['status'] == 1) ? "selected" : ""; ?> value="1">Active</option>
                    <option <?php echo (isset($fData['status']) && $fData['status'] == 0) ? "selected" : ""; ?> value="0">Deactivate</option>
                </select>
            </div>
        </div>
        <hr/>
        <div class="form-group row">
            <label for="uname" class="col-sm-3 col-form-label">User Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required id="uname" value="<?php echo (isset($fData['uname'])) ? $fData['uname'] : ""; ?>" name="uname">
                <?php echo (isset($error['uname']) && !empty($error['uname'])) ? $error['uname'] : ''; ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="pw" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" required id="pw" value="" name="pw">
                <?php echo (isset($error['pw']) && !empty($error['pw'])) ? $error['pw'] : ''; ?>
                <div class="alert alert-warning validator" role="alert">
                    Password Should Contain, 
                    a minimum of 1 lower case letter [a-z] and
                    a minimum of 1 upper case letter [A-Z] and
                    a minimum of 1 numeric character [0-9] and
                    Passwords must be at least 8 characters in length.
                </div>                
            </div>            
        </div>
        <div class="form-group row">
            <label for="rpw" class="col-sm-3 col-form-label">Confirm Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" required id="rpw" value="" name="rpw">
                <?php echo (isset($error['rpw']) && !empty($error['rpw'])) ? $error['rpw'] : ''; ?>
            </div>
        </div>
        <hr/>
        <div class="form-group row">
            <div class="col-sm-3">Roles</div>
            <div class="col-sm-9">
                <?php echo (isset($error['roles']) && !empty($error['roles'])) ? $error['roles'] : ''; ?>
                <?php foreach ($roles as $role) { ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?php echo $role->id; ?>" id="gridCheck1" name="roles[]">
                        <label class="form-check-label" for="gridCheck">
                            <?php echo $role->name; ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary pull-right" name="submitform"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
