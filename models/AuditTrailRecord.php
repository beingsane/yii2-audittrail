<?php

namespace grzegorzkurtyka\yii2audittrail\models;

use Yii;
use yii\db\ActiveRecord;

abstract class AuditTrailRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        return Yii::$app->get(Yii::$app->AuditTrail->db);
    }

}
