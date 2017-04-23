<?php

use yii\db\Migration;

class m170420_185807_init extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'name' => $this->string(),
            'email' => $this->string()->unique(),
            'group' => $this->integer()->notNull()->defaultValue(2),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->timestamp(),
            'access_token' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string()->notNull()->unique(),
            'status' => $this->integer()->notNull()->defaultValue(1)
        ]);

        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'date_start' => $this->date()->notNull(),
            'time_start' => $this->time()->null()->defaultValue(null),
            'date_end' => $this->date(),
            'time_end' => $this->time()->null()->defaultValue(null),
            'description' => $this->text(),
            'color' => $this->string(),
            'status' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('owner', 'event', 'user_id', 'user', 'id');

        $this->createTable('invite', [
            'id' => $this->primaryKey(),
            'created_by' => $this->integer()->notNull()->comment('User who created the invite'),
            'invited_user_id' => $this->integer(),
            'code' => $this->string()->unique()->notNull()
        ]);

        $this->addForeignKey('created_user', 'invite', 'created_by', 'user', 'id');
        $this->addForeignKey('invited_user', 'invite', 'invited_user_id', 'user', 'id');

        $this->insert('user', [
            'username' => 'admin@calendar.dev',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'name' => 'admin',
            'email' => 'admin@calendar.dev',
            'group' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString()
        ]);
    }

    public function down()
    {
        $this->dropTable('invite');
        $this->dropTable('event');
        $this->dropTable('user');
    }

}
