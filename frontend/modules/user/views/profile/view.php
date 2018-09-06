<?php 
/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $currentUser frontend\models\User */
/* @var $modelPicture frontend\modules\user\models\forms\PictureForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use dosamigos\fileupload\FileUpload;

$this->title = Html::encode($user->username);
?>
<div class="page-posts no-padding">
    <div class="row">
        <div class="page page-post col-sm-12 col-xs-12 post-82">


            <div class="blog-posts blog-posts-large">

                <div class="row">

                    <!-- profile -->
                    <article class="profile col-sm-12 col-xs-12">                                            
                        <div class="profile-title">
                            
                            <div class="alert alert-success display-none" id="profile-image-success">Profile picture updated!</div>
                            <div class="alert alert-danger display-none" id="profile-image-fail"></div>
                            
                            <img src="<?php echo $user->getPicture(); ?>" id="profile-picture" class="author-image" />
                            
                            <div class="author-name"><?php echo Html::encode($user->username); ?></div>

                            <?php if ($currentUser && $currentUser->equals($user)): ?>

                                <?= FileUpload::widget([
                                    'model' => $modelPicture,
                                    'attribute' => 'picture',
                                    'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
                                    'options' => ['accept' => 'image/*'],
                                    'clientEvents' => [
                                        'fileuploaddone' => 'function(e, data) {
                                            if (data.result.success) {
                                                $("#profile-image-success").show();
                                                $("#profile-image-fail").hide();
                                                $("#profile-picture").attr("src", data.result.pictureUri);
                                            } else {
                                                $("#profile-image-fail").html(data.result.errors.picture).show();
                                                $("#profile-image-success").hide();
                                            }
                                        }',
                                    ],
                                ]); ?>

                                <?php if ($user->picture): ?>
                                    <a href="<?php echo Url::to(['/user/profile/delete-picture']); ?>" class="btn btn-danger">Delete picture</a>
                                <?php endif; ?>

                                <a href="<?php echo Url::to(['/user/profile/update', 'id' => $user->id]); ?>" class="btn btn-default">Edit profile</a>

                            <?php endif; ?>
                                
                            <?php if ($currentUser && !$user->equals($currentUser)): ?>
    
                                <?php if (!$currentUser->isFollowind($user)): ?>
                                    <a href="<?php echo Url::to(['/user/profile/subscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Subscribe</a>
                                <?php else: ?>
                                    <a href="<?php echo Url::to(['/user/profile/unsubscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Unsubscribe</a>
                                <?php endif; ?>

                                <?php if ($mutualSubscriptions = $currentUser->getMutualSubscriptionsTo($user)): ?>
                                    <h5>Friends, who are also following <?php echo $user->username; ?>:</h5>
                                    <div class="row">
                                        <?php foreach ($mutualSubscriptions as $item): ?>
                                            <div class="col-md-12">
                                                <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($item['nickname']) ? $item['nickname'] : $item['id']]); ?>">
                                                    <?php echo Html::encode($item['username']); ?>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>
                                    
                        </div>
                        
                        <?php if ($user->about): ?>
                            <div class="profile-description">
                                <p><?php echo HtmlPurifier::process($user->about); ?></p>
                            </div>
                        <?php else: ?>
                            <br>
                        <?php endif; ?>
                            
                        <div class="profile-bottom">
                            <div class="profile-post-count">
                                <span><?php echo $user->getPostCount(); ?> posts</span>
                            </div>
                            <div class="profile-followers">
                                <a href="#" data-toggle="modal" data-target="#myModal12"><?php echo $user->countFollowers(); ?> followers</a>
                            </div>
                            <div class="profile-following">
                                <a href="#" data-toggle="modal" data-target="#myModal11"><?php echo $user->countSubscriptions(); ?> following</a>    
                            </div>
                        </div> 
                            
                    </article>

                    <div class="col-sm-12 col-xs-12">
                        <div class="row profile-posts">
                            <?php foreach ($user->getPosts() as $post): ?>
                                <div class="col-md-4 profile-post">
                                    <a href="<?php echo Url::to(['/post/default/view', 'id' => $post->getId()]); ?>">
                                        <img src="<?php echo Yii::$app->storage->getFile($post->filename); ?>" class="author-image" />
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal subscriptions -->
<div class="modal fade" id="myModal11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Following</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($user->getSubscriptions() as $subscription): ?>
                        <div class="col-md-12">   
                            <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($subscription['nickname']) ? $subscription['nickname'] : $subscription['id']]); ?>">
                                <?php echo Html::encode($subscription['username']); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal subscriptions -->

<!-- Modal subscriptions -->
<div class="modal fade" id="myModal12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Followers</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($user->getFollowers() as $follower): ?>
                        <div class="col-md-12">
                            <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($follower['nickname']) ? $follower['nickname'] : $follower['id']]); ?>">
                                <?php echo Html::encode($follower['username']); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal subscriptions -->
