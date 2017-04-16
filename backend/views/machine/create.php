<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Machine */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '机具管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machine-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
