<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Merchant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="merchant-index">

                <div class="merchant-view">

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
                            'uid',
                            'name',
                            'actived_at',
                            'actived_code',
                            'weixin_rate',
                            'alipay_rate',
                            'category_id',
                            'contactor',
                            'prov',
                            'city',
                            'dist',
                            'adress',
                            'weixinpubid',
                            'weixinsellerid',
                            [
                                'attribute' => 'lisences',
                                'format' => ['raw', ['width' => '30', 'height' => '30',]],
                                'value' => function ($model) {
                                    return Html::img($model->lisences);
                                }

                            ],
                            [
                                'attribute' => 'pic',
                                'format' => ['raw', ['width' => '30', 'height' => '30',]],
                                'value' => function ($model) {
                                    return Html::img($model->pic);
                                }

                            ],
                            [
                                'attribute' => 'pic1',
                                'format' => ['raw', ['width' => '30', 'height' => '30',]],
                                'value' => function ($model) {
                                    return Html::img($model->pic1);
                                }

                            ],

                            [
                                'attribute' => 'openlicences',
                                'format' => ['raw', ['width' => '30', 'height' => '30',]],
                                'value' => function ($model) {
                                    return Html::img($model->openlicences);
                                }

                            ],
                            'status_acount',
                            'status_wxpay',
                            'status_wxpub',
                            'status_alipay',
                        ],
                    ]) ?>

            </div>
        </div>
    </div>
</div>
