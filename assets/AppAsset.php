<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;


/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $publishOptions = [
        'forceCopy' => true
    ];
    public $css = [
        'css/site.css',
        'https://necolas.github.io/normalize.css/8.0.1/normalize.css',
        'css/style.css',
    ];
    public $js = [
        'https://api-maps.yandex.ru/2.1/?apikey=01ff6321-24c8-4bc8-8a91-c197c7311d55&lang=ru_RU',
        'https://kit.fontawesome.com/4d1cee073e.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
