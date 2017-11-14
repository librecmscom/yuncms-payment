<?php

namespace yuncms\payment\migrations;

use yii\db\Migration;

class M171114105053Create_payment_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%payment}}', [
            'id' => $this->string()->notNull()->comment('ID'),
            'model_id' => $this->integer()->comment('Model ID'),
            'model_class' => $this->string()->comment('Model Class'),
            'pay_id' => $this->string()->comment('Pay ID'),
            'user_id' => $this->integer()->unsigned()->comment('User ID'),
            'name' => $this->integer()->comment('Payment Name'),
            'gateway' => $this->string(50)->comment('Gateway'),
            'currency' => $this->string(20)->notNull()->comment('Currency'),
            'money' => $this->decimal(10, 2)->notNull()->defaultValue(0.00)->comment('Money'),
            'trade_state' => $this->smallInteger()->notNull()->comment('Trade Type'),
            'trade_type' => $this->smallInteger()->notNull()->comment('Trade State'),
            'ip' => $this->string()->notNull()->comment('IP'),
            'note' => $this->text()->comment('Note'),
            'callback_url' => $this->text()->comment('Callback Url'),
            'created_at' => $this->integer()->notNull()->comment('Created At'),
            'updated_at' => $this->integer()->notNull()->comment('Updated At'),
        ], $tableOptions);

        $this->addPrimaryKey('PK', '{{%payment}}', 'id');
        $this->addForeignKey('payment_fk_1', '{{%payment}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('payment_id_model', '{{%payment}}', ['model_id', 'model_class']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%payment}}');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M171114105053Create_payment_table cannot be reverted.\n";

        return false;
    }
    */
}
