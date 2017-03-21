<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1490062368.
 * Generated on 2017-03-21 03:12:48 
 */
class PropelMigration_1490062368
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `departamentos`;

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `productos`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `cod` INTEGER NOT NULL,
    `nombre` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `departamentos`
(
    `departid` INTEGER NOT NULL AUTO_INCREMENT,
    `descripcion` VARCHAR(45),
    PRIMARY KEY (`departid`)
) ENGINE=InnoDB;

CREATE TABLE `empleados`
(
    `idempledos` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(45) NOT NULL,
    `ap_paterno` VARCHAR(45) NOT NULL,
    `ap_materno` VARCHAR(45) NOT NULL,
    `edad` INTEGER,
    `sexo` VARCHAR(45),
    `numero_empleados` VARCHAR(45),
    `depart_id` INTEGER NOT NULL,
    PRIMARY KEY (`idempledos`),
    INDEX `fk_depart_idx` (`depart_id`),
    CONSTRAINT `fk_depart`
        FOREIGN KEY (`depart_id`)
        REFERENCES `departamentos` (`departid`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}