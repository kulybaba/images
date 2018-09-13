<?php

namespace frontend\tests\functional;

use frontend\tests\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
            ],
        ]);
    }

    public function checkLoginWorking(FunctionalTester $I)
    {
        $I->amOnRoute('user/default/login');
        
        $formParams = [
            'LoginForm[email]' => '1@got.com',
            'LoginForm[password]' => '111111',
        ];
        
        $I->submitForm('#login-form', $formParams);
        $I->see('Eddard "Ned" Stark', 'form button[type=submit]');
    }
    
    public function checkLoginWrongPassword(FunctionalTester $I)
    {
        $I->amOnRoute('user/default/login');
        
        $formParams = [
            'LoginForm[email]' => '1@got.com',
            'LoginForm[password]' => 'wrong',
        ];
        
        $I->submitForm('#login-form', $formParams);
        $I->see('Incorrect email or password.');
    }
}
