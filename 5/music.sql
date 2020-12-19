-- Creating a database called 'Music'
CREATE DATABASE Music
    DEFAULT CHARACTER SET utf8;

-- Switching Database to Music
USE Music;

-- Creating Tables
CREATE TABLE Artist (
  artist_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(artist_id)
) ENGINE = InnoDB;

CREATE TABLE Album (
  album_id INTEGER NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  artist_id INTEGER,
  PRIMARY KEY(album_id),
  INDEX USING BTREE (title),

  CONSTRAINT FOREIGN KEY (artist_id)
    REFERENCES Artist (artist_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE Genre (
  genre_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(genre_id),
  INDEX USING BTREE (name)
) ENGINE = InnoDB;

CREATE TABLE Track (
  track_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  len INTEGER,
  rating INTEGER,
  count INTEGER,
  album_id INTEGER,
  genre_id INTEGER,
  INDEX USING BTREE (title),

  CONSTRAINT FOREIGN KEY (album_id) REFERENCES Album (album_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (genre_id) REFERENCES Genre (genre_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Inserting Data
INSERT INTO Artist (name) VALUES ('Jesper Kyd');
INSERT INTO Artist (name) VALUES ('Harry Callaghan');
INSERT INTO Artist (name) VALUES ('Lost Years');

INSERT INTO Genre (name) VALUES ('Rock');
INSERT INTO Genre (name) VALUES ('Metal');
INSERT INTO Genre (name) VALUES ('Game');
INSERT INTO Genre (name) VALUES ('Jazz');
INSERT INTO Genre (name) VALUES ('Electronic');

INSERT INTO Album (title, artist_id) VALUES ('AC2 Black Edition Album', 1);
INSERT INTO Album (title, artist_id) VALUES ('AC1 Soundtrack', 1);
INSERT INTO Album (title, artist_id) VALUES ('Portal Stories: Mel Soundtrack', 2);
INSERT INTO Album (title, artist_id) VALUES ('Aperture Tag', 2);
INSERT INTO Album (title, artist_id) VALUES ('Amplifier', 3);

-- AC2 Black Edition Album
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Earth', 5, 359, 1, 1, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Venice Rooftops', 5, 318, 2, 1, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Ezio in Florence', 5, 219, 3, 1, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Home in Florence', 5, 502, 4, 1, 3);
-- AC1 OST
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('City of Jerusalem', 5, 311, 1, 2, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Flight Through Jerusalem', 5, 339, 2, 2, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Spirit of Damascus', 5, 131, 3, 2, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Trouble In Jerusalem', 5, 404, 4, 2, 3);
-- Portal: Mel OST
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Interfacing', 5, 235, 1, 3, 5);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Arrival', 5, 150, 2, 3, 5);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Aperture Central', 5, 130, 3, 3, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Time and Time Again', 5, 421, 0, 3, 4);
-- Aperture Tag
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Arrival', 5, 114, 1, 4, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Art Therapy', 5, 248, 2, 4, 3);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('Still Alive (Metal ver.)', 5, 303, 3, 4, 2);
INSERT INTO Track
  (title, rating, len, count, album_id, genre_id)
  VALUES ('All these Walls', 5, 835, 4, 4, 1);
-- Amplifier
INSERT INTO Track
    (title, rating, len, count, album_id, genre_id)
    VALUES ('Amplifier', 5, 335, 1, 5, 1);
INSERT INTO Track
    (title, rating, len, count, album_id, genre_id)
    VALUES ('Converter', 5, 418, 1, 5, 1);
INSERT INTO Track
    (title, rating, len, count, album_id, genre_id)
    VALUES ('Park Avenue 1989', 5, 425, 1, 5, 1);
INSERT INTO Track
    (title, rating, len, count, album_id, genre_id)
    VALUES ('Controlled Faith', 5, 427, 1, 5, 1);


-- Showing which artist created which Album
SELECT Album.title, Artist.name FROM Album JOIN Artist ON Album.artist_id = Artist.artist_id

-- Show Genre AND Artist only
SELECT DISTINCT Artist.name, Genre.name FROM Track JOIN Genre JOIN Album JOIN Artist ON Track.genre_id = Genre.genre_id AND Track.album_id = Album.album_id AND Album.artist_id = Artist.artist_id;

-- Showing all of the genres for a particular artist
SELECT DISTINCT Artist.name, Genre.name FROM Track JOIN Genre JOIN Album JOIN Artist ON Track.genre_id = Genre.genre_id AND Track.album_id = Album.album_id AND Album.artist_id = Artist.artist_id WHERE Artist.name = 'Jesper Kyd';
SELECT DISTINCT Artist.name, Genre.name FROM Track JOIN Genre JOIN Album JOIN Artist ON Track.genre_id = Genre.genre_id AND Track.album_id = Album.album_id AND Album.artist_id = Artist.artist_id WHERE Artist.name = 'Harry Callaghan';
SELECT DISTINCT Artist.name, Genre.name FROM Track JOIN Genre JOIN Album JOIN Artist ON Track.genre_id = Genre.genre_id AND Track.album_id = Album.album_id AND Album.artist_id = Artist.artist_id WHERE Artist.name = 'Lost Years';

-- Print All
SELECT Track.title, Artist.name, Album.title, Genre.name FROM Track JOIN Genre JOIN Album JOIN Artist ON Track.genre_id = Genre.genre_id AND Track.album_id = Album.album_id AND Album.artist_id = Artist.artist_id;
