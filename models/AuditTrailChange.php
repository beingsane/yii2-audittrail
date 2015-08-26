<?php

namespace grzegorzkurtyka\yii2audittrail\models;

use Yii;

/**
 * The followings are the available columns in table '{{%audit_trail_change}}':
 * @var integer $id
 * @var integer $audit_id
 * @var string $new_value
 * @var string $old_value
 */
class AuditTrailChange extends AuditTrailModel
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
        return '{{%audit_trail_change}}';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('audittrail','ID'),
			'audit_id' => Yii::t('audittrail','Chnageset ID'),
			'old_value' => Yii::t('audittrail','Old Value'),
			'new_value' => Yii::t('audittrail','New Value'),
		];
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
            ['audit_id', 'integer'],
			['field', 'string', 'max' => 255],
			[['old_value', 'new_value'], 'safe']
		];
	}
}
