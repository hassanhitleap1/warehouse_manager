ALTER TABLE `products` ADD `quantity_come` INT NOT NULL DEFAULT '0' AFTER `quantity`;
UPDATE `products` SET `products`.`quantity_come`= `products`.`quantity` WHERE 1