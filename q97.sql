SELECT `products`.`pid`, `products`.`name`
FROM `products`
  LEFT JOIN `junction`
    ON `products`.`pid` = `junction`.`pid`
  LEFT JOIN `category`
    ON `junction`.`cid` = `category`.`cid`
GROUP BY `products`.`pid`
HAVING SUM(`enabled` OR `enabled` IS NULL) = COUNT(`products`.`pid`);
