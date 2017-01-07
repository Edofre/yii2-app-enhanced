<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

/* @var $scenario \Codeception\Scenario */
class ContactCest
{
    /**
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['site/contact']);
    }

    /**
     * @param FunctionalTester $I
     */
    public function checkContact(FunctionalTester $I)
    {
        $I->see(Yii::t('site', 'Contact'), 'h1');
    }

    /**
     * @param FunctionalTester $I
     */
    public function checkContactSubmitNoData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->see('Contact', 'h1');
        $I->seeValidationError(Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Yii::t('contact', 'Name')]));
        $I->seeValidationError(Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Yii::t('contact', 'Email')]));
        $I->seeValidationError(Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Yii::t('contact', 'Subject')]));
        $I->seeValidationError(Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Yii::t('contact', 'Body')]));
        $I->seeValidationError(Yii::t('yii', 'The verification code is incorrect.'));
    }

    /**
     * @param FunctionalTester $I
     */
    public function checkContactSubmitNotCorrectEmail(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]'       => 'tester',
            'ContactForm[email]'      => 'tester.email',
            'ContactForm[subject]'    => 'test subject',
            'ContactForm[body]'       => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeValidationError(Yii::t('yii', '{attribute} is not a valid email address.', ['attribute' => Yii::t('contact', 'Email')]));
        $I->dontSeeValidationError(Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Yii::t('contact', 'Name')]));
        $I->dontSeeValidationError(Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Yii::t('contact', 'Subject')]));
        $I->dontSeeValidationError(Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => Yii::t('contact', 'Body')]));
        $I->dontSeeValidationError(Yii::t('yii', 'The verification code is incorrect.'));
    }

    /**
     * @param FunctionalTester $I
     */
    public function checkContactSubmitCorrectData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]'       => 'tester',
            'ContactForm[email]'      => 'tester@example.com',
            'ContactForm[subject]'    => 'test subject',
            'ContactForm[body]'       => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeEmailIsSent();
        $I->see(Yii::t('site', 'Thank you for contacting us. We will respond to you as soon as possible.'));
    }
}
