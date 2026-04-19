<?php

use yii\db\Migration;

class M151114000000FreeRadiusInstall extends Migration
{
    /**
     * [safeUp description]
     * @return [type] [description]
     */
    public function safeUp()
    {
        echo "M151114000000FreeRadiusInstall installed.\n";

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            DROP TABLE IF EXISTS `RadCheck`;
            CREATE TABLE `RadCheck` (
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
        echo "M151114000000FreeRadiusInstall removed.\n";

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            DROP TABLE IF EXISTS `RadCheck`;
        ");

        return $command->execute();
    }
}

