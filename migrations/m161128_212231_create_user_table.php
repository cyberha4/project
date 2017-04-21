<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m161128_212231_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull,
            'email' => $this->string()->notNull,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
