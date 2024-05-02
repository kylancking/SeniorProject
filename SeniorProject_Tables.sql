DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS itemrequests;
DROP TABLE IF EXISTS requests;
Drop Table IF Exists externalusers;
DROP TABLE IF EXISTS items; 
DROP TABLE IF EXISTS utype;


CREATE TABLE utype (
	typeid int not null,
	description varchar(20),
	PRIMARY KEY (typeid)
);


CREATE TABLE users (
	username varchar(50) NOT NULL,
	hashed_password varchar(60) NOT NULL,
	usertype int not null,
	PRIMARY KEY (username)
);


CREATE TABLE externalusers (
	id int NOT NULL auto_increment,
	username varchar(50),
	hashed_password varchar(60),
	firstname varchar(20),
	lastname varchar(20),
	phonenumber varchar(10),
        street varchar(30),
        city varchar (30),
        state varchar (2),
        zip int,
        visits int,


	PRIMARY KEY (id)
);


CREATE TABLE items (
	itemid int NOT NULL auto_increment,
	description varchar(50) NOT NULL,
	qty int NOT NULL,
	margin int NOT NULL,

	PRIMARY KEY (itemid)
);


CREATE TABLE requests (
	reqid int NOT NULL auto_increment,
	userid int NOT NULL,
	date DATE,
	fulfilled boolean NOT NULL,

	PRIMARY KEY (reqid)
);


CREATE TABLE itemrequests (
	reqid int not null,
	itemid int not null,
	quantity int,
	PRIMARY KEY (reqid,itemid)
);


ALTER TABLE itemrequests ADD CONSTRAINT FK_req FOREIGN KEY (reqid) REFERENCES requests(reqid);
ALTER TABLE itemrequests ADD CONSTRAINT FK_items FOREIGN KEY (itemid) REFERENCES items(itemid);
ALTER TABLE requests ADD CONSTRAINT FK_user FOREIGN KEY (userid) REFERENCES externalusers(id);
ALTER TABLE users ADD CONSTRAINT FK_utype FOREIGN KEY (usertype) REFERENCES utype(typeid);


Insert into utype values(0,'admin');
Insert into users values('admin','$2y$10$ZmIwYjRiYzFiMzZjYWUzZ.knWDILLOMZgGuCV5YcsPjltP1.WE1y2',0);
insert into externalusers values ('0','user','$2y$10$ZmIwYjRiYzFiMzZjYWUzZ.knWDILLOMZgGuCV5YcsPjltP1.WE1y2', 'Church','Walkin','6623973396','123 Sesame St','Sunnytown','PA','24575','0');
insert into items values ('1','Jiffy','30','10');
insert into items values (NULL,'Peanut Butter','20','10');
insert into items values (NULL,'Corn','30','15');
insert into items values (NULL,'Flour','30','24');
insert into items values (NULL,'Peaches','30','12');
insert into items values (NULL,'Pinto Beans','30','10');
insert into items values (NULL,'Rice','3','10');

insert into items values (NULL,'Sugar','30','30');
insert into items values (NULL,'Crackers','20','10');
insert into items values (NULL,'Instant Potatoes','20','10');
insert into items values (NULL,'Vegetable Oil','20','10');
insert into items values (NULL,'Peanut Butter','20','10');
insert into items values (NULL,'Cereal','20','10');
insert into items values (NULL,'Soup','20','10');
insert into items values (NULL,'Vienna Sausages','30','30');
insert into items values (NULL,'Lunch Meat','30','30');
insert into items values (NULL,'Tuna','30','30');
insert into items values (NULL,'Jelly','30','30');
insert into items values (NULL,'Spaghetti Noodles','30','30');
insert into items values (NULL,'Ketchup','30','30');
insert into items values (NULL,'Mayo','30','30');
insert into items values (NULL,'Meat Sauce','30','30');
insert into items values (NULL,'Mac and Cheese','30','30');
insert into items values (NULL,'Ramen Noodles','30','30');
insert into items values (NULL,'Pork and Beans','30','30');
insert into items values (NULL,'Green Beans','30','30');
insert into items values (NULL,'Special','10','0');




insert into requests values ('1','1','2024-01-01','1');
