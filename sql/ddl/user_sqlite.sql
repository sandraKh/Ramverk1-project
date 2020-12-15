--
-- Creating a User table.
--



--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "acronym" TEXT UNIQUE NOT NULL,
    "password" TEXT,
    "email" TEXT,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME,
    "active" INT
);

DROP TABLE IF EXISTS Question;
CREATE TABLE Question (
    "questionId" INTEGER PRIMARY KEY NOT NULL,
    "userId" INTEGER NOT NULL,
    "title" TEXT,
    "text" TEXT
);

DROP TABLE IF EXISTS Tag;
CREATE TABLE Tag (
    "tagId" INTEGER PRIMARY KEY NOT NULL,
    "tag" TEXT NOT NULL,
    "questionId" INTEGER NOT NULL
);

DROP TABLE IF EXISTS Answer;
CREATE TABLE Answer (
    "answerId" INTEGER PRIMARY KEY NOT NULL,
    "userId" INTEGER NOT NULL,
    "questionid" INTEGER,
    "text" TEXT NOT NULL
);

DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
    "commentId" INTEGER PRIMARY KEY NOT NULL,
    "questionId" TEXT NOT NULL,
    "userId" INTEGER NOT NULL,
    "answerId" INTEGER NOT NULL,
    "text" TEXT
);
