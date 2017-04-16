<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \backend\models\Region;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MerchantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="merchant-index">
            <div class="box-body">
                <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

                <p>
                    <?= Html::a('新增商户', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        //'username',

                        ['label' => '商户账号', 'attribute' => 'username', 'value' => 'u.username'
                            , 'filter' => Html::activeTextInput($searchModel, 'username', ['class' => 'form-control'])],
                        /* ['label' => '商户账号',
                         'attribute' => 'uid',
                         'value' => function ($model) {
                             $user = \common\models\User::findOne($model->uid);
                             return $user->username;
                         },
                         'headerOptions' => ['width' => '120']
                     ],
                        */
                        'name',
                        'actived_code',
                        'weixin_rate',
                        'alipay_rate',
                        // 'password',
                        'category_id',
                        'contactor',
                        //'email',
                        [
                            'label' => 'Email',
                            'attribute' => 'uid',
                            'value' => function ($model) {
                                $user = \common\models\User::findOne($model->uid);
                                return $user->email;
                            },
                            'headerOptions' => ['width' => '120']
                        ],
                        // 'prov',
                        // 'city',
                        // 'dist',
                        //'adress',
                        [
                            'label' => '详细地址',
                            'attribute' => 'adress',
                            'value' => function ($model) {
                                $address = Region::getRegion(0)[$model->prov] . Region::getRegion($model->prov)[$model->city] . Region::getRegion($model->city)[$model->dist] . $model->adress;
                              return $address;
                            },
                            'headerOptions' => ['width' => '320']
                        ],
                        // 'weixinpubid',
                        // 'weixinsellerid',
                        // 'lisences',
                        // 'pic',
                        // 'pic1',
                        // 'openlicences',
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
                            'headerOptions' => ['width' => '80']
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
                            'headerOptions' => ['width' => '80']
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
                            'headerOptions' => ['width' => '80']
                        ],
                        [
                            'label' => '激活时间',
                            'filter' => false, //不显示搜索框
                            'format' => ['date', 'php:Y-m-d'],
                            'value' => 'actived_at'
                        ],
                        [
                            //动作列yii\grid\ActionColumn
                            //用于显示一些动作按钮，如每一行的更新、删除操作。
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{view} {update} {delete} ',//只需要展示删除和更新
                            'headerOptions' => ['width' => '140'],
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
</div>