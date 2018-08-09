<?php 
/* @var $this yii\web\View */
/* @var $user frontend\models\User */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<h1><?php echo Html::encode($user->username); ?></h1>
<p><?php echo HtmlPurifier::process($user->about); ?></p>
<hr>