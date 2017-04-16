<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Store */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '油站管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
