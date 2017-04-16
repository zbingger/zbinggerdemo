<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MerchantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options'=>['autocomplete'=>'off',],
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'uid') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'actived_at') ?>

    <?php // echo $form->field($model, 'actived_code') ?>
    <?php echo $form->field($model, 'username')->textInput()->label('商户账号') ?>

    <?php echo  $form->field($model, 'name')->textInput() ?>
    <?php // echo $form->field($model, 'weixin_rate') ?>

    <?php // echo $form->field($model, 'alipay_rate') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'contactor') ?>

    <?php // echo $form->field($model, 'prov') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'dist') ?>

    <?php // echo $form->field($model, 'adress') ?>

    <?php // echo $form->field($model, 'weixinpubid') ?>

    <?php // echo $form->field($model, 'weixinsellerid') ?>

    <?php // echo $form->field($model, 'lisences') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'pic1') ?>

    <?php // echo $form->field($model, 'openlicences') ?>

    <?php // echo $form->field($model, 'status_acount') ?>

    <?php // echo $form->field($model, 'status_wxpay') ?>

    <?php // echo $form->field($model, 'status_wxpub') ?>

    <?php // echo $form->field($model, 'status_alipay') ?>
    <?php echo $form->field($model, 'status_acount')->dropDownList(['草稿' => '草稿', '通过' => '通过',], ['prompt' => '请选择审核状态...']) ?>
    <?php echo $form->field($model, 'status_wxpay')->dropDownList(['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '请选择审核状态...']) ?>

    <?php echo $form->field($model, 'status_wxpub')->dropDownList(['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '请选择审核状态...']) ?>

    <?php echo $form->field($model, 'status_alipay')->dropDownList(['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '请选择审核状态...']) ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .form-group {
        margin-bottom:0;
        width: 200px;
        float: left;
    }
    .form-group:last-child {
        margin-bottom: 15px;
        width: 200px;
        float: none;
    }

</style>