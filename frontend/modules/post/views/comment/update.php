<?php
/* @var $this yii\web\View */
/* @var $model frontend\modules\post\model\Comment */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Update comment';
?>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'text'); ?>

    <?php echo Html::submitButton('Update', [
        'class' => 'btn btn-default',
    ]); ?>

<?php ActiveForm::end(); ?>