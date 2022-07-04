<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%organization}}`.
 */
class m220703_174710_create_organization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%organization}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull()
        ]);

        $this->createIndex('idx-organization-name', '{{%organization}}', 'name', true);
        $this->createIndex('idx-organization-address', '{{%organization}}', 'address', true);


        $this->batchInsert('organization', ['name', 'address'], [
            ['Harman', 'Nizhny Novgorod, Kovalikhinskaya, 8'],
            ['Five Minutes', 'Nizhny Novgorod, Salganskaya, 24'],
            ['Virgin Connect', 'Nizhny Novgorod, Osharskaya, 95'],
            ['Orion', 'Nizhny Novgorod, Delovaya, 13'],
            ['Rome', 'Italy, Rome, Piazza del Colosseo, 1, 00184 Roma RM'],
            ['Death star inc', 'Forest Moon of Endor']
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {


        // drops index for column `author_id`
        $this->dropIndex(
            'idx-organization-name',
            'organization'
        );
        // drops index for column `author_id`
        $this->dropIndex(
            'idx-organization-address',
            'organization'
        );
        $this->dropTable('{{%organization}}');
    }
}
