SELECT `products`.`pid`, `products`.`name`
FROM `products`
  JOIN `junction`
    ON `products`.`pid` = `junction`.`pid`
  JOIN `category`
    ON `junction`.`cid` = `category`.`cid`
GROUP BY `products`.`pid`
HAVING SUM(`enabled`) = COUNT(`products`.`pid`);