<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use \backend\models\Region;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MerchantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="merchant-index">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('新增商户', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,

                'columns' => [
                    ['class' => \kartik\grid\CheckboxColumn::className(),'attribute'=>'uid',],
                    ['class' => 'yii\grid\SerialColumn'],
                    ['label' => '商户账号', 'attribute' => 'username', 'value' => 'user.username'
                        , 'filter' => Html::activeTextInput($searchModel, 'username', ['class' => 'form-control'])],
                    'name',

                    [ 'attribute' => 'actived_code','options'=>['width'=>80],],
                    // 'password',

                    [
                        'label' => '商户类型',
                        'attribute' => 'category_id',
                        'value' => function ($model) {
                            $state = ['个体' => '个体', '公司' => '公司',];
                            return $state[$model->category_id];
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'category_id', ['个体' => '个体', '公司' => '公司',], ['prompt' => '全部', 'class' => 'form-control']),
                        'headerOptions' => ['width' => '80']
                    ],
                    'contactor',

                    ['label' => 'Email', 'attribute' => 'email', 'value' => 'user.email'
                        , 'filter' => Html::activeTextInput($searchModel, 'email', ['class' => 'form-control']), 'headerOptions' => ['width' => '120']],
                    [
                        'label' => '账户状态',
                        'attribute' => 'status_acount',
                        'value' => function ($model) {
                            $state = [
                                '草稿' => '草稿',
                                '通过' => '通过',
                            ];
                            return $state[$model->status_acount];
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'status_acount', ['草稿' => '草稿', '通过' => '通过',], ['prompt' => '全部', 'class' => 'form-control']),
                        'headerOptions' => ['width' => '80']
                    ],
                    [
                        'label' => '微信支付状态',
                        'attribute' => 'status_wxpay',
                        'value' => function ($model) {
                            $state = [
                                '草稿' => '草稿',
                                '审核中' => '审核中',
                                '通过' => '通过',
                            ];
                            return $state[$model->status_wxpay];
                        },
                        'options'=>['width'=>60],
                        'filter' => Html::activeDropDownList($searchModel, 'status_wxpay', ['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '全部', 'class' => 'form-control']),
                        //'headerOptions'=>['colspan' => 3],
                        //'filterOptions'=>['colspan' => 3,],
                        //'contentOptions'=>['colspan' => 3,],
                    ],
                    [
                        'label' => '公众号状态',
                        'attribute' => 'status_wxpub',
                        'value' => function ($model) {
                            $state = [
                                '草稿' => '草稿',
                                '审核中' => '审核中',
                                '通过' => '通过',
                            ];
                            return $state[$model->status_wxpub];
                        },
                        'options'=>['width'=>60],
                        'filter' => Html::activeDropDownList($searchModel, 'status_wxpub', ['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '全部', 'class' => 'form-control']),
                        //'contentOptions'=>['visible' =>false,],

                    ],
                    [
                        'label' => '支付宝状态',
                        'attribute' => 'status_alipay',
                        'value' => function ($model) {
                            $state = [
                                '草稿' => '草稿',
                                '审核中' => '审核中',
                                '通过' => '通过',
                            ];
                            return $state[$model->status_alipay];
                        },
                        'options'=>['width'=>60],
                        'filter' => Html::activeDropDownList($searchModel, 'status_alipay', ['草稿' => '草稿', '审核中' => '审核中', '通过' => '通过',], ['prompt' => '全部', 'class' => 'form-control']),
                        //'contentOptions'=>['colspan' => 3,],

                    ],
                    [ 'attribute' => 'weixin_rate','options'=>['width'=>80],],
                    [ 'attribute' => 'alipay_rate','options'=>['width'=>80],],

                    [
                        'options'=>['width'=>80],
                        'label' => '激活时间',
                        'filter' => false, //不显示搜索框
                        'format' => ['date', 'php:Y-m-d'],
                        'value' => 'actived_at',
                        'headerOptions' => ['width' => '80']
                    ],
                    [
                        'label' => '详细地址',
                        'attribute' => 'adress',
                        'value' => function ($model) {
                            $address = Region::getRegion(1)[$model->prov] . Region::getRegion($model->prov)[$model->city] . Region::getRegion($model->city)[$model->dist] . $model->address;
                            return $address;
                        },
                        'headerOptions' => ['width' => '320',]

                    ],
                    [
                        //动作列yii\grid\ActionColumn
                        //用于显示一些动作按钮，如每一行的更新、删除操作。
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'template' => '{view} {update} {delete} ',//只需要展示删除和更新
                        'options'=>['width'=>170],
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fa glyphicon glyphicon-eye-open"></i>详细 ',
                                    ['view', 'id' => $key],
                                    [
                                        //'class' => 'btn btn-default btn-xs',
                                    ]
                                );
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fa glyphicon glyphicon-pencil"></i>编辑',
                                    ['update', 'id' => $key],
                                    [
                                        // 'class' => 'btn btn-default btn-xs',
                                    ]
                                );
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-ban"></i> 删除',
                                    ['delete', 'id' => $key],
                                    [
                                        //'class' => 'btn btn-default btn-xs',
                                        'data' => ['confirm' => '你确定要删除文章吗？',]
                                    ]
                                );
                            },
                        ],
                    ],

                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>