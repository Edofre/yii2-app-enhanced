<?php

use api\tests\ApiTester;

$I = new ApiTester($scenario);
$I->wantTo('Login member');

$I->sendPOST('user/login', ['username' => 'member', 'password' => 'password_0']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains("2Uu1qHcde0diwUol3xeI-18MuHkkprQI");

// Done