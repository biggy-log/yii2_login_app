<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220703_174834_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'organization_id' => $this->integer()->notNull(),
            'job_title' => $this->string(255)->notNull(),
            'avatar_path' => $this->string(255),
            'file_path' => $this->string(255),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
        ], $tableOptions);

         // add foreign key for table `organization`
        $this->addForeignKey(
            'fk-user-id',
            'user',
            'id',
            'organization',
            'id',
            'CASCADE'
        );
        $this->createIndex('idx-user-username', '{{%user}}', 'username', true);
        $this->createIndex('idx-user-email', '{{%user}}', 'email', true);

        $this->batchInsert('user', ['created_at', 'updated_at','username','organization_id','job_title','avatar_path','file_path','auth_key','password_hash','password_reset_token','email','status'], [
            [1656920867,1656920867,'Julius Cesar',5,'General','Gladiator.png','Rome.txt',NULL,'$2y$13$QX.gMWaE5LToQJofqMX9EeuGZ0M03pKkabzPEbAAE/pCvEN15xV/m',NULL,'jul.ces@mail.ru',10],
            [1656921205,1656921205,'Darth Vader',6,'Senior Storm Trooper','darth-vader.png','VaderInfo',NULL,'$2y$13$XZnZFohSng2MTocEpn9v0.MH0vLc7NEI/2.QWp8Q.VNMEm3NM1bfa',NULL,'dark.lord@gmail.com',10]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {


        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user-id',
            'user'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-user-username',
            'user'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-user-email',
            'user'
        );

        $this->dropTable('{{%user}}');
    }
}
