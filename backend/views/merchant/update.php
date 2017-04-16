<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Merchant */

$this->title = '更新 ' . $user->username;
$this->params['breadcrumbs'][] = ['label' => '商户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $merchant->name, 'url' => ['view', 'id' => $merchant->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="merchant-update">
    <?= $this->render('_form', [
        'merchant' => $merchant,'user'=>$user,
    ]) ?>

</div>
