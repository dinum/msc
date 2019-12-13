
<div class="accordion m-4" id="accordionExample">
    <?php $i = 1;
    foreach ($elections as $election) { ?>
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="<?php echo ($i == 1) ? "true" : "false"; ?>" aria-controls="collapseOne">
    <?php echo $election->name; ?>
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse <?php echo ($i == 1) ? "show" : ""; ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">2019</li>
                        <li class="list-group-item">2018</li>
                        <li class="list-group-item">2017</li>
                        <li class="list-group-item">2016</li>
                        <li class="list-group-item">2015</li>
                    </ul>
                </div>
            </div>
        </div>
    <?php $i++;
} ?>

</div>