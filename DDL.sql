CREATE TABLE Car(
    car_id VARCHAR(10)  PRIMARY KEY,
    model VARCHAR(20) NOT NULL,
    year INT NOT NULL,
    color VARCHAR(10) NOT NULL,
    available BOOLEAN NOT NULL,--(active-TRUE,out_of_service - FALSE)
    off_id INT ,
    is_reserved BOOLEAN NOT NULL
);
CREATE TABLE office(
    off_id INT PRIMARY KEY,
    `name`VARCHAR(20) NOT NULL,
    country VARCHAR(20) NOT NULL,
    city VARCHAR(20) NOT NULL
);

CREATE TABLE Customer(
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(20)  NOT NULL,--name(first , last)
    last_name VARCHAR(20)  NOT NULL,
    Street_name VARCHAR(20) NOT NULL,
    city VARCHAR(20) NOT NULL,       --ADDRESS(street_name, city , country)
    country VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL,
    phone_no VARCHAR(20) NOT NULL
    );

CREATE Table Reservation(
    res_id int AUTO_INCREMENT,
    customer_id INT,
    car_id VARCHAR(10),
    res_date DATE NOT NULL,
    pick_date DATE NOT NULL,
    return_date DATE NOT NULL,
    duration INT,
    PRIMARY KEY(res_id,customer_id,car_id)
);

CREATE Table payment(
    res_id INT,
    customer_id INT,
    total_pay INT,
    is_paid BOOLEAN,
    pay_date DATE,
    PRIMARY KEY(res_id,customer_id)
);

ALTER TABLE CAR
ADD FOREIGN KEY (off_id) REFERENCES office(off_id);

ALTER TABLE reservation
ADD FOREIGN KEY (customer_id) REFERENCES customer(customer_id);

ALTER TABLE reservation
ADD FOREIGN KEY (car_id) REFERENCES car(car_id);

ALTER TABLE payment
ADD FOREIGN KEY (res_id) REFERENCES reservation(res_id);

ALTER TABLE payment
ADD FOREIGN KEY (customer_id) REFERENCES customer(customer_id);
