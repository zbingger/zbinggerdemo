<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Merchant */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '商户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-create">
    <?= $this->render('_form', [
        'merchant' => $merchant,'user'=>$user,
    ]) ?>

</div>
