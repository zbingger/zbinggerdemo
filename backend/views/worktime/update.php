<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Worktime */

$this->title = 'Update Worktime: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Worktimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="worktime-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
