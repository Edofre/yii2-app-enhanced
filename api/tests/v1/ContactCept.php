<?php

use api\tests\ApiTester;

$I = new ApiTester($scenario);
$I->wantTo('Send contact request');

$I->amHttpAuthenticated('1Uu1qHcde0diwUol3xeI-18MuHkkprQI', '');

$I->sendPOST('contact/message', [
	'name'    => 'John Doe',
	'email'   => 'contact@example.com',
	'subject' => 'Subject',
	'body'    => 'BODY!@#',
]);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('Thank you for contacting us. We will respond to you as soon as possible.');

// Done