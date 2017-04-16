<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Employee */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '员工管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
