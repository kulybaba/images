<?php
/* @var $this yii\web\View */
/* @var $model frontend\modules\post\model\Comment */
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('post', 'Update comment');
?>

<?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'text')->label(Yii::t('post', 'Comment'));; ?>

    <?php echo Html::submitButton(Yii::t('post', 'Update'), [
        'class' => 'btn btn-default',
    ]); ?>

<?php ActiveForm::end(); ?>