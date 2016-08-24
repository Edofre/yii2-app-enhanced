<?php

namespace api\modules\v1\models;

/**
 * Class User
 * @package api\modules\v1\models
 */
class User extends \common\models\User
{
	public function fields()
	{
		$fields = parent::fields();

		// Unset fields
		unset($fields['created_at']);
		unset($fields['updated_at']);
		unset($fields['password']);
		unset($fields['password_hash']);
		unset($fields['password_reset_token']);

		return $fields;
	}
}