/* Create a table */

CREATE TABLE words (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user varchar(20) NOT NULL,
    cz varchar(20) NOT NULL,
    en varchar(20) NOT NULL,
    des text,
    date date NOT NULL
);

/* Test insert */

INSERT INTO words (
    user,
    cz,
    en,
    des,
    date
) VALUES (
    'admin',
    'testCz',
    'testEn',
    'testDes',
    now()
);