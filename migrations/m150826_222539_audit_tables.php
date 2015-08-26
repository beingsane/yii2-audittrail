<?php

use yii\db\Schema;
use yii\db\Migration;

class m150826_222539_audit_tables extends Migration
{
    public function up()
    {
        $this->createTable('{{%audit_trail}}',
            [
                'id' => Schema::TYPE_PK,
                'action' => Schema::TYPE_STRING . ' NOT NULL',
                'model' => Schema::TYPE_STRING . ' NOT NULL',
                'stamp' => Schema::TYPE_DATETIME . ' NOT NULL',
                'user_id' => Schema::TYPE_STRING,
                'model_id' => Schema::TYPE_STRING . ' NOT NULL',
            ]
        );

        $this->createTable('{{%audit_trail_change}}',
            [
                'id' => Schema::TYPE_PK,
                'audit_id' => Schema::TYPE_INTEGER,
                'old_value' => Schema::TYPE_TEXT,
                'new_value' => Schema::TYPE_TEXT,
                'field' => Schema::TYPE_STRING,
            ]
        );
        $this->createIndex( 'idx_audit_trail_user_id', '{{%audit_trail}}', 'user_id');
        $this->createIndex( 'idx_audit_trail_model_id', '{{%audit_trail}}', 'model_id');
        $this->createIndex( 'idx_audit_trail_model', '{{%audit_trail}}', 'model');

        $this->addForeignKey('audit_change_to_audit_set', '{{%audit_trail_change}}', 'audit_id', '{{%audit_trail}}', 'id', 'CASCADE', null);
    }

    public function down()
    {
        $this->dropForeignKey('audit_change_to_audit_set', '{{%audit_trail_change}}');
        $this->dropTable('{{%audit_trail_change}}');
        $this->dropTable('{{%audit_trail}}');
    }

}
