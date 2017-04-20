<?php

namespace backend\controllers;


use Yii;
use backend\models\Merchant;
use backend\models\MerchantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use \backend\models\Region;
use yii\web\UploadedFile;

/**
 * MerchantController implements the CRUD actions for Merchant model.
 */
class MerchantController extends Controller
{


    public function actions()
    {
        $actions = parent::actions();
        if (Yii::$app->getUser()->isGuest) {
            $this->goHome();
        }
        $actions['get-region'] = [
            'class' => \chenkby\region\RegionAction::className(),
            'model' => Region::className()
        ];
        return $actions;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Merchant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MerchantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->pagination->defaultPageSize =2;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Merchant model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Merchant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = new User();
        $merchant = new Merchant();
        $user->setScenario('add');
        $merchant->setScenario('add');
        $merchant->loadDefaultValues();
        if ($user->load(Yii::$app->request->post()) && $merchant->load(Yii::$app->request->post())) {
            //var_dump($merchant->weixinsellerid);exit;
            $merchant->pic = UploadedFile::getInstance($merchant, 'pic');
            $merchant->pic1 = UploadedFile::getInstance($merchant, 'pic1');
            $merchant->lisences = UploadedFile::getInstance($merchant, 'lisences');
            $merchant->openlicences = UploadedFile::getInstance($merchant, 'openlicences');

            $isValid = $user->validate();
            $isValid = $merchant->validate() && $isValid;

            if ($isValid) {
                $user->setPassword($merchant->confirmPassword);
                $user->generateAuthKey();
                $user->save(false);
                $merchant->uid = $user->id;
                $merchant->save(false);
                return $this->redirect(['view', 'id' => $merchant->id]);
            }
        }
        return $this->render('create', [
            'merchant' => $merchant,
            'user' => $user,
        ]);

    }

    /**
     * @return array
     */
    public function actionValidateForm()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new User();
        $model->setScenario('add');
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
        /*            $id=null          return \yii\widgets\ActiveForm::validate($model);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $id === null ? new User() : User::findOne($id);

        if ($model->isNewRecord) {
            $model->setScenario('add');
        } else {
            $model->setScenario('update');
        }
        $model->load(Yii::$app->request->post());
         */
    }

    /**
     * @return array
     */
    public function actionValidateFormm($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = User::findOne($id);
        $model->setScenario('update');
        $model->load(Yii::$app->request->post());
        //return $model->validate();
        return \yii\widgets\ActiveForm::validate($model);

    }

    /**
     * Updates an existing Merchant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $merchant = $this->findModel($id);
        $user = User::findOne($merchant->uid);
        if (!isset($user, $merchant)) {
            throw new NotFoundHttpException("The user was not found.");
        }
        $user->setScenario('update');
        $merchant->setScenario('update');
        // var_dump($user,$merchant);exit;

        if ($user->load(Yii::$app->request->post()) && $merchant->load(Yii::$app->request->post())) {

            $isValid = $user->validate();
            $isValid = $merchant->validate() && $isValid;

            if ($isValid) {
                //var_dump($merchant->password);exit;
                $user->setPassword($merchant->password);
                $user->save(false);
                $merchant->save(false);
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('update', [
            'merchant' => $merchant,
            'user' => $user,
        ]);

    }

    /**
     * Deletes an existing Merchant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Merchant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Merchant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Merchant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
