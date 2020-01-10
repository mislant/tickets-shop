<?php


namespace app\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Amatic+SC:400,700',
    ];
    public $cssOptions = [
        'type' => 'text/css'
    ];

}