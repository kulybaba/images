<?php

namespace frontend\modules\post\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\post\models\forms\CommentForm;
use frontend\modules\post\models\Comment;

/**
 * Comment controller for the `post` module
 *
 * @author Petro Kulybaba <ahurtep@gmail.com>
 */
class CommentController extends Controller
{   
    
    /**
     * Renders the create view for the module
     * @return string
     */
    public function actionCreate($post_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        
        $model = new CommentForm(Yii::$app->user->identity, $post_id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Comment::incrCommentCount($post_id);
            Yii::$app->session->setFlash('success', 'Comment created!');
            return $this->redirect(['/post/default/view', 'id' => $post_id]);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($comment_id, $post_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        };
        
        if ($model = Comment::findOne($comment_id)->delete()) {
            Comment::decrCommentCount($post_id);
            Yii::$app->session->setFlash('success', 'Comment deleted!');
            return $this->redirect(['/post/default/view', 'id' => $post_id]);
        }
    }
    
    /**
     * Renders the create view for the module
     * @return string
     */
    public function actionUpdate($comment_id, $post_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        
        $model = Comment::findOne($comment_id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Comment updated!');
            return $this->redirect(['/post/default/view', 'id' => $post_id]);
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
