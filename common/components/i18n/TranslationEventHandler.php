<?php

namespace common\components\i18n;

/**
 * Class TranslationEventHandler
 * @package common\components\i18n
 */
class TranslationEventHandler
{
	/**
	 * Display an error if the user has forgotten the translation
	 * @param \yii\i18n\MissingTranslationEvent $event
	 */
	public static function handleMissingTranslation(\yii\i18n\MissingTranslationEvent $event)
	{
		$event->translatedMessage = "!!!MISSING: {$event->category}.{$event->message} FOR LANGUAGE {$event->language} !!!";
	}
}