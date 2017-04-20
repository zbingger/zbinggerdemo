<?php
use yii\helpers\Html;
use common\models\User;

/* @var $this \yii\web\View */
/* @var $content string */

if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
    if (Yii::$app->user->id == 0) return;
    $username = User::findIdentity(Yii::$app->user->id)->getAttribute('username');
    $userrole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        //app\assets\AppAsset::register($this);
    }
    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition <?= \dmstr\helpers\AdminLteHelper::skinClass() ?> sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset, 'username' => $username, 'userrole' => $userrole,]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset, 'username' => $username,]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
