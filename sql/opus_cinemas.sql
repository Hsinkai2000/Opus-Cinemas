CREATE DATABASE opus_cinemas;

use opus_cinemas;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email varchar(255),
  password varchar(255)
);

CREATE TABLE cinemas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  picture varchar(255),
  name varchar(255),
  description varchar(255)
);

CREATE TABLE movies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cinema_id INT,
  genre VARCHAR(255),
  title VARCHAR(255),
  description VARCHAR(255),
  picture VARCHAR(255),
  director VARCHAR(255),
  writers VARCHAR(255),
  actors VARCHAR(255)
);

CREATE TABLE movie_timings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  movie_id INT,
  cinema_id INT,
  timing VARCHAR(255)
);

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  movie_timing_id INT,
  seats VARCHAR(255),
  price VARCHAR(255),
  name VARCHAR(255),
  email VARCHAR(255)
);

CREATE TABLE customer_support (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  question VARCHAR(255)
);

INSERT INTO users (email, password) VALUES 
('john.doe@example.com', '123'), -- password: secret123
('jane.smith@example.com', 'yolo'), -- password: secret123
('alice.brown@example.com', 'hahahahahaha'), -- password: secret123
('bob.johnson@example.com', 'gpa5pointer'), -- password: secret123
('charlie.davis@example.com', 'ie4727'),
('irfansyakir@gmail.com', 'plswork');


-- Now Showing Movies
INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Animation', 'Avatar: The Last Airbender', 'A young boy embarks on an epic journey to restore balance to the world.', 'assets/covers/avatar_the_last_airbender_cover.png', 'Michael Dante DiMartino', 'Michael Dante DiMartino, Bryan Konietzko', 'Zach Tyler, Mae Whitman');

INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Action', 'Aquaman', 'The King of Atlantis embarks on a quest to find the Trident of Atlan.', 'assets/covers/aquaman_cover.png', 'James Wan', 'David Leslie Johnson-McGoldrick', 'Jason Momoa, Amber Heard');

INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Action', 'Deadpool x Wolverine', 'Deadpool and Wolverine team up for a new adventure.', 'assets/covers/deadpool_x_wolverine_cover.png', 'Shawn Levy', 'Rhett Reese, Paul Wernick', 'Ryan Reynolds, Hugh Jackman');

INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Sci-Fi', 'Quantumania', 'Ant-Man and the Wasp battle a new threat from the quantum realm.', 'assets/covers/quantumania_cover.png', 'Peyton Reed', 'Jeff Loveness', 'Paul Rudd, Evangeline Lilly');

INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Comedy', 'Garfield: The Movie', 'The lazy cat Garfield embarks on a fun adventure.', 'assets/covers/garfield_cover.png', 'Peter Hewitt', 'Joel Cohen, Alec Sokolow', 'Bill Murray, Breckin Meyer');

-- Upcoming Movies
INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Action', 'Fighter', 'A high-octane fighter pilot action movie.', 'assets/covers/fighter_cover.png', 'Unknown', 'Unknown', 'Unknown');

INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Drama', 'Symphony', 'A gripping musical drama.', 'assets/covers/symphony_cover.png', 'Unknown', 'Unknown', 'Unknown');

INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Animation', 'Inside Out 2', 'The sequel to the animated film about the emotions inside a young girl.', 'assets/covers/inside_out_2_cover.png', 'Unknown', 'Unknown', 'Unknown');

INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Adventure', 'Wonka', 'The origin story of the famous chocolatier Willy Wonka.', 'assets/covers/wonka_cover.png', 'Paul King', 'Simon Farnaby', 'Timothée Chalamet');

INSERT INTO movies (cinema_id, genre, title, description, picture, director, writers, actors) 
VALUES (1, 'Sci-Fi', 'The Creator', 'A futuristic sci-fi thriller.', 'assets/covers/the_creator_cover.png', 'Gareth Edwards', 'Gareth Edwards', 'John David Washington');