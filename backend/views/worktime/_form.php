<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Worktime */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">班次信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="worktime-form">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(['id' => 'worktime-form',
                        'options' => ['class' => 'form-horizontal', 'autocomplete' => 'off',],
                        //'enableAjaxValidation' => true,
                        //'enableClientValidation'=>true,
                        //'validationUrl' => \yii\helpers\Url::toRoute($validationUrl),
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-sm-1 control-label'],
                        ]]); ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <div class="form-group field-begin required">
                        <label class="col-sm-1 control-label" for="worktime-begin">上班时间</label>
                        <div class="col-sm-8"> <?= TimePicker::widget([
                                'model' => $model,
                                'attribute' => 'begin',

                                'value' => '08:00 AM',
                                'pluginOptions' => [
                                    'showSeconds' => false
                                ]
                            ]) ?></div>
                        <div class="col-sm-3">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group field-end required">
                        <label class="col-sm-1 control-label" for="worktime-end">下班时间</label>
                        <div class="col-sm-8">  <?= TimePicker::widget([
                                'model' => $model,
                                'attribute' => 'end',
                                'value' => '18:00 PM',
                                'pluginOptions' => [
                                    'showSeconds' => false,
                                ]
                            ]) ?></div>
                        <div class="col-sm-3">
                            <div class="help-block"></div>
                        </div>
                    </div>


                    <?php //$form->field($model, 'begin')->textInput() ?>

                    <?php // $form->field($model, 'end')->textInput() ?>

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
