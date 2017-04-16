<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MachineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '机具管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title">机具管理</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="machine-index">


                <p>
                    <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'number',
                        'imei',
                        ['label' => '所属门店', 'value' => function ($model) {
                            return $model->store->name;
                        }],
                        ['label' => '绑定油枪', 'value'=> function ($model) {
                           $list = backend\models\Oilgun::find()->where(['in','id', explode(',', $model->oilgunids)])->select(['number'])->asArray()->column();
                           $str='';
                           foreach ($list as $item){
                               $str.=$item.';';
                           }
                            return $str;

                        }],//'oilgunids',
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
                        // ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>