use car_rental_system;
INSERT INTO `customer`(`customer_id`, `first_name`, `last_name`, `Street_name`, `city`, `country`, `email`, `password`, `phone_no`) VALUES ('1','omar','ahmed','aaa','alx','eg','ma@aa.a','aa','54434');
INSERT INTO `customer`(`customer_id`, `first_name`, `last_name`, `Street_name`, `city`, `country`, `email`, `password`, `phone_no`) VALUES ('2','mohamed','ahmed','bbb','cairo','eg','a.33@all.c','a','0109232');

INSERT INTO office(off_id,name,country,city)VALUES('1','Alexandria Office','Egypt','Alexandria');
INSERT INTO office(off_id,name,country,city)VALUES('2','Cairo Office','Egypt','Cairo');
INSERT INTO office(off_id,name,country,city)VALUES('3','Smoha Office','Egypt','Alexandria');
INSERT INTO office(off_id,name,country,city) VALUES ('5','louza','egypt','alex');

INSERT INTO car (car_id,model,`year`,color,`status`,off_id,price_per_day) VALUES ('ABCD','Cherry121',2015,'Dark Blue','active',5,1000);
INSERT INTO car (car_id,model,`year`,color,`status`,off_id,price_per_day) VALUES ('HELLO','Toyota',2018,'Black','active',1,1500);

INSERT INTO reservation(res_id,customer_id,car_id,pick_date,return_date)VALUES('1','2','ABCD','2022-1-1','2022-1-2');
INSERT INTO payment(res_id,is_paid,pay_date)VALUES('1',true,'2022-1-1');

INSERT INTO reservation(res_id,customer_id,car_id,pick_date,return_date)VALUES('2','2','HELLO','2022-1-1','2022-1-1');
INSERT INTO payment(res_id,is_paid,pay_date)VALUES('2',true,'2022-1-2');

INSERT INTO reservation(res_id,customer_id,car_id,pick_date,return_date)VALUES('3','1','HELLO','2022-6-1','2022-7-1');