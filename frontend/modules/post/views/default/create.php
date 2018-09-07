<?php
/* @var $this yii\web\View */
/* @var model frontend\modules\post\model\forms\PostForm */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create post';
?>

<div class="post-default-index">
    
    <?php $form = ActiveForm::begin(); ?>
    
        <?php echo $form->field($model, 'picture')->label('Select picture', [
            'class' => 'btn btn-primary'
        ])->fileInput(['class' => 'sr-only']); ?>
    
        <?php echo $form->field($model, 'description'); ?>
    
        <?php echo Html::submitButton('Create', [
            'class' => 'btn btn-default',
        ]); ?>
    
    <?php ActiveForm::end(); ?>
    
</div>