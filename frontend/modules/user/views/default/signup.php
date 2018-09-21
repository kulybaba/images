<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('user', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <p><?php echo Yii::t('user', 'Please fill out the following fields to signup:'); ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->label(Yii::t('user', 'Username'))->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email')->label(Yii::t('user', 'Email')) ?>

                <?= $form->field($model, 'password')->label(Yii::t('user', 'Password'))->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('user', 'Signup'), ['class' => 'btn btn-default', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<br>
<br>
