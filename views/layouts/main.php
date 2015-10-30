<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="google-site-verification" content="iJ3K3Vc_uY0yFkJU3RP7ddrlOuaWuGbBkY5dWuWPfsc" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Bet v Bet - <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= Html::a('Bet v Bet', ['/site/index'], ['class' => 'navbar-brand']); ?>
            </div>
            <div class="navbar-collapse collapse navbar-inverse-collapse">
                <ul class="nav navbar-nav">
                    <li><?= Html::a('Football', ['/football/index'], []); ?></li>
                    <li><?= Html::a('Rugby', ['/rugby/index'], []); ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li><?= Html::a('Sign Up', ['/site/register'], []); ?></li>
                        <li><?= Html::a('Log In', ['/site/login'], []); ?></li>
                    <?php else: ?>

                        <li class="dropdown">
                            <a href="javascript:void(0)" data-target="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo Html::encode(Yii::$app->user->identity->email); ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">Action</a></li>
                                <li><a href="javascript:void(0)">Another action</a></li>
                                <li><a href="javascript:void(0)">Something else here</a></li>
                                <li class="divider"></li>
                                 <li><?= Html::a("Logout", ['/site/logout']); ?></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php if (Yii::$app->getSession()->hasFlash('success')): ?>
            <div class="alert alert-success">
                <?php echo Yii::$app->getSession()->getFlash('success'); ?>
            </div>
        <?php endif ?>

        <?php if (Yii::$app->getSession()->hasFlash('warning')): ?>
            <div class="alert alert-warning">
                <?php echo Yii::$app->getSession()->getFlash('warning'); ?>
            </div>
        <?php endif ?>

        <?php if (Yii::$app->getSession()->hasFlash('danger')): ?>
            <div class="alert alert-danger">
                <?php echo Yii::$app->getSession()->getFlash('danger'); ?>
            </div>
        <?php endif ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
