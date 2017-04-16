<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */

$this->title = '修改 员工: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '员工管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="employee-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
