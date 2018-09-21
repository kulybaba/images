<?php
/* @var $this yii\web\View */
/* @var model frontend\modules\post\model\forms\PostForm */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('post' ,'Create post');
?>

<div class="post-default-index">
    
    <?php $form = ActiveForm::begin(); ?>
    
        <?php echo $form->field($model, 'picture')->label(Yii::t('post', 'Select picture'), [
            'class' => 'btn btn-primary'
        ])->fileInput(['class' => 'sr-only']); ?>
    
        <?php echo $form->field($model, 'description')->label(Yii::t('post', 'Description')); ?>
    
        <?php echo Html::submitButton(Yii::t('post', 'Create'), [
            'class' => 'btn btn-default',
        ]); ?>
    
    <?php ActiveForm::end(); ?>
    
</div>