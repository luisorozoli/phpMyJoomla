DROP TABLE IF EXISTS `#__phpmyjoomla_ext_server_config`;

DELETE FROM `#__content_types` WHERE (type_alias LIKE 'com_phpmyjoomla.%');