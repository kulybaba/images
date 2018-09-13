<?php

namespace frontend\tests;

use Yii;
use frontend\tests\fixtures\UserFixture;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    public function _fixtures()
    {
        return [
            'users' => UserFixture::className(),
        ];
    }
    
    public function _before()
    {
        Yii::$app->setComponents([
            'redis' => [
                'class' => 'yii\redis\Connection',
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 1,
            ],
        ]);
    }

        public function testGetNicknameOnNicknameEmpty()
    {
        $user = $this->tester->grabFixture('users', 'user1');
        expect($user->getNickname())->equals(1);
    }
    
    public function testGetNicknameOnNicknameNoEmpty()
    {
        $user = $this->tester->grabFixture('users', 'user2');
        expect($user->getNickname())->equals('catelyn');
    }
    
    public function testGetPostCount()
    {
        $user = $this->tester->grabFixture('users', 'user1');
        expect($user->getPostCount())->equals(3);
    }

    public function testFollowUser()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user3 = $this->tester->grabFixture('users', 'user3');
        
        $user1->followUser($user3);
        
        $this->tester->seeRedisKeyContains('user:3:followers', 1);
        $this->tester->seeRedisKeyContains('user:1:subscriptions', 3);
        
        $this->tester->sendCommandToRedis('del', 'user:3:followers');
        $this->tester->sendCommandToRedis('del', 'user:1:subscriptions');
    }
    
    public function testUnfollowUser()
    {
        $this->tester->sendCommandToRedis('sadd', 'user:3:followers', '0');
        $this->tester->sendCommandToRedis('sadd', 'user:1:subscriptions', '0');
        
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user3 = $this->tester->grabFixture('users', 'user3');
        
        $user1->unfollowUser($user3);
        
        $this->tester->dontSeeRedisKeyContains('user:3:followers', 1);
        $this->tester->dontSeeRedisKeyContains('user:1:subscriptions', 3);
        
        $this->tester->sendCommandToRedis('del', 'user:3:followers');
        $this->tester->sendCommandToRedis('del', 'user:1:subscriptions');
    }
}