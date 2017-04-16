<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Machine */

$this->title = '修改 机具: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '机具管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="machine-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
