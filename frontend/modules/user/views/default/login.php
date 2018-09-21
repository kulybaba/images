<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <p><?php echo Yii::t('user', 'Please fill out the following fields to login:'); ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->label(Yii::t('user', 'Email'))->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->label(Yii::t('user', 'Password'))->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->label(Yii::t('user', 'Remember Me'))->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <?php echo Yii::t('user', 'If you forgot your password you can'); ?> <?= Html::a(Yii::t('user', 'reset it'), ['/user/default/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-default', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-5">
            <b><?php echo Yii::t('user', 'Login with Google'); ?></b>
            <?= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['/user/default/auth'],
                'popupMode' => false,
            ]) ?>
        </div>
    </div>
</div>
<br>
<br>
