<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Worktime */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '班次管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worktime-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
