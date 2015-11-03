<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Register';
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "
            <div class=\"form-group\">
                {label}\n
                <div class=\"col-md-4\">\n
                    {input}\n
                </div>\n
                <div class=\"col-md-6\">\n
                    {error}\n
                </div>\n
            </div>",
        'labelOptions' => ['class' => 'col-md-2 control-label'],
        'inputOptions' => ['class' => 'form-control'],
    ],
]); ?>

<div class="well">
    <h1>Register an Account</h1>
    <br /><br />
    <h2>Account Details</h2>
    <hr>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'emailConfirm') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'passwordConfirm')->passwordInput() ?>
    <h2>About You</h2>
    <hr>
    <?= $form->field($model, 'title')->dropDownList([
        'Mr' => 'Mr',
        'Mrs' => 'Mrs',
        'Ms' => 'Ms',
        'Miss' => 'Miss'
        ]) ?>
    <?= $form->field($model, 'firstname') ?>
    <?= $form->field($model, 'middlename', ['inputOptions' => [
        'class' => 'form-control floating-label',
        'placeholder' => 'Optional']]) ?>
    <?= $form->field($model, 'lastname') ?>
    <?= $form->field($model, 'dob', ['inputOptions' => ['type' => 'date']]) ?>
    <?= $form->field($model, 'contact') ?>
    <h2>Security</h2>
    <hr>
    <?= $form->field($model, 'security', ['inputOptions' => ['maxlength' => 4]])->passwordInput() ?>
    <?= $form->field($model, 'mother') ?>
    <h2>Playing Preferences</h2>
    <hr>
    <?= $form->field($model, 'currency')->dropDownList([
        'GBP' => 'GBP'
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>

</div>


<?php ActiveForm::end(); ?>
