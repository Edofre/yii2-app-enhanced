<?php
namespace common\components\db;

use common\models\User;
use Yii;

/**
 * Class ActiveRecord
 * @package common\components\db
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
	const DELETE_ATTRIBUTE = 'deleted_at';

	/**
	 * Get the model data sorted and formatted for easy form use
	 * @return mixed
	 */
	public static function getFormData()
	{
		return \yii\helpers\ArrayHelper::map(self::find()->asArray()->orderBy('name')->all(), 'id', function ($model, $defaultValue) {
			return $model['name'];
		});
	}

	/**
	 * Override default find() method so we exclude the deleted models
	 * @return $this
	 */
	public static function find()
	{
		return parent::find()->where([self::tableName() . '.' . self::DELETE_ATTRIBUTE => null]);
	}

	/**
	 * Creates a new model or returns the found one if present
	 * @param $attributes
	 * @return null|static
	 */
	public static function findOrNew($attributes)
	{
		$model = self::findOne($attributes);
		if (is_null($model)) {
			$class = self::className();
			$model = new $class($attributes);
		}

		return $model;
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
			\common\components\behavior\CreatedUpdatedBehavior::className(),
			'softDeleteBehavior' => [
				'class'     => \common\components\behavior\SoftDeleteBehavior::className(),
				'attribute' => self::DELETE_ATTRIBUTE,
			],

		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
			'id'                   => \Yii::t('common', 'ID'),
			'created_by'           => \Yii::t('common', 'Created By'),
			'updated_by'           => \Yii::t('common', 'Updated By'),
			'created_at'           => \Yii::t('common', 'Created At'),
			'updated_at'           => \Yii::t('common', 'Updated At'),
			self::DELETE_ATTRIBUTE => \Yii::t('common', 'Deleted At'),
		]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUpdatedBy()
	{
		$user = $this->hasOne(\common\models\User::className(), ['id' => 'updated_by']);
		if (is_null($user->one())) {
			$user = new User(['id' => null, 'username' => Yii::t('user', 'Deleted'), 'email' => Yii::t('user', 'Deleted')]);
		}
		return $user;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreatedBy()
	{
		$user = $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
		if (is_null($user->one())) {
			$user = new User(['id' => null, 'username' => Yii::t('user', 'Deleted'), 'email' => Yii::t('user', 'Deleted')]);
		}
		return $user;
	}
}