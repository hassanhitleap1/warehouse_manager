<?php

use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    console.log("repo",repo)
    if (repo.loading) {
        return repo.text;
    }
    var markup =
'<div class="row">' + 
    '<div class="col-sm-12">' +
        '<img src="' + repo.thumbnail + '" class="img-rounded" style="width:100px" />' +
        '<b style="margin-left:5px">'+ repo.name + '</b>' + 
    '</div>' +

'</div>';
    if (repo.description) {
      markup += '<p>' + repo.description + '</p>';
    }
    return '<div style="overflow:hidden;">' + markup + '</div>';
};
var formatRepoSelection = function (repo) {
    return repo.name || repo.description;
}
JS;

// Register the formatting script
$this->registerJs($formatJs, View::POS_HEAD);

// script to parse the results into the format expected by Select2
$resultsJs = <<< JS
function (data, params) {
    params.page = params.page || 1;
    return {
        results: data.items,
        pagination: {
            more: (params.page * 30) < data.total_count
        }
    };
}
JS;
// render your widget
echo Select2::widget([
    'name' => 'kv-repo-template',
    'value' => '14719648',
    'initValueText' => 'kartik-v/yii2-widgets',
    'options' => ['placeholder' => 'Search for a repo ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 1,
        'ajax' => [
            'url' => Url::toRoute(["products/search"]) ,
            'dataType' => 'json',
            'delay' => 250,
            'data' => new JsExpression('function(params) { return {q:params.term, page: params.page}; }'),
            'processResults' => new JsExpression($resultsJs),
            'cache' => true
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('formatRepo'),
        'templateSelection' => new JsExpression('formatRepoSelection'),
    ],
]);
?>