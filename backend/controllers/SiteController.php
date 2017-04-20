<?php

namespace backend\controllers;

use yii;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\RegisterForm;
use \backend\models\Region;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','get-region', 'register','add','error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {

        $actions = parent::actions();

        $actions['get-region'] = [
            'class' => \chenkby\region\RegionAction::className(),
            'model' => Region::className(),

        ];
        $actions['error'] = ['class' => 'yii\web\ErrorAction',];
        return $actions;
        /* return [
             'error' => [
                 'class' => 'yii\web\ErrorAction',
             ],
         ];
        */
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionRegister()
    {
        $this->layout = 'main-login';
        $model = new RegisterForm();
        $model->category_id ='个体';

        return $this->render('register', [
            'model' => $model,
        ]);
    }
    public function actionAdd(){
        $this->layout = 'main-login';
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->pic1= yii\web\UploadedFile::getInstance($model,'pic1');
            $model->pic= yii\web\UploadedFile::getInstance($model,'pic');
            $model->openlicences= yii\web\UploadedFile::getInstance($model,'openlicences');
            $model->lisences= yii\web\UploadedFile::getInstance($model,'lisences');
            if($model->Register()){
                Yii::$app->session->setFlash('regmessages','注册成功！');
                $this->redirect(['site/register']);
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
