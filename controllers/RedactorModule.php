<?php

namespace app\controllers;

class RedactorModule extends \yii\base\Module
{
    public $controllerNamespace = 'yii\redactor\controllers';
    public $defaultRoute = 'upload';
    public $uploadDir = '@webroot/uploads';
    public $uploadUrl = '/hello/uploads';

}