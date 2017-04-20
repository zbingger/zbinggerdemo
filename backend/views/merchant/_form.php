<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\models\Region;

/* @var $this yii\web\View */
/* @var $user common\models\User*/
/* @var $merchant backend\models\Merchant */
/* @var $form yii\widgets\ActiveForm */

$url = \yii\helpers\Url::toRoute(['get-region']);

/*
 *$list = common\models\User::find()->select(['username'])->
where('status=10')->
where(['not in', 'id', Yii::$app->params['superuser'],])->column();
*/
$validationUrl = ['validate-form'];
if (!$merchant->isNewRecord) {
    $validationUrl = ['validate-formm'];
   $validationUrl['id'] = $merchant->uid;
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">商户信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="merchant-form ">
                <div class="box-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'merchant-form',
                        'options' => ['class' => 'form-horizontal','autocomplete'=>'off', 'enctype' => 'multipart/form-data'],
                        'enableAjaxValidation' => true,
                        //'enableClientValidation'=>true,
                        'validationUrl' => \yii\helpers\Url::toRoute($validationUrl),
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-sm-7\">{input}</div>\n<div class=\"col-sm-3\">{error}</div>",
                            'labelOptions' => ['class' => 'col-sm-2 control-label'],
                        ]
                    ]); ?>

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基本信息</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">状态信息</a></li>
                            <!--<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Tab 3</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">

                                <?= $form->field($user, 'username')->textInput(['maxlength' => true])->label('商户账号') ?>
                                <?= $form->field($user, 'email')->textInput(['maxlength' => true])->label('Email') ?>
                                <?= $form->field($merchant, 'password')->passwordInput(['maxlength' => true])?>
                                <?= $form->field($merchant, 'confirmPassword')->passwordInput(['maxlength' => true])->label('重复密码')?>
                                <?= $form->field($merchant, 'name')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($merchant, 'contactor')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($merchant, 'prov')->widget(\chenkby\region\Region::className(), [
                                    'model' => $merchant,
                                    'url' => $url,
                                    'province' => [
                                        'attribute' => 'prov',
                                        'items' => Region::getRegion(1),
                                        'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:300px; display:inline-block', 'prompt' => '选择省份']
                                    ],
                                    'city' => [
                                        'attribute' => 'city',
                                        'items' => Region::getRegion($merchant['prov']),
                                        'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:300px; display:inline-block', 'prompt' => '选择城市']
                                    ],
                                    'district' => [
                                        'attribute' => 'dist',
                                        'items' => Region::getRegion($merchant['city']),
                                        'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:300px; display:inline-block', 'prompt' => '选择县/区']
                                    ]
                                ])->label('所在省市地区') ?>

                                <?= $form->field($merchant, 'address')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($merchant, 'category_id')->dropDownList(['个体' => '个体', '公司' => '公司',], ['prompt' => '请选择经营主体...']) ?>

                                <?= $form->field($merchant, 'weixinpubid')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($merchant, 'weixinsellerid')->textInput(['maxlength' => true]) ?>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane " id="tab_2">
                                <?= $form->field($merchant, 'lisences')->fileInput() ?>
                                <?= $form->field($merchant, 'pic')->fileInput() ?>
                                <?= $form->field($merchant, 'pic1')->fileInput() ?>
                                <?= $form->field($merchant, 'openlicences')->fileInput() ?>

                                <?= $form->field($merchant, 'actived_code')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($merchant, 'weixin_rate')->textInput() ?>

                                <?= $form->field($merchant, 'alipay_rate')->textInput() ?>

                                <?= $form->field($merchant, 'status_acount')->dropDownList(['草稿' => '草稿', '通过' => '通过',], ['prompt' => '请选择审核状态...']) ?>

                                <?= $form->field($merchant, 'status_wxpay')->dropDownList(['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '请选择审核状态...']) ?>

                                <?= $form->field($merchant, 'status_wxpub')->dropDownList(['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '请选择审核状态...']) ?>

                                <?= $form->field($merchant, 'status_alipay')->dropDownList(['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '请选择审核状态...']) ?>

                            </div>

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>


                    <div class="box-footer">
                        <div class="form-group">
                            <?= Html::submitButton($merchant->isNewRecord ? '新增' : '修改', ['class' => $merchant->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
        <!--<div class="col-md-6"></div>-->
    </div>
