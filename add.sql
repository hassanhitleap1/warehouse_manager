ALTER TABLE `products` ADD `quantity_come` INT NOT NULL DEFAULT '0' AFTER `quantity`;
UPDATE `products` SET `products`.`quantity_come`= `products`.`quantity` WHERE 1
ALTER TABLE `products` CHANGE `description` `description` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `user` ADD `type` SMALLINT NOT NULL DEFAULT '2' AFTER `email`;
INSERT INTO `user` (`id`, `username`, `phone`, `name`, `other_phone`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `type`, `status`, `country_id`, `region_id`, `area_id`, `address`, `name_in_facebook`, `created_at`, `updated_at`) VALUES (NULL, 'admin', NULL, 'admin', NULL, NULL, '$2y$13$i2fhqzrySqbgakXK4k9Iwu0YIMrU1Hd2tVnY3uVSFp4g9zQMnzA.G', NULL, NULL, '2', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL);


CREATE TABLE `outlays` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `type` MEDIUMINT NOT NULL , `product_id` INT NULL DEFAULT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `type_outlay` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `outlays` ADD `value` DOUBLE NOT NULL AFTER `title`;

# history_status

CREATE TABLE `history_status` ( `id` INT NOT NULL AUTO_INCREMENT , `status_id` SMALLINT NOT NULL , `order_id` INT NOT NULL , `created_at` DATETIME NULL DEFAULT NULL , `updated_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


-- # last update

UPDATE `status` SET `name_ar` = 'تم استلام الطلب الملغي ودفع المبلغ' WHERE `status`.`id` = 13;
INSERT INTO `status` (`id`, `name_en`, `name_ar`, `color`, `created_at`, `updated_at`) VALUES ('14', 'تم استلام الطلب الملغي بدون دفع المبلغ', 'تم استلام الطلب الملغي بدون دفع المبلغ', '', '2021-08-11 09:53:08.000000', '2021-08-11 09:53:08.000000');



ALTER TABLE `regions` ADD `region_api_id` INT NOT NULL DEFAULT '1' AFTER `country_id`;
ALTER TABLE `regions` ADD `city_api_id` INT NOT NULL DEFAULT '1' AFTER `region_api_id`;
ALTER TABLE `regions` ADD `village_api_id` INT NOT NULL DEFAULT '1' AFTER `city_api_id`;
