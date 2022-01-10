CREATE DATABASE car_rental_system;
CREATE TABLE car
(
    car_id      VARCHAR(10) PRIMARY KEY,
    model       VARCHAR(20) NOT NULL,
    year        INT         NOT NULL,
    color       VARCHAR(10) NOT NULL,
    status      VARCHAR(50) NOT NULL,
    off_id      INT,
    is_reserved BOOLEAN     DEFAULT false,
    price_per_day DECIMAL(10,2) NOT NULL
);
CREATE TABLE office
(
    off_id  INT PRIMARY KEY,
    `name`  VARCHAR(20) NOT NULL,
    country VARCHAR(20) NOT NULL,
    city    VARCHAR(20) NOT NULL
);

CREATE TABLE customer
(
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name  VARCHAR(255) NOT NULL,
    last_name   VARCHAR(255) NOT NULL,
    Street_name VARCHAR(255) NOT NULL,
    city        VARCHAR(255) NOT NULL,
    country     VARCHAR(255) NOT NULL,
    email       VARCHAR(255) NOT NULL UNIQUE,
    `password`  VARCHAR(255) NOT NULL,
    phone_no    VARCHAR(255) NOT NULL
);

CREATE Table reservation
(
    res_id      int AUTO_INCREMENT UNIQUE,
    customer_id INT,
    car_id      VARCHAR(10),
    res_date    DATE DEFAULT CURRENT_TIMESTAMP,
    pick_date   DATE NOT NULL,
    return_date DATE NOT NULL,
    duration    INT AS (timestampdiff (day, pick_date, return_date)),
    PRIMARY KEY (res_id, customer_id, car_id)
);

CREATE Table payment
(
    res_id      INT ,
    is_paid     BOOLEAN,
    pay_date    DATETIME,
    PRIMARY KEY (res_id)
);
CREATE TABLE car_status
(
	car_id VARCHAR(10),
	status VARCHAR(50),
	date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (car_id,date)
);
CREATE VIEW customer_payment AS
	SELECT p.* , (c.price_per_day * r.duration) total_pay
	FROM car c NATURAL JOIN reservation r NATURAL JOIN payment p;

ALTER TABLE car
    ADD FOREIGN KEY (off_id) REFERENCES office (off_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE reservation
    ADD FOREIGN KEY (customer_id) REFERENCES customer (customer_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE reservation
    ADD FOREIGN KEY (car_id) REFERENCES car (car_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE payment
    ADD FOREIGN KEY (res_id) REFERENCES reservation (res_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE car_status
    ADD FOREIGN KEY (car_id) REFERENCES car (car_id) ON DELETE CASCADE ON UPDATE CASCADE;



CREATE VIEW report4 AS
SELECT *

FROM
    customer as c
NATURAL JOIN reservation as r
 NATURAL JOIN customer_payment as cp NATURAL JOIN car;

CREATE VIEW report1 AS
SELECT *
FROM
	car NATURAL JOIN reservation r NATURAL JOIN customer;

CREATE VIEW report3 AS 
SELECT *
FROM
	car NATURAL JOIN reservation r GROUP BY r.res_id;