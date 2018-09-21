<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\User */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('profile', 'Edit profile');
?>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'username')->label(Yii::t('profile', 'Username')); ?>

    <?php echo $form->field($model, 'about')->label(Yii::t('profile', 'About')); ?>
    
    <?php echo $form->field($model, 'nickname')->label(Yii::t('profile', 'Nickname')); ?>

    <?php echo Html::submitButton(Yii::t('profile', 'Edit'), [
        'class' => 'btn btn-default',
    ]); ?>

<?php ActiveForm::end(); ?>

<br>
<br>