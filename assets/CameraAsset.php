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
        /*'css/camera/normalize.css',
        'css/camera/skeleton.css',
        'css/camera/custom.css',*/
    ];
    public $js = [
        'js/bootstrap-toggle.min.js',
       // 'js/jquery.mask.js',
        'js/libretas.js',
       // 'js/modal-cliente.js',
      // 'js/jquery.min.js',
   
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}