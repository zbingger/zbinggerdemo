<?php
/**
 * Created by PhpStorm.
 * 商户个人资料设置
 * User: zbing
 * Date: 17-4-7
 * Time: 上午10:01
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use backend\models\Merchant;
use backend\models\Region;
use backend\models\InfoForm;

class InfoController extends Controller
{

    public function actions()
    {
        if(Yii::$app->getUser()->isGuest){
            $this->goHome();
        }
        $actions = parent::actions();
        $actions['get-region'] = [
            'class' => \chenkby\region\RegionAction::className(),
            'model' => Region::className(),
        ];
        return $actions;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model_Merchant = Merchant::find()->where(['uid' => Yii::$app->user->id])->one();
        //$user=User::find()->where(['id'=>$model_Merchant->uid])->one();

        $user = User::findOne($model_Merchant->uid);
        $model = new InfoForm();
        $model->id = $model_Merchant->id;
        $model->username =$model->oldusername = $user->username;
        $model->oldpassword = $model->password = $user->password_hash;
        $model->oldemail = $model->email = $user->email;
        $model->prov = $model_Merchant->prov;
        $model->city = $model_Merchant->city;
        $model->dist = $model_Merchant->dist;
        $model->address = $model_Merchant->adress;
        $model->name = $model_Merchant->name;
        $model->contactor = $model_Merchant->contactor;
        $model->category_id = $model_Merchant->category_id;

        return $this->render($this->action->id, ['model' => $model,]);

    }

    /**
     * @return array
     */
    public function actionValidateForm()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new InfoForm();   //这里要替换成自己的模型类
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            return \yii\widgets\ActiveForm::validate($model);
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function actionUpdate($id)
    {
        $info = new InfoForm();
        if ($info->load(Yii::$app->request->post())) {

            if($model = $info->update($id)){
                $this->redirect(['info/index']);
            }
        }

        return $this->render('index', [
            'model' => $info,]);
    }
}