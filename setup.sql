DROP DATABASE IF EXISTS SecProg;
CREATE DATABASE SecProg;
USE SecProg;

CREATE TABLE Users(UserId INT PRIMARY KEY AUTO_INCREMENT, Password TEXT, UserName TEXT, IsAdmin BOOLEAN);
INSERT INTO Users(Password, UserName, IsAdmin) VALUES("123", "Alice", 1);
INSERT INTO Users(Password, UserName, IsAdmin) VALUES("456", "Bob", 1);
INSERT INTO Users(Password, UserName, IsAdmin) VALUES("789", "Carol", 0);
INSERT INTO Users(Password, UserName, IsAdmin) VALUES("abc", "Dave", 0);

CREATE TABLE Posts(CommentId INT PRIMARY KEY AUTO_INCREMENT, CommentorId INT, Comment TEXT, FOREIGN KEY (CommentorId) REFERENCES Users(UserId));
INSERT INTO Posts(CommentorId, Comment) VALUES(1, "HAHA");
INSERT INTO Posts(CommentorId, Comment) VALUES(1, "BLABLA");
INSERT INTO Posts(CommentorId, Comment) VALUES(2, "Hello");
INSERT INTO Posts(CommentorId, Comment) VALUES(3, "Cool");
INSERT INTO Posts(CommentorId, Comment) VALUES(4, "1337");

CREATE TABLE Messages(MessageId INT PRIMARY KEY AUTO_INCREMENT, ClientName TEXT,
                      MailAddress TEXT, Subject TEXT, PhoneNumber TEXT, Message TEXT);

-- Select all users that are administrators.
SELECT * FROM Users WHERE IsAdmin=1;

-- Select all comments that user number 1 has commented
SELECT * FROM Posts WHERE CommentorId=1;

