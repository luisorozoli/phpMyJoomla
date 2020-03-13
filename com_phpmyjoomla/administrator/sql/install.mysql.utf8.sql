CREATE TABLE IF NOT EXISTS `#__phpmyjoomla_ext_server_config` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`state` TINYINT(1)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`username` VARCHAR(255)  NOT NULL ,
`host` VARCHAR(255)  NOT NULL ,
`password` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

