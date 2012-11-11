use dbname;

CREATE TABLE BROWSER_LINKBOARD_MEMBER
(
	member_id int auto_increment primary key,
	member_name varchar(20),
	url varchar(300),
	member_type int
);

CREATE TABLE BROWSER_LINKBOARD_URL
(
	id int auto_increment primary key,
	member_id int not null,
	url varchar(300),
	url_desc varchar(300)
);
