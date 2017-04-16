<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Oilgun */

$this->title = '修改: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '油枪管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="oilgun-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
