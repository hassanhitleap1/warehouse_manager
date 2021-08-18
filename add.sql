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

ALTER TABLE `orders` ADD `deported` SMALLINT NOT NULL DEFAULT '0' AFTER `company_delivery_id`;



ALTER TABLE `regions` ADD `region_api_id` INT NOT NULL DEFAULT '1' AFTER `country_id`;
ALTER TABLE `regions` ADD `city_api_id` INT NOT NULL DEFAULT '1' AFTER `region_api_id`;
ALTER TABLE `regions` ADD `village_api_id` INT NOT NULL DEFAULT '1' AFTER `city_api_id`;




INSERT INTO `regions` (`id`, `name_en`, `name_ar`, `price_delivery`, `country_id`, `village_api_id`, `city_api_id`, `region_api_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'عمان', 2, 1, 6074, 395, 33, NULL, NULL),
(2, NULL, 'اربد', 2, 1, 6000, 1184, 43, NULL, NULL),
(3, NULL, 'الزرقاء', 2, 1, 6020, 1176, 44, NULL, NULL),
(4, NULL, 'معان', 2, 1, 6106, 1174, 38, NULL, NULL),
(5, NULL, 'المفرق', 2, 1, 6048, 1179, 36, NULL, NULL),
(6, NULL, 'العقبة', 2, 1, 6038, 1173, 40, NULL, NULL),
(7, NULL, 'مادبا', 2, 1, 6104, 1181, 34, NULL, NULL),
(8, NULL, 'السلط', 2, 1, 242, 1180, 242, NULL, NULL),
(9, NULL, 'الكرك', 2, 1, 6039, 1175, 37, NULL, NULL),
(10, NULL, 'الطفيلة', 2, 1, 6036, 387, 39, NULL, NULL),
(11, NULL, 'عجلون', 2, 1, 42, 1178, 42, NULL, NULL),
(12, NULL, 'جرش', 2, 1, 41, 1177, 41, NULL, NULL),
(13, NULL, 'البلقاء', 2, 1, 1, 1, 1, NULL, NULL),
(14, 'الاغوار', 'الاغوار', 2, 1, 243, 1182, 243, NULL, NULL),
(15, 'الرصيفة', 'الرصيفة', 2, 1, 244, 1188, 244, NULL, NULL),
(16, 'الرمثا', 'الرمثا', 2, 1, 246, 1189, 246, NULL, NULL),
(17, 'عين الباشا', 'عين الباشا', 2, 1, 245, 1186, 245, NULL, NULL);



INSERT INTO `status` (`id`, `name_en`, `name_ar`, `color`, `created_at`, `updated_at`) VALUES
(1, 'اجراء مكالمة', 'اجراء مكالمة', '#292fca', NULL, NULL),
(2, 'مطلوب تجهيزه', 'مطلوب تجهيزه', '#237923', NULL, NULL),
(3, 'تم تجهيزه', 'تم تجهيزه', '#237923', NULL, NULL),
(4, 'قيد التوصيل', 'قيد التوصيل', '#237923', NULL, NULL),
(5, 'تم توصيله', 'تم توصيله', '#237923', NULL, NULL),
(6, 'ملغي', 'ملغي', '#eb0017', NULL, NULL),
(7, 'ملغي من الشركة', 'ملغي من الشركة', '#eb0017', NULL, NULL),
(8, 'مؤجل', 'مؤجل', '#292fca', NULL, NULL),
(9, 'مؤجل من الشركة', 'مؤجل من الشركة', '#292fca', NULL, NULL),
(10, 'لا يرد', 'لا يرد', '#292fca', NULL, NULL),
(11, 'لا يرد من الشركة', 'لا يرد من الشركة', '#292fca', NULL, NULL),
(12, 'تم استلام المبلغ', 'تم استلام المبلغ', '#292fca', NULL, NULL),
(13, 'تم استلام الطلب الملغي ', 'تم استلام الطلب الملغي ', '#292fca', NULL, '2021-08-18 20:45:34'),
(14, 'رفض استلام وعدم دفع الأجور', 'رفض استلام وعدم دفع الأجور', '#000000', '2021-08-09 20:43:23', '2021-08-18 20:47:43');