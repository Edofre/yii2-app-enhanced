<?php

use api\tests\ApiTester;

$I = new ApiTester($scenario);
$I->wantTo('Login fail');

$I->sendPOST('user/login', ['username' => '1admin', 'password' => '']);

$I->seeResponseCodeIs(422);
$I->seeResponseIsJson();
$I->seeResponseContains("Password cannot be blank.");

// Done