<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Region;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\RegisterForm */

$url = yii\helpers\Url::toRoute(['get-region']);
$this->title = '商户注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    div.required label:before {
        content: " *";
        color: red;
    }
</style>
<div class="box box-default ">
    <div class="box-header with-border bg-light-blue">
        <h3 class="box-title">商户注册</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="site-signup">
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'action'=> \yii\helpers\Url::to(['site/add']),
                'options' => ['class' => 'form-horizontal','autocomplete' => 'off','enctype' => 'multipart/form-data'],
                //'enableAjaxValidation' => true,
                //'enableClientValidation'=>true,
                //'validationUrl' => \yii\helpers\Url::toRoute($validationUrl),
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-sm-6\">{input}</div>\n<div class=\"col-sm-4\">{error}</div>",
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                ]
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email')->textInput()  ?>
            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

            <?= $form->field($model, 'contactor')->textInput() ?>

            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'category_id')->dropDownList(['个体' => '个体', '公司' => '公司',], ['prompt' => '请选择经营主体...']) ?>
            <?= $form->field($model, 'wxpublicid')->textInput() ?>
            <?= $form->field($model, 'wxsellerid')->textInput() ?>


            <?= $form->field($model, 'prov')->widget(\chenkby\region\Region::className(), [
                'model' => $model,
                'url' => $url,
                'province' => [
                    'attribute' => 'prov',
                    'items' => Region::getRegion(1),
                    'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:290px;display:inline-block', 'prompt' => '选择省份']
                ],
                'city' => [
                    'attribute' => 'city',
                    'items' => Region::getRegion($model['prov']),
                    'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:290px;display:inline-block', 'prompt' => '选择城市']
                ],
                'district' => [
                    'attribute' => 'dist',
                    'items' => Region::getRegion($model['city']),
                    'options' => ['class' => 'form-control form-control-inline', 'style' => 'width:290px;display:inline-block', 'prompt' => '选择县/区']
                ]
            ])->label('所在省市地区') ?>
            <?= $form->field($model, 'address')->textInput() ?>

            <?= $form->field($model, 'lisences')->fileInput() ?>
            <?= $form->field($model, 'pic')->fileInput() ?>
            <?= $form->field($model, 'pic1')->fileInput() ?>
            <?= $form->field($model, 'openlicences')->fileInput() ?>

            <?php //$form->field($model, 'pic')->widget(FileInput::classname(), [                'options' => ['accept' => 'image/*'],]); ?>
            <?php// $form->field($model, 'pic1')->widget(FileInput::classname(), [                'options' => ['accept' => 'image/*'],]); ?>
            <?php//$form->field($model, 'openlicences')->widget(FileInput::classname(), [                'options' => ['accept' => 'image/*'],]); ?>
            <?php// $form->field($model, 'lisences')->widget(FileInput::classname(), [                'options' => ['accept' => 'image/*'],]); ?>
            <div class="box-footer">
                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary center', 'name' => 'signup-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
