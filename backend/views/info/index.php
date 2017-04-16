<?php
/**
 * Created by PhpStorm.
 * Author: zbing
 * Date: 17-4-7
 * Time: 上午10:17
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\models\Region;

/* @var $this yii\web\View */
/* @var $model backend\models\Merchant */
/* @var $form yii\widgets\ActiveForm */

$url = \yii\helpers\Url::toRoute(['get-region']);
$this->title = '设置';
$this->params['breadcrumbs'][] = ['label' => '个人资料', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">个人资料</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="merchant-form ">
                <div class="box-body">
                    <?php $form = ActiveForm::begin([
                        'action' => 'update/' . $model->id,
                        'id' => 'form-info',
                        'options' => ['class' => 'form-horizontal', 'autocomplete'=>'off'],
                        'enableAjaxValidation' => true,
                        'validationUrl' => yii\helpers\Url::toRoute(['validate-form']),
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-sm-1 control-label'],
                        ]
                    ]); ?>

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基本信息</a></li>
                            <!--<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">状态信息</a></li>-->

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <?= Html::activeHiddenInput($model,'oldusername')?>
                                <?= Html::activeHiddenInput($model,'oldemail')?>
                                <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('账户名称') ?>
                                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'value'=>''])->label('登录密码') ?>
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'contactor')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true,]) ?>
                                <?= $form->field($model, 'prov')->widget(\chenkby\region\Region::className(), [
                                    'model' => $model,
                                    'url' => $url,
                                    'province' => [
                                        'attribute' => 'prov',
                                        'items' => Region::getRegion(),
                                        'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:354px; display:inline-block', 'prompt' => '选择省份']
                                    ],
                                    'city' => [
                                        'attribute' => 'city',
                                        'items' => Region::getRegion($model['prov']),
                                        'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:354px; display:inline-block', 'prompt' => '选择城市']
                                    ],
                                    'district' => [
                                        'attribute' => 'dist',
                                        'items' => Region::getRegion($model['city']),
                                        'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:355px; display:inline-block', 'prompt' => '选择县/区']
                                    ]
                                ])->label('所在省市地区') ?>

                                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'category_id')->dropDownList(['个体' => '个体', '公司' => '公司',], ['prompt' => '请选择经营主体...']) ?>

                            </div>

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>


                    <div class="box-footer">
                        <div class="form-group">
                            <?= Html::submitButton('修改', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
        <!--<div class="col-md-6"></div>-->
    </div>

