<?php
/* @var $this yii\web\View */
/* @var $model frontend\modules\post\model\Comment */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>Update comment</h1>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'text'); ?>

    <?php echo Html::submitButton('Update', [
        'class' => 'btn btn-primary',
    ]); ?>

<?php ActiveForm::end(); ?>