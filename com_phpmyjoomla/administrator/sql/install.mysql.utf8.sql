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

CREATE TABLE IF NOT EXISTS `#__phpmyjoomla_filters` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255)  NOT NULL ,
`datatable_state` TEXT NOT NULL,
`view_state` TEXT NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY (`name`)
) DEFAULT COLLATE=utf8_general_ci;

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Servers','com_phpmyjoomla.servers','{"special":{"dbtable":"#__phpmyjoomla_ext_server_config","key":"id","type":"Servers","prefix":"PhpmyjoomlaTable"}}', '{"formFile":"administrator\/components\/com_phpmyjoomla\/models\/forms\/servers.xml", "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_phpmyjoomla.servers')
) LIMIT 1;
