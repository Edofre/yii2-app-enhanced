<?php

use api\tests\ApiTester;

$I = new ApiTester($scenario);
$I->wantTo('Login fail');

$I->sendPOST('user/login', ['username' => '1admin', 'password' => '']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains("2Uu1qHcde0diwUol3xeI-18MuHkkprQI");

// Done