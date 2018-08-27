<?php

namespace frontend\modules\post\models\forms;

use yii\base\Model;
use frontend\modules\post\models\Comment;
use frontend\models\User;

class CommentForm extends Model
{    
    public $text;
    private $user;
    private $post_id;


    public function __construct(User $user, int $post_id)
    {
        $this->user = $user;
        $this->post_id = $post_id;        
    }

    public function rules()
    {
        return [
            [['text'], 'string', 'max' => Comment::getMaxCommentLenght()],
        ];
    }
    
    public function save()
    {
        if ($this->validate()) {
            $comment = new Comment();
            $comment->post_id = $this->post_id;
            $comment->user_id = $this->user->getId();
            $comment->text = $this->text;
            
            return $comment->save();
        }
    }
}