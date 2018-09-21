<?php

use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/default/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p><?php echo Yii::t('mail', 'Hello {username}', [
        'username' => Html::encode($user->username),
    ]);?>,</p>

    <p><?php echo Yii::t('mail', 'Follow the link below to reset your password:'); ?></p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
