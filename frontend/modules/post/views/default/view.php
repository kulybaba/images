<?php
/* @var $this yii\web\View */
/* @var $post frontend\model\Post */
/* @var $currentUser frontend\models\User */
/* @var $comments frontend\modules\post\models\Comment */
/* @var $countComments frontend\modules\post\models\Comment */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
?>

<div class="post-default-index">
    
    <div class="row">
        
        <div class="col-md-12">
            <?php if ($post->user): ?>
                <h3>
                    <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => $post->user->getNickname()]); ?>">
                        <?php echo $post->user->username; ?>
                    </a>
                </h3>
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
    
    <div class="col-md-12">
        
        <hr>

        <a href="<?php echo Url::to(['/post/comment/create', 'post_id' => $post->id]); ?>" class="btn btn-primary">
                Create comment
        </a>
        
    </div>
    
    <div class="col-md-12">
        
        <?php if ($comments): ?>
        
            <h3>Comments (<?php echo $countComments; ?>):</h3>
            
            <?php foreach ($comments as $item): ?>
                <?php if ($item->user): ?>
                    <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => $item->user->getNickname()]); ?>">
                        <?php echo $item->user->username; ?>
                    </a>
                <?php endif; ?>

                <?php echo Yii::$app->formatter->asDatetime($item->created_at); ?>
                <br>
                <?php echo Html::encode($item->text); ?>
                <br>

                <?php if ($currentUser && $currentUser->id == $item->user_id): ?>
                    <a href="<?php echo Url::to(['/post/comment/update', 'comment_id' => $item->id, 'post_id' => $post->id]); ?>">Update</a>
                    <a href="<?php echo Url::to(['/post/comment/delete', 'comment_id' => $item->id, 'post_id' => $post->id]); ?>">Delete</a>
                    <br>
                <?php elseif ($currentUser && $currentUser->id == $post->user_id): ?>
                    <a href="<?php echo Url::to(['/post/comment/delete', 'comment_id' => $item->id, 'post_id' => $post->id]); ?>">Delete</a>
                    <br>
                <?php endif; ?>

                <br>

            <?php endforeach; ?>  
                
        <?php endif; ?>
            
    </div>
    
</div>

<?php $this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::className(),
]);
