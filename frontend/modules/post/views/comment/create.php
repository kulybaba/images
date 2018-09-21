<?php
/* @var $this yii\web\View */
/* @var model frontend\modules\post\model\forms\CommentForm */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('post', 'Create comment');
?>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'text')->label(Yii::t('post', 'Comment')); ?>

    <?php echo Html::submitButton(Yii::t('post', 'Create'), [
        'class' => 'btn btn-default',
    ]); ?>

<?php ActiveForm::end(); ?>