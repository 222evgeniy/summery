<?php

use yii\db\Migration;

/**
 * Class m210412_090047_summery_data_tables
 */
class m210412_090047_summery_data_tables extends Migration
{
    public $table;

    public function init()
    {
        $this->table = 'summery';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
           'id' => $this->primaryKey(10),
           'user_id' => $this->integer(10),
           'filename' => $this->string(255),
           'url' => $this->string(255),
           'create_at' => $this->dateTime(),
           'status' => $this->tinyInteger(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210412_090047_summery_data_tables cannot be reverted.\n";

        return false;
    }
    */
}
