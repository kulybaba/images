<?php

use yii\db\Migration;

/**
 * Class m180918_121013_alter_table_feed_add_foreign_key_feed_post_id_post_id
 */
class m180918_121013_alter_table_feed_add_foreign_key_feed_post_id_post_id extends Migration
{
    public function up()
    {
        $this->addForeignKey('fk-feed-post_id-post-id', 'feed', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-feed-post_id-post-id', 'feed');
    }
}
