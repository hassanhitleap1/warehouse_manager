
<div class="orders-view">
        <div class="row">
            <div class="" align="center">
                <?php foreach ($campanies as $campany):?>
                    <button type="button" class="btn btn-primary btn-lg change-campany" att_id="<?=$model->id?>" att_campany_id="<?= $campany->id?>" name_campany="<?= $campany["name"]?>"><?= $campany["name"]?></button>
                <?php endforeach;?>
            </div>
        </div>
</div>