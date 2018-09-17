<?php

namespace frontend\modules\post\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\modules\post\models\forms\PostForm;
use frontend\models\Post;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use frontend\modules\post\models\Comment;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    
    /**
     * Renders the create view for the module
     * @return string
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        
        $model = new PostForm(Yii::$app->user->identity);
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->picture = UploadedFile::getInstance($model, 'picture');
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Post created!');
                return $this->goHome();
            }
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    /**
     * Renders the create view for the module
     * @return string
     */
    public function actionView($id)
    {
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        
        $countComments = Comment::countComments($id);
        
        return $this->render('view', [
            'post' => $this->findPost($id),
            'currentUser' => $currentUser,
            'comments' => $this->getComments($id),
            'countComments' => $countComments,
        ]);
    }
    
    public function actionLike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        $post = $this->findPost($id);
        
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        
        $post->like($currentUser);
        
        return [
            'success' => true,
            'likesCount' => $post->countLikes(),
        ];
    }
    
    public function actionUnlike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        $post = $this->findPost($id);
        
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        
        $post->unLike($currentUser);
        
        return [
            'success' => true,
            'likesCount' => $post->countLikes(),
        ];
    }
    
    public function actionComplain()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        
        $post = $this->findPost($id);
        
        if ($post->complain($currentUser)) {
            return [
                'success' => true,
                'text' => 'Post reported',
            ];
        }
        return [
            'success' => false,
            'text' => 'Error'
        ];
    }

        /**
     * @param integer $id
     * @return User
     * @throws NotFoundHttpException
     */
    public function findPost($id)
    {
        if ($model = Post::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException;
    }
    
    /**
     * @param integer $id
     * @return Comment
     */
    public function getComments($id)
    {
        if ($model = Comment::find()->where(['post_id' => $id])->all()) {
            return $model;
        }
    }
}
