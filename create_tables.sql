/******  CREATE LIBRARY TABLE ******/
CREATE TABLE LIBRARY (
	libNo bigint NOT NULL PRIMARY KEY,
	libName varchar (100) NOT NULL ,
	location varchar (50) NOT NULL ,
	noRooms int NOT NULL 
);
  
/******  CREATE AUTHOR TABLE ******/
CREATE TABLE AUTHOR (
	authorNo bigint NOT NULL PRIMARY KEY,
	authorName varchar (100) NOT NULL
);


/******  CREATE PATRON TABLE ******/
CREATE TABLE PATRON (
	patronNo bigint NOT NULL PRIMARY KEY,
	patronName varchar (100) NOT NULL ,
	patronType varchar (50) NOT NULL
);

/******  CREATE BOOK TABLE ******/
CREATE TABLE BOOK (
	bookNo bigint NOT NULL PRIMARY KEY,
	title varchar (200) NOT NULL ,
	noPages int NOT NULL ,
	authorNo bigint NOT NULL
);

/******  CREATE COPYBOOK TABLE *****AUTHOR*/
CREATE TABLE COPYBOOK (
	copyNo bigint NOT NULL PRIMARY KEY,
	libNo bigint NOT NULL ,
	bookNo bigint NOT NULL ,
	cost int NOT NULL
);

/******  CREATE LOAN TABLE ******/
CREATE TABLE LOAN (
	loanNo bigint NOT NULL PRIMARY KEY,
	copyNo bigint NOT NULL ,
	patronNo bigint NOT NULL ,
	checkOutDate date NOT NULL ,
    dueDate date NOT NULL
);  
/***** END OF SCRIPT *****/