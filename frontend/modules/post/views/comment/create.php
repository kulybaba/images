<?php
/* @var $this yii\web\View */
/* @var model frontend\modules\post\model\forms\CommentForm */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create comment';
?>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'text'); ?>

    <?php echo Html::submitButton('Create', [
        'class' => 'btn btn-default',
    ]); ?>

<?php ActiveForm::end(); ?>