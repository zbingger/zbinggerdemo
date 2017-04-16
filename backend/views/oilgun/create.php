<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Oilgun */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '油枪管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oilgun-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
