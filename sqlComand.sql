ALTER TABLE `sub_product_count` ADD `variant_id` VARCHAR(250) NULL AFTER `product_id`;

ALTER TABLE `products` ADD `product_id` VARCHAR(255) NULL AFTER `top_selling`;



ALTER TABLE `products` CHANGE `warehouse_id` `warehouse_id` INT(11) NULL;



ALTER TABLE `orders` ADD `order_shopify_id` VARCHAR(255) NULL AFTER `deported`;


ALTER TABLE `options_sell_product` ADD `variant_id` VARCHAR(255) NULL DEFAULT NULL AFTER `price`;

