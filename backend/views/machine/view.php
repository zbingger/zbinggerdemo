<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Machine */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '机具管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">机具信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="machine-view">

                <p>
                    <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
                        'number',
                        'imei',
                        'store_id',
                        'oilgunids',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>