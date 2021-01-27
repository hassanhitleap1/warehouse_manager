DELIMITER $$
CREATE TRIGGER after_insert_orders_item AFTER insert ON `orders_item` FOR EACH ROW
BEGIN
    #///////////////////////////////////////////////////////////////////////////
    DECLARE sub_product_id,product_id,quantity INT;
  
    select `orders_item`.`sub_product_id`, `orders_item`.`orders_item`,`orders_item`.`quantity`
    INTO sub_product_id,product_id,quantity  from `orders_item`                                                                                                                                 INNER JOIN `homeworks`  ON `homeworks`.`homework_id`= `homeworkresult`.`id_homework`
    where id=NEW.id;
    
     update `sub_product_count` set `sub_product_count`.`count`= `sub_product_count`.`count` - quantity  
      where  `sub_product_count`.`id` = sub_product_id ;
      
      update `products` set `products`.`count`= `products`.`count` - quantity  
      where  `products`.`id` = product_id ;
END;
DELIMITER ;



DELIMITER $$
CREATE TRIGGER before_delete_orders_item AFTER DELETE ON `orders_item` FOR EACH ROW
BEGIN
    #///////////////////////////////////////////////////////////////////////////
    DECLARE sub_product_id,product_id,quantity INT;
  
    select `orders_item`.`sub_product_id`, `orders_item`.`orders_item`,`orders_item`.`quantity`
    INTO sub_product_id,product_id,quantity  from `orders_item`                                                                                                                                 INNER JOIN `homeworks`  ON `homeworks`.`homework_id`= `homeworkresult`.`id_homework`
    where id=OLD.id;
    
     update `sub_product_count` set `sub_product_count`.`count`= `sub_product_count`.`count` + quantity  
      where  `sub_product_count`.`id` = sub_product_id ;
      
      update `products` set `products`.`count`= `products`.`count` + quantity  
      where  `products`.`id` = product_id ;
END;
DELIMITER ;


