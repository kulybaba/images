<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\User */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Edit profile';
?>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'username'); ?>

    <?php echo $form->field($model, 'about'); ?>
    
    <?php echo $form->field($model, 'nickname'); ?>

    <?php echo Html::submitButton('Edit', [
        'class' => 'btn btn-default',
    ]); ?>

<?php ActiveForm::end(); ?>

<br>
<br>