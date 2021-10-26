/* Create a table words */

CREATE TABLE words (
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user varchar(20) NOT NULL,
    cz varchar(20) NOT NULL,
    en varchar(20) NOT NULL,
    des text,
    date date NOT NULL
);

/* Test insert words */

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

/* Create a table users */

CREATE TABLE users (
    id int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user varchar(20) NOT NULL,
    pwd text NOT NULL,
    role varchar(20) NOT NULL
);

/* Test insert words */

INSERT INTO users (
    user,
    pwd,
    role
) VALUES (
    'admin',
    '$2y$10$ZMMG07w0o2Xj.Sx7HIjGxe6EwJsrfgNzewtvvtZEindae/9C.Rd/2', /* pwd -> 01 */
    'superadmin'
);