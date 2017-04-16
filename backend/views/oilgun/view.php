<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Oilgun */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '油枪管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">油枪信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="oilgun-view">

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
                        'oil_id',
                        'store_id',
                        'flag',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>