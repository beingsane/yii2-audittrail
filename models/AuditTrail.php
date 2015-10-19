<?php

namespace grzegorzkurtyka\yii2audittrail\models;

use Yii;

/**
 * The followings are the available columns in table '{{%audit_trail}}':
 * @var integer $id
 * @var string $action
 * @var string $model
 * @var string $stamp
 * @var integer $user_id
 * @var string $model_id
 */
class AuditTrail extends AuditTrailRecord
{

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%audit_trail}}';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('audittrail', 'ID'),
            'action' => Yii::t('audittrail', 'Action'),
            'model' => Yii::t('audittrail', 'Type'),
            'stamp' => Yii::t('audittrail', 'Stamp'),
            'user_id' => Yii::t('audittrail', 'User'),
            'model_id' => Yii::t('audittrail', 'ID'),
        ];
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            [['action', 'model', 'stamp', 'model_id'], 'required'],
            ['action', 'string', 'max' => 255],
            ['model', 'string', 'max' => 255],
            ['model_id', 'string', 'max' => 255],
            ['user_id', 'string', 'max' => 255],
        ];
    }

    public static function recently($query)
    {
        $query->orderBy(['[[stamp]]' => SORT_DESC]);
    }

    public function getUser()
    {
        if (isset(Yii::$app->params['audittrail.model']) && isset(Yii::$app->params['audittrail.model'])) {
            return $this->hasOne(Yii::$app->params['audittrail.model'], ['id' => 'user_id']);
        } else {
            return $this->hasOne('common\models\User', ['id' => 'user_id']);
        }
    }

    public function getParent()
    {
        $model_name = $this->model;
        return new $model_name;
    }
}
