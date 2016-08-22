<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\components\behavior;

/**
 * Class CreatedUpdatedBehavior
 * @package common\components\behavior
 */
class CreatedUpdatedBehavior extends \yii\behaviors\AttributeBehavior
{
	/**
	 * @var string the attribute that will receive timestamp value
	 * Set this property to false if you do not want to record the creation time.
	 */
	public $createdByAttribute = 'created_by';
	/**
	 * @var string the attribute that will receive timestamp value.
	 * Set this property to false if you do not want to record the update time.
	 */
	public $updatedByAttribute = 'updated_by';
	/**
	 * @var callable|\yii\db\Expression The expression that will be used for generating the timestamp.
	 * This can be either an anonymous function that returns the timestamp value,
	 * or an [[Expression]] object representing a DB expression (e.g. `new Expression('NOW()')`).
	 * If not set, it will use the value of `time()` to set the attributes.
	 */
	public $value;

	/**
	 *
	 */
	public function init()
	{
		parent::init();

		if (empty($this->attributes)) {
			$this->attributes = [
				\yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->createdByAttribute, $this->updatedByAttribute],
				\yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->updatedByAttribute,
			];
		}
	}

	/**
	 * @param $event
	 * @return mixed|\yii\db\Expression
	 */
	protected function getValue($event)
	{
		if ($this->value instanceof \yii\db\Expression) {
			return $this->value;
		} else {
			return $this->value !== null ? call_user_func($this->value, $event) : \Yii::$app->user->id;
		}
	}

	/**
	 * @param $attribute
	 */
	public function touch($attribute)
	{
		$this->owner->updateAttributes(array_fill_keys((array)$attribute, $this->getValue(null)));
	}

	/**
	 * Get the name of the user who created the item
	 * @return null
	 */
	public function getCreated_By_Name()
	{
		return isset($this->owner->createdBy) ? $this->owner->createdBy->username : null;
	}

	/**
	 * Get the name of the user who updated the item
	 * @return null
	 */
	public function getUpdated_By_Name()
	{
		return isset($this->owner->updatedBy) ? $this->owner->updatedBy->username : null;
	}
}
