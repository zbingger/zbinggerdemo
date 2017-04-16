<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Oil */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '油品管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oil-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
