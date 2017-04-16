<?php
/**
 * Created by PhpStorm.
 * User: masterpc
 * Date: 17-4-3
 * Time: 下午12:00
 */
namespace common\traits;

use Yii;
use yii\web\UploadedFile;
trait UploadImgTrait
{
    public function uploadImg($model, $labels, $attribute)
    {
        $label = $labels[$attribute];
        $UpImages = UploadedFile::getInstance($model, $attribute);
        if ($UpImages) {
            $date = date("Ymd", time());
            $path =  Yii::$app->params['uploadDir'] . '/image/u' . $model->uid . '/' . $date . '/';
            if (!is_dir($path)) {
                if (!mkdir($path, 0777, true)) {
                    //图片目录创建失败
                    Yii::$app->session->setFlash('error', '[“' . $label . '”]目录创建失败');
                    return false;
                }
            }
            if ($UpImages->extension != 'jpg' && $UpImages->extension != 'png') {
                Yii::$app->session->setFlash('error', '[“' . $label . '”]格式必须为.jpg或者.png');
                return false;
            }
            if ($UpImages->size > 5242880) {
                Yii::$app->session->setFlash('error', '[“' . $label . '”]大小不能超过5M');
                return false;
            }
            $upimgName = md5($UpImages->baseName . time() . rand(10000, 99999)) . '.' . $UpImages->extension;
            $UpImages->saveAs($path . $upimgName);
            return '/' . Yii::$app->params['uploadDir'] . '/image/u' . $model->uid . '/' . $date . '/' . $upimgName;
        } else {
            Yii::$app->session->setFlash('error', '请选择先[“' . $label . '”]，然后上传');
            return false;
        }
    }

}
