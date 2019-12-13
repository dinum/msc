<div class="card mt-4">
    <div class="card-header">
        <h4 class="pull-left">Add Permission</h4>
    </div> 
    <div class="card-body">
        <?php echo form_open(base_url() . 'permissions/add', array('class' => 'form-group', 'id' => 'form-id')); ?>
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Permission Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required id="name" name="name">
                <?php echo (isset($error['name'])&&!empty($error['name']))?$error['name']:''; ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">Special Permission</div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="gridCheck1" name="special">
                </div>
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
