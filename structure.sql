CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(255) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    nome varchar(255) not null,
    cognome varchar(255) not null,
    number_posts integer default 0,
    image_profile varchar(255)
) Engine = InnoDB;

CREATE TABLE posts (
    idpost integer primary key auto_increment,
    user integer not null,
    number_likes integer default 0,
    number_comments integer default 0,
    image varchar(500),
    descrizione varchar(1000),
    index index_user(user),
    tips VARCHAR(500),
    foreign key(user) references users(id) on delete cascade on update cascade
) Engine = InnoDB;



CREATE TABLE likes (
    idlikes integer primary key auto_increment,
    user integer not null,
    post integer not null,
    index index_user(user),
    index index_post(post),
    foreign key(user) references users(id) on delete cascade on update cascade,
    foreign key(post) references posts(idpost) on delete cascade on update cascade
) Engine = InnoDB;

CREATE TABLE prefs (
    idpref integer primary key auto_increment,
    user integer not null,
    post integer not null,
    index index_user(user),
    index index_post(post),
    foreign key(user) references users(id) on delete cascade on update cascade,
    foreign key(post) references posts(idpost) on delete cascade on update cascade
) Engine = InnoDB;

CREATE TABLE comments (
    idcomment integer primary key auto_increment,
    user integer not null,
    post integer not null,
    testo varchar(500),
    index index_user(user),
    index index_post(post),
    foreign key(user) references users(id) on delete cascade on update cascade,
    foreign key(post) references posts(idpost) on delete cascade on update cascade
) Engine = InnoDB;




DELIMITER //
CREATE TRIGGER likes_trigger
AFTER INSERT ON likes
FOR EACH ROW
BEGIN
UPDATE posts
SET number_likes = number_likes + 1
WHERE idpost = new.post;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER comments_trigger
AFTER INSERT ON comments
FOR EACH ROW
BEGIN
UPDATE posts
SET number_comments = number_comments + 1
WHERE idpost = new.post;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER unlikes_trigger
BEFORE DELETE ON likes
FOR EACH ROW
BEGIN
UPDATE posts
SET number_likes = number_likes - 1
WHERE idpost = old.post;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER posts_trigger
AFTER INSERT ON posts
FOR EACH ROW
BEGIN
UPDATE users
SET number_posts = number_posts + 1
WHERE id = new.user;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER postdelete_trigger
AFTER DELETE ON posts
FOR EACH ROW
BEGIN
UPDATE users
SET number_posts = number_posts - 1
WHERE id = old.user;
END //
DELIMITER ;
