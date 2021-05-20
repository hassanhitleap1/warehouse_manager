
<div class="orders-view">
        <div class="row">
            <div class="" align="center">
                <?php foreach ($status as $statu):?>
                    <button type="button" class="btn btn-primary btn-lg change-status-all"  att_id_string="<?=$_GET['id_string']?>"  name_status="<?= $statu["name_ar"]?>"><?= $statu["name_ar"]?></button>
                <?php endforeach;?>
            </div>
        </div>
</div>