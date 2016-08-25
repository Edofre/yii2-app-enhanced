<?php

use api\tests\ApiTester;

$I = new ApiTester($scenario);
$I->wantTo('Login member');

$I->sendPOST('user/login', ['username' => 'member', 'password' => 'asdasd']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains("1Uu1qHcde0diwUol3xeI-18MuHkkprQI");

// Done