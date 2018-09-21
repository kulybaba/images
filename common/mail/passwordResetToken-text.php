<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

use Yii;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/default/reset-password', 'token' => $user->password_reset_token]);
?>
<?php Yii::t('mail', 'Hello {username}', [
    'username' => $user->username,
]); ?>,

<?php echo Yii::t('mail', 'Follow the link below to reset your password:'); ?>

<?= $resetLink ?>
