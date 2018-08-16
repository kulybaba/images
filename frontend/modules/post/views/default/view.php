<?php
/* @var $this yii\web\View */
/* @var post frontend\model\Post */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="post-default-index">
    
    <div class="row">
        
        <div class="col-md-12">
            <?php if ($post->user): ?>
                <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => $post->user->getNickname()]); ?>"><?php echo $post->user->username; ?></a>
            <?php endif; ?>
        </div>
        
        <div class="col-md-12">
            <img src="<?php echo $post->getImage(); ?>">
        </div>
        
        <div class="col-md-12">
            <?php echo Html::encode($post->description); ?>
        </div>
        
    </div>    
    
</div>

