<?php

use yii\db\Migration;

class m151114_000000_free_radius_install extends Migration
{
    /**
     * [safeUp description]
     * @return [type] [description]
     */
    public function safeUp()
    {
        echo "m151114_000000_free_radius_install installed.\n";

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            DROP TABLE IF EXISTS `radcheck`;
            CREATE TABLE `radcheck` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(32) NOT NULL,
                `attribute` varchar(32) NOT NULL,
                `op` varchar(2) NOT NULL,
                `value` varchar(32) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");

        return $command->execute();
    }

    /**
     * [safeDown description]
     * @return [type] [description]
     */
    public function safeDown()
    {
        echo "m151114_000000_free_radius_install removed.\n";

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            DROP TABLE IF EXISTS `radcheck`;
        ");

        return $command->execute();
    }
}