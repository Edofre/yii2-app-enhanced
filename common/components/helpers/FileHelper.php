<?php
namespace common\components\helpers;

use Yii;
use yii\web\HttpException;

/**
 * Class FileHelper
 * @package common\components\helpers
 */
class FileHelper extends \yii\helpers\FileHelper
{
	/**
	 * @param      $file_name
	 * @param bool $suppress_errors
	 * @throws HttpException
	 */
	public static function removeFile($file_name, $suppress_errors = true)
	{
		// Check if string contains @backend
		if (strpos($file_name, '@backend_uploads') !== false) {
			self::unlink(str_replace('@backend_uploads', '@backend_uploads_dir', $file_name), $suppress_errors);
		} elseif (strpos($file_name, '@frontend_uploads') !== false) {
			self::unlink(str_replace('@frontend_uploads', '@frontend_uploads_dir', $file_name), $suppress_errors);
		} else {
			// No backend/frontend found, error
			if (!$suppress_errors) {
				throw new HttpException('Could not find file');
			}
		}
	}

	/**
	 * Actually delete the file
	 * @param $file
	 * @param $suppress_errors
	 */
	private static function unlink($file, $suppress_errors)
	{
		$alias = Yii::getAlias($file);
		if ($suppress_errors) {
			@unlink($alias);
		} else {
			unlink($alias);
		}
	}
}
