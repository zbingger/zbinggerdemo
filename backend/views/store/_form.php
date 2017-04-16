<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Store */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">油站信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <div class="store-form">

                    <?php $form = ActiveForm::begin(['id' => 'store-form',
                        'options' => ['class' => 'form-horizontal', 'autocomplete' => 'off',],
                        'enableAjaxValidation' => true,
                        //'enableClientValidation'=>true,
                        'validationUrl' => \yii\helpers\Url::toRoute($validationUrl),
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-sm-1 control-label'],
                        ]]); ?>

                    <?php //echo $form->field($model, 'merchant_id')->textInput() ?>

                    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'telphone')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'point')->textInput(['maxlength' => true]) ?>
                    <div class="form-group field-store-point required">
                        <label class="col-sm-1 control-label" for="store-point">坐标获取</label>
                        <div class="col-sm-8">
                            <div id="allmap"></div>
                            <input type="text" name="map" id="map"/>
                            <input type="text" name="addr" id="addr"/><input type="button" id="autogets" value="获取"/>
                        </div>

                        <div class="col-sm-3"><div class="help-block"></div></div>
                    </div>

                    <div class="box-footer">

                            <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<style>#allmap{width: 400px; height: 250px;}</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=kDmUwErUtkC0jABBKEzFp44vZEUVp79x"></script>
<script type="text/javascript">
    var map = new BMap.Map("allmap");
    var geoc = new BMap.Geocoder();
    var customeCity = new BMap.LocalCity();
    var cityName = '';
    var marker = new BMap.Marker(116.331398, 39.897445);
    function setXappCenter(result) {
        cityName = result.name;
        map.setCenter(cityName);
        map.centerAndZoom(cityName, 13);
    }

    // 百度地图API功能
    customeCity.get(setXappCenter);

    map.addEventListener("click", function (e) {

        map.clearOverlays();
        var point = new BMap.Point(e.point.lng, e.point.lat);
        marker.setPosition(point);
        map.addOverlay(marker);
        marker.enableDragging();
        document.getElementById("map").value = e.point.lng + "," + e.point.lat;
        getAddr(e.point.lng, e.point.lat)

    });
    document.getElementById('autogets').addEventListener('click',function () {
       document.getElementById('store-point').value= document.getElementById('map').value;
    })
    marker.addEventListener("dragend", function (e) {
        document.getElementById("map").value = e.point.lng + "," + e.point.lat;
        getAddr(e.point.lng, e.point.lat)
    });

    function getAddr(lng, lat) {
        var point = new BMap.Point(lng, lat);
        geoc.getLocation(point, function (rs) {
            var addComp = rs.addressComponents;
            document.getElementById("addr").value = addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber;
        });
    }


</script>