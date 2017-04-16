<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '油站管理';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'name',
        'pageSummary' => 'Page Total',
        'vAlign' => 'middle',
        'headerOptions' => ['class' => 'kv-sticky-column'],
        'contentOptions' => ['class' => 'kv-sticky-column'],
        'editableOptions' => ['header' => 'name', 'size' => 'md']
    ],
    /* [
         'attribute'=>'color',
         'value'=>function ($model, $key, $index, $widget) {
             return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" .
                 $model->color . '</code>';
         },
         'filterType'=>GridView::FILTER_COLOR,
         'vAlign'=>'middle',
         'format'=>'raw',
         'width'=>'150px',
         'noWrap'=>true
     ],
    */
    'number',

    'merchant_id',

    'telphone',
    /* [
         'class'=>'kartik\grid\BooleanColumn',
         'attribute'=>'status',
         'vAlign'=>'middle',
     ],
    */
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return '#';
        },
        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
        'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['title' => $deleteMsg, 'data-toggle' => 'tooltip'],
    ],
    ['class' => 'kartik\grid\CheckboxColumn'],
];
?>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php /* echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    /*'beforeHeader' => [
                        [
                            'columns' => [
                                ['content' => 'Header Before 1', 'options' => ['colspan' =>2, 'class' => 'text-center warning']],
                                ['content' => 'Header Before 2', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                ['content' => 'Header Before 3', 'options' => ['colspan' => 2, 'class' => 'text-center warning']],
                            ],
                            'options' => ['class' => 'skip-export'] // remove this row from export
                        ]
                    ],

                    'toolbar' => [
                        ['content' =>
                            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                        ],
                        '{export}',
                        '{toggleData}'
                    ],
                    'pjax' => true,
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'floatHeader' => true,
                    'floatHeaderOptions' => ['scrollingTop' => 50],
                    'showPageSummary' => true,
                    'panel' => [
                        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i>油站列表</h3>',
                        'type'=>'success',
                        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> 新增', ['create'], ['class' => 'btn btn-success']),
                        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                        'footer'=>false
                    ],
                    'condensed'=>1,
                ]);
                    */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-default ">
            <div class="box-header with-border">
                <h3 class="box-title"> 油站管理</h3>
            </div>
            <!-- /.box - header-->
            <!--form start-->
            <div class="store-index"><p>
                    <?= Html::a('新增油站', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',

                        'number',
                        'name',
                        'telphone',
                        [
                            'label' => '所属门店',
                            'value' => function ($model) {
                                return $model->merchant->name;
                            }
                        ],
                        // 'area',
                        // 'address',
                        // 'point',
                        // 'created_at',
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
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
