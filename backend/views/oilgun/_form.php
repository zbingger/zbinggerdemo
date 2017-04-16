<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Oilgun */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">油枪信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <div class="oilgun-form">

                    <?php $form = ActiveForm::begin(['id' => 'oilgun-form',
                        'options' => ['class' => 'form-horizontal', 'autocomplete' => 'off',],
                        //'enableAjaxValidation' => true,
                        //'enableClientValidation'=>true,
                        //'validationUrl' => \yii\helpers\Url::toRoute($validationUrl),
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-sm-1 control-label'],
                        ]]); ?>

                    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'oil_id')->widget(\kartik\widgets\Select2::classname(), [
                        'data' => yii\helpers\ArrayHelper::map(\backend\models\Oil::find()->asArray()->all(), 'id', 'name'),
                        //'language' => 'Zh-cn',
                        'options' => ['placeholder' => '选择油品 ...'],
                        'pluginOptions' => [
                            'allowClear' => 0
                        ],
                    ]) ?>


                    <?= $form->field($model, 'store_id')->widget(\kartik\widgets\Select2::classname(), [
                        'data' => yii\helpers\ArrayHelper::map(\backend\models\Store::find()->where(['merchant_id' => Yii::$app->user->id])->asArray()->all(), 'id', 'name'),
                        //'language' => 'Zh-cn',
                        'options' => ['placeholder' => '选择门店 ...'],
                        'pluginOptions' => [
                            'allowClear' => 0
                        ],
                    ]) ?>
                    <?= $form->field($model, 'flag')->dropDownList([ '开启' => '开启', '关闭' => '关闭', ], ['prompt' => '请选择开启状态...']) ?>


                    <div class="box-footer">
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
