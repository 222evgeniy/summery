<?php

use yii\db\Migration;

/**
 * Class m210415_100116_comment_link_summery
 */
class m210415_100116_comment_link_summery extends Migration
{
    public $table;

    public function init()
    {
        $this->table = 'summery_comment_link';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(10),
            'summery_id' => $this->integer(10)->notNull(),
            'comment_id' => $this->integer(10)->notNull(),
            'url'=> $this->string(255)->notNull(),
            'filename' => $this->string(255)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete($this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210415_100116_comment_link_summery cannot be reverted.\n";

        return false;
    }
    */
}
