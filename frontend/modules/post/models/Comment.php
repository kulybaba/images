<?php

namespace frontend\modules\post\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use frontend\models\User;

/**
 * This is the model class for table "comment".
 *
 * @property int $id frontend\modules\post\models\forms\CommentForm;
 * @property int $post_id
 * @property int $user_id
 * @property string $text
 * @property int $created_at
 * @property int $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }
    
    public function rules()
    {
        return [
            [['text'], 'string', 'max' => $this->getMaxCommentLenght()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Update At',
        ];
    }
    
    /**
     * Get author of the comment
     * @return User|null
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * Maximum lenght of the comment
     * @return integer
     */
    public static function getMaxCommentLenght()
    {
        return Yii::$app->params['maxCommentLenght'];
    }
    
    public static function incrCommentCount(int $id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $redis->incr("post:{$id}:comments");
    }
    
    public static function decrCommentCount(int $id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $redis->decr("post:{$id}:comments");
    }
    
    public static function countComments(int $id)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->get("post:{$id}:comments");
    }
}
