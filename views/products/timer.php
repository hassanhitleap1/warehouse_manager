<div class="col-md-2">
            <?= $form->field($model, 'featured')
                ->checkBox(['data-size'=>'small', 'class'=>'bs_switch',
                'style'=>'margin-bottom:4px;', 'id'=>'featured']) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'top_selling')
            ->checkBox(['data-size'=>'small', 'class'=>'bs_switch',
                'style'=>'margin-bottom:4px;', 'id'=>'top_selling']) ?>
        </div>

<div class="col-md-2">
            <?=$form->field($model, 'days')->textInput([
                                 'type' => 'number'
                            ])->label(false)?>
        </div>

        <div class="col-md-2">
        <?=$form->field($model, 'hours')->textInput([
                                 'type' => 'number'
                            ])->label(false)?>
        </div>

        <div class="col-md-2">
                                        
           <?=$form->field($model, 'muints')->textInput([
                                 'type' => 'number'
                            ])->label(false)?>
        </div>

        <div class="col-md-2">

        <?=$form->field($model, 'second')->textInput([
                                 'type' => 'number'
                            ])->label(false)?>
        </div>