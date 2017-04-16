<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">员工信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="employee-form">
                <div class="box-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'employee-form',
                        'options' => ['class' => 'form-horizontal', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data'],
                        //'enableAjaxValidation' => true,
                        //'enableClientValidation'=>true,
                        //'validationUrl' => \yii\helpers\Url::toRoute($validationUrl),
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-sm-1 control-label'],
                        ]
                    ]); ?>

                    <?= $form->field($model, 'merchant_id')->widget(\kartik\widgets\Select2::classname(), [
                        'data' => yii\helpers\ArrayHelper::map(\backend\models\Store::find()->where(['=', 'merchant_id', Yii::$app->user->id])->asArray()->all(), 'id', 'name'),
                        //'language' => 'Zh-cn',
                        'options' => ['placeholder' => '选择门店 ...'],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]) ?>
                    <?= $form->field($model, 'workno')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true])->label('确认密码') ?>

                    <?= $form->field($model, 'role')->dropDownList(['1' => '普通店员', '2' => '站长',]) ?>
                    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>
                    <div class="box-footer">
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
