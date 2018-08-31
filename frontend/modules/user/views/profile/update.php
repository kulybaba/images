<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\User */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>Edit profile</h1>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'username'); ?>

    <?php echo $form->field($model, 'about'); ?>
    
    <?php echo $form->field($model, 'nickname'); ?>

    <?php echo Html::submitButton('Edit', [
        'class' => 'btn btn-primary',
    ]); ?>

<?php ActiveForm::end(); ?>