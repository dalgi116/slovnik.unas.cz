/* Create a table words */

CREATE TABLE words (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user varchar(20) NOT NULL,
    cz text NOT NULL,
    en text NOT NULL,
    des text,
    lection varchar(20) NOT NULL,
    date date NOT NULL
);

/* Test insert words */

INSERT INTO words (
    user,
    cz,
    en,
    des,
    lection,
    date
) VALUES (
    'admin',
    'testCz',
    'testEn',
    'testDes',
    '-default-',
    now()
);

/* Create a table users */

CREATE TABLE users (
    id int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user varchar(20) NOT NULL,
    pwd text NOT NULL,
    role varchar(20) NOT NULL
);

/* Insert superadmin */

INSERT INTO users (
    user,
    pwd,
    role
) VALUES (
    'admin',
    '$2y$10$ZMMG07w0o2Xj.Sx7HIjGxe6EwJsrfgNzewtvvtZEindae/9C.Rd/2', /* pwd -> 01 */
    'superadmin'
);

/* Create table lections */

CREATE TABLE lections (
    id int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    date date NOT NULL,
    user varchar(20) NOT NULL
);

/* Insert default lection */

INSERT INTO lections (
    name,
    date,
    user
) VALUES (
    '-default-',
    now(),
    ''
);