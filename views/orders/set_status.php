
<div class="orders-view">
        <div class="row">
            <div class="" align="center">
                <?php foreach ($status as $statu):?>
                    <button type="button" class="btn btn-primary btn-lg change-status" att_id="<?=$model->id?>" att_status_id="<?= $statu->id?>"><?= $statu["name_ar"]?></button>
                <?php endforeach;?>
            </div>
        </div>
</div>