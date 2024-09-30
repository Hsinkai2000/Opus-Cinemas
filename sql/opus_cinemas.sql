CREATE DATABASE opus_cinemas;

USE opus_cinemas;

-- Users table
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255),
  password VARCHAR(255)
);

-- Cinemas table
CREATE TABLE cinemas (
  cinema_id INT AUTO_INCREMENT PRIMARY KEY,
  picture VARCHAR(255),
  name VARCHAR(255),
  description TEXT
);

-- Movies table
CREATE TABLE movies (
  movie_id INT AUTO_INCREMENT PRIMARY KEY,
  genre VARCHAR(255),
  title VARCHAR(255),
  description TEXT,
  picture VARCHAR(255),
  director VARCHAR(255),
  writers VARCHAR(255),
  actors VARCHAR(255),
  isUpcoming BOOLEAN DEFAULT FALSE
);

-- Junction table for cinemas and movies (Many-to-Many relationship)
CREATE TABLE cinemas_movies (
  cinema_id INT,
  movie_id INT,
  PRIMARY KEY (cinema_id, movie_id),  -- Composite Primary Key
  FOREIGN KEY (cinema_id) REFERENCES cinemas(cinema_id),
  FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
);

-- Movie timings table
CREATE TABLE movie_timings (
  movie_timing_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique primary key
  cinema_id INT,
  movie_id INT,
  timing VARCHAR(255),
  FOREIGN KEY (cinema_id) REFERENCES cinemas(cinema_id),
  FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
  UNIQUE (cinema_id, movie_id, timing)  -- Ensure unique timing for a cinema and movie
);

-- Bookings table
CREATE TABLE bookings (
  booking_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  movie_timing_id INT,
  seats VARCHAR(255),
  price VARCHAR(255),
  name VARCHAR(255),
  email VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (movie_timing_id) REFERENCES movie_timings(movie_timing_id)
);

-- Customer support table
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
INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Animation', 'Avatar: The Last Airbender', 'A young boy embarks on an epic journey to restore balance to the world.', 'assets/covers/avatar_the_last_airbender_cover.png', 'Michael Dante DiMartino', 'Michael Dante DiMartino, Bryan Konietzko', 'Zach Tyler, Mae Whitman');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Action', 'Aquaman', 'The King of Atlantis embarks on a quest to find the Trident of Atlan.', 'assets/covers/aquaman_cover.png', 'James Wan', 'David Leslie Johnson-McGoldrick', 'Jason Momoa, Amber Heard');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Action', 'Deadpool x Wolverine', 'Deadpool and Wolverine team up for a new adventure.', 'assets/covers/deadpool_x_wolverine_cover.png', 'Shawn Levy', 'Rhett Reese, Paul Wernick', 'Ryan Reynolds, Hugh Jackman');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Sci-Fi', 'Quantumania', 'Ant-Man and the Wasp battle a new threat from the quantum realm.', 'assets/covers/quantumania_cover.png', 'Peyton Reed', 'Jeff Loveness', 'Paul Rudd, Evangeline Lilly');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Comedy', 'Garfield: The Movie', 'The lazy cat Garfield embarks on a fun adventure.', 'assets/covers/garfield_cover.png', 'Peter Hewitt', 'Joel Cohen, Alec Sokolow', 'Bill Murray, Breckin Meyer');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Action', 'Fistful Scavengers', 'A young boy embarks on an epic journey to restore balance to the world.', 'assets/covers/fistful_scavengers_cover.png', 'Michael Dante DiMartino', 'Michael Dante DiMartino, Bryan Konietzko', 'Zach Tyler, Mae Whitman');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Drama', 'Little Mermaid', 'The King of Atlantis embarks on a quest to find the Trident of Atlan.', 'assets/covers/little_mermaid_cover.png', 'James Wan', 'David Leslie Johnson-McGoldrick', 'Jason Momoa, Amber Heard');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Action', 'Dynasty', 'Deadpool and Wolverine team up for a new adventure.', 'assets/covers/dynasty_cover.png', 'Shawn Levy', 'Rhett Reese, Paul Wernick', 'Ryan Reynolds, Hugh Jackman');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Action', 'Avatar: The Lost Ark', 'Ant-Man and the Wasp battle a new threat from the quantum realm.', 'assets/covers/avatar_the_lost_ark_cover.png', 'Peyton Reed', 'Jeff Loveness', 'Paul Rudd, Evangeline Lilly');

INSERT INTO movies (genre, title, description, picture, director, writers, actors) 
VALUES ('Animation', 'Up!', 'The lazy cat Garfield embarks on a fun adventure.', 'assets/covers/up_cover.png', 'Peter Hewitt', 'Joel Cohen, Alec Sokolow', 'Bill Murray, Breckin Meyer');



-- Upcoming Movies
INSERT INTO movies (genre, title, description, picture, director, writers, actors, isUpcoming) 
VALUES ('Action', 'Fighter', 'A high-octane fighter pilot action movie.', 'assets/covers/fighter_cover.png', 'Unknown', 'Unknown', 'Unknown', TRUE);

INSERT INTO movies (genre, title, description, picture, director, writers, actors, isUpcoming) 
VALUES ('Drama', 'Symphony', 'A gripping musical drama.', 'assets/covers/symphony_cover.png', 'Unknown', 'Unknown', 'Unknown', TRUE);

INSERT INTO movies (genre, title, description, picture, director, writers, actors, isUpcoming) 
VALUES ('Animation', 'Inside Out 2', 'The sequel to the animated film about the emotions inside a young girl.', 'assets/covers/inside_out_2_cover.png', 'Unknown', 'Unknown', 'Unknown', TRUE);

INSERT INTO movies (genre, title, description, picture, director, writers, actors, isUpcoming) 
VALUES ('Adventure', 'Wonka', 'The origin story of the famous chocolatier Willy Wonka.', 'assets/covers/wonka_cover.png', 'Paul King', 'Simon Farnaby', 'Timothée Chalamet', TRUE);

INSERT INTO movies (genre, title, description, picture, director, writers, actors, isUpcoming) 
VALUES ('Sci-Fi', 'The Creator', 'A futuristic sci-fi thriller.', 'assets/covers/the_creator_cover.png', 'Gareth Edwards', 'Gareth Edwards', 'John David Washington', TRUE);





INSERT INTO cinemas (name, description, picture)
VALUES ('The Picture Palace', 'Step into a timeless realm of cinematic grandeur at The Picture Palace. This opulent establishment boasts plush velvet seats, ornate chandeliers, and a state-of-the-art sound system that envelops you in the film''s world. Indulge in gourmet popcorn and a curated selection of fine wines and spirits, served by attentive staff in a luxurious lounge. ', 'assets/picturepalace.png');

INSERT INTO cinemas (name, description, picture)
VALUES ('Starlight Cinema', 'Underneath a canopy of twinkling stars, Starlight Cinema offers an unforgettable cinematic experience. Recline in comfortable loungers, wrapped in cozy blankets, as you enjoy a film on a massive outdoor screen. A gourmet food truck serves up delectable treats, while a fire pit provides warmth and ambiance.  ', 'assets/starlightcinema.png');

INSERT INTO cinemas (name, description, picture)
VALUES ('The Exclusive Enclave', 'For the discerning cinephile, The Exclusive Enclave is a private oasis. This intimate theater features custom-designed seating, a personalized bar, and a state-of-the-art projection system. Enjoy a curated selection of films, complete with exclusive screenings and special events. ', 'assets/exclusiveenclave.png');

INSERT INTO cinemas (name, description, picture)
VALUES ('The Grand Theatre', 'Experience the epitome of cinematic luxury at The Grand Theatre. This majestic venue features a grand foyer adorned with intricate details, a sweeping staircase, and a stunning auditorium with plush velvet seats and ornate chandeliers. Indulge in a gourmet meal or a glass of champagne before the show, and enjoy the impeccable service that defines this extraordinary experience. ', 'assets/grandtheatre.png');



INSERT INTO cinemas_movies (cinema_id, movie_id) VALUES (1, 1);
INSERT INTO cinemas_movies (cinema_id, movie_id) VALUES (1, 2);
INSERT INTO cinemas_movies (cinema_id, movie_id) VALUES (1, 3);
INSERT INTO cinemas_movies (cinema_id, movie_id) VALUES (2, 1);
INSERT INTO cinemas_movies (cinema_id, movie_id) VALUES (2, 3);
INSERT INTO cinemas_movies (cinema_id, movie_id) VALUES (2, 4);
INSERT INTO cinemas_movies (cinema_id, movie_id) VALUES (3, 1);  
INSERT INTO cinemas_movies (cinema_id, movie_id) VALUES (3, 6);