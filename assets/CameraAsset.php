<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace  documento_salud\assets;


use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CameraAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/libretas.css',
    ];
    public $js = [
        'js/bootstrap-toggle.min.js',
        'js/jquery.mask.js',
<<<<<<< HEAD
       // 'js/jquery.min.js',
        'js/modal-foto.js',
=======
        'js/jquery.min.js',
        'js/libretas.js',
>>>>>>> 0d4b003b6571e4b0863ee2e3b441f5ba6dae22c1
        //'js/jquery.min.js',
   
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}