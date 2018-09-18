<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * @property string $description
 * @property int $created_at
 * @property int $complaints
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'filename' => 'Filename',
            'description' => 'Description',
            'created_at' => 'Created At',
            'complaints' => 'Complaints',
        ];
    }
    
    /**
     * @return array
     */
    public static function findComplaints()
    {
        return Post::find()->where('complaints > 0')->orderBy('complaints DESC');
    }
    
    /**
     * @return string
     */
    public function getImage()
    {
        return Yii::$app->storage->getFile($this->filename);;
    }
    
    public function approve()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $key = "post:{$this->id}:complaints";
        $redis->del($key);
        
        $this->complaints = 0;
        return $this->save(false, ['complaints']);
    }
    
    public function deleteLikesCommentsComplaints()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $likesKey = "post:{$this->id}:likes";
        $commentsKey = "post:{$this->id}:comments";
        $complaintsKey = "post:{$this->id}:complaints";
        
        if ($redis->del($likesKey) && $redis->del($commentsKey) && $redis->del($complaintsKey)) {
            return true;
        }
        return false; 
    }
}
