<div class="card mt-4">
    <div class="card-header">
        <h4 class="pull-left">Add User Role</h4>
    </div> 
    <div class="card-body">
        <?php echo form_open(base_url() . 'roles/add', array('class' => 'form-group', 'id' => 'form-id')); ?>
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Role Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required id="name" name="name">
                <?php echo (isset($error['name'])&&!empty($error['name']))?$error['name']:''; ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">Permissions</div>
            <div class="col-sm-9">
                <?php echo (isset($error['permissions'])&&!empty($error['permissions']))?$error['permissions']:''; ?>
                <?php foreach ($permissions as $permission){ ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?php echo $permission->id; ?>" id="gridCheck1" name="permissions[]">
                    <label class="form-check-label" for="gridCheck">
                        <?php echo $permission->permission; 
                        if($permission->special_permission==1){ ?>
                            <span class="badge badge-pill badge-warning">S</span>
                        <?php } ?>
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
