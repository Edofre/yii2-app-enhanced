<?php

namespace common\components\helpers;

/**
 * Class UrlHelper
 * @package common\components\helpers
 */
class UrlHelper
{
	/**
	 * Replace sequences of non-alphanumeric dashes with a single dash
	 * Remove possible dashes at the start and end of the string
	 */
	public static function urlify($input)
	{
		return preg_replace(array(
			'/[^a-z0-9]+/',
			'/(^-)|(-$)/'
		), array(
			'-',
			''
		), strtolower($input));
	}
}
