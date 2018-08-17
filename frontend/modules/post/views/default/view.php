<?php
/* @var $this yii\web\View */
/* @var $post frontend\model\Post */
/* @var $currentUser frontend\models\User */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
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
    
    <hr>
    
    <div class="col-md-12">
        
        Like: <span class="likes-count"><?php echo $post->countLikes(); ?></span>
        
        <a href="#" class="btn btn-primary button-like <?php echo ($currentUser && $post->isLikedBy($currentUser)) ? "display-none" : ""; ?>" data-id="<?php echo $post->id; ?>">
            Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
        </a>
        <a href="#" class="btn btn-primary button-unlike <?php echo ($currentUser && $post->isLikedBy($currentUser)) ? "" : "display-none"; ?>" data-id="<?php echo $post->id; ?>">
            Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
        </a>

    </div>
    
</div>

<?php $this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::className(),
]);
