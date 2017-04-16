<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Store */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '油站管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">油站信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="store-view">

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'merchant_id',
                        'number',
                        'name',
                        'telphone',
                        'area',
                        'address',
                        'point',
                        'created_at',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>