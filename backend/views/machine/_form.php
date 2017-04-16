<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Machine */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">机具信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="machine-form">
                <div class="box-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'machine-form',
                        'options' => ['class' => 'form-horizontal', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data'],
                        //'enableAjaxValidation' => true,
                        //'enableClientValidation'=>true,
                        //'validationUrl' => \yii\helpers\Url::toRoute($validationUrl),
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-sm-1 control-label'],
                        ]
                    ]); ?>

                    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'imei')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'store_id')->widget(\kartik\widgets\Select2::classname(), [
                        'data' => yii\helpers\ArrayHelper::map(\backend\models\Store::find()->where(['merchant_id' => Yii::$app->user->id])->asArray()->all(), 'id', 'name'),
                        //'language' => 'Zh-cn',
                        'options' => [
                            'placeholder' => '选择门店 ...',
                            'onchange' => '
                            $.post("' . \yii\helpers\Url::to(['get-oils']) . '",{"store_id":$(this).val()},
                                 function (data) {
                                      console.log(data);
                                     var list=JSON.parse(data);
                                     var htmldata="";
                                     if(list.code != 0){
                                        var size=list.message.result.length;
                                        for(var i=0; i<size;i++){
                                             htmldata +="<option value="+list.message.result[i].id+">"+list.message.result[i].number+"</option>";
                                        }
                                     }
                                     $("select#machine-oilgunids").html(htmldata);});
                                '
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]) ?>
                    <?= $form->field($model, 'oilgunids')->widget(\kartik\widgets\Select2::classname(), [
                        //'data' =>[],
                        //'language' => 'Zh-cn',
                        'data'=>yii\helpers\ArrayHelper::map( \backend\models\Oilgun::find()->select(['id','number'])->where('flag=\'开启\'')->andWhere(['in','id',explode(',',$model->oilgunids)])->asArray()->all(), 'id', 'number'),
                        'options' => ['placeholder' => '选择油枪 ...', 'multiple' => true,'value'=>explode(',',$model->oilgunids), ],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                    ]) ?>
                    <?php // $form->field($model, 'oilgunid')->textInput() ?>
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