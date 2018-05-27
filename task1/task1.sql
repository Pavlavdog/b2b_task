CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  gender ENUM('не указан', 'мужчина', 'женщина') NOT NULL COMMENT '1 - не указан, 2 - мужчина, 3 - жензина.',
  birth_date INT(11) NOT NULL COMMENT  'Дата в unixtime',
  PRIMARY KEY (id)
);

CREATE TABLE phone_numbers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  phone   VARCHAR(32) NOT NULL,
  PRIMARY KEY (id),
  INDEX phone_numbers_users_fk (user_id),
  CONSTRAINT phone_numbers_users_fk FOREIGN KEY (user_id) REFERENCES 	users (id)
);

#Запрос:
SELECT u.name, u.gender,TIMESTAMPDIFF(YEAR, from_unixtime(u.birth_date),CURDATE()) AS Age, count(pn.id) AS Count
FROM b2b.users AS u INNER JOIN b2b.phone_numbers AS pn ON pn.user_id = u.id
WHERE u.gender = 3 AND TIMESTAMPDIFF(YEAR, from_unixtime(u.birth_date),CURDATE()) BETWEEN 18 AND 22 GROUP BY pn.user_id ORDER BY Age;
