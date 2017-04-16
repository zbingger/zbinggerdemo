<?php
/**
 * Created by PhpStorm.
 * User: masterpc
 * Date: 17-3-14
 * Time: 下午10:07
 */

namespace console\controllers;

use common\models\User;


class InitController extends \yii\console\Controller
{
    /**
     * init user info
     */
    public function actionUser()
    {
        echo "create init UserInfo\n";
        $username = $this->prompt("input a username:");
        $email = $this->prompt("input a email for $username:");
        $password = $this->prompt("input a password for $username:");

        $model = new User();
        $model->username = $username;
        $model->password = $password;
        $model->email = $email;
        $model->generateAuthKey();
        $model->generatePasswordResetToken();
        if (!$model->save()) {
            foreach ($model->getErrors() as $errors) {
                foreach ($errors as $error) {
                    echo "$error\n";
                }
            }
            return 1;
        }
        return 0;

    }

}
