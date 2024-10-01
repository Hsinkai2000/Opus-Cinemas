
DROP DATABASE opus_cinemas;

CREATE DATABASE opus_cinemas;

USE opus_cinemas;

-- Users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255),
  password VARCHAR(255)
);

-- Cinemas table
CREATE TABLE cinemas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  picture VARCHAR(255),
  name VARCHAR(255),
  description TEXT
);

-- Movies table
CREATE TABLE movies (
  id INT AUTO_INCREMENT PRIMARY KEY,
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
  FOREIGN KEY (cinema_id) REFERENCES cinemas(id),
  FOREIGN KEY (movie_id) REFERENCES movies(id)
);

-- Movie timings table
CREATE TABLE movie_timings (
  id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique primary key
  cinema_id INT,
  movie_id INT,
  timing VARCHAR(255),
  FOREIGN KEY (cinema_id) REFERENCES cinemas(id),
  FOREIGN KEY (movie_id) REFERENCES movies(id),
  UNIQUE (cinema_id, movie_id, timing)  -- Ensure unique timing for a cinema and movie
);

-- Bookings table
CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  movie_timing_id INT,
  seats VARCHAR(255),
  price VARCHAR(255),
  name VARCHAR(255),
  email VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (movie_timing_id) REFERENCES movie_timings(id)
);

-- Customer support table
CREATE TABLE customer_support (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  question VARCHAR(255)
);

CREATE TABLE genres (
	id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    genre VARCHAR(255)
);


INSERT INTO users (email, password) VALUES 
('john.doe@example.com', '123'), -- password: secret123
('jane.smith@example.com', 'yolo'), -- password: secret123
('alice.brown@example.com', 'hahahahahaha'), -- password: secret123
('bob.johnson@example.com', 'gpa5pointer'), -- password: secret123
('charlie.davis@example.com', 'ie4727'),
('irfansyakir@gmail.com', 'plswork');

INSERT INTO genres (movie_id,genre) VALUES (1, "Animation");
INSERT INTO genres (movie_id,genre) VALUES (1, "Action");

INSERT INTO genres (movie_id,genre) VALUES (2, "Action");
INSERT INTO genres (movie_id,genre) VALUES (2, "Adventure");
INSERT INTO genres (movie_id,genre) VALUES (2, "Fantasy");

INSERT INTO genres (movie_id,genre) VALUES (3, "Comedy");
INSERT INTO genres (movie_id,genre) VALUES (3, "Science Fiction");
INSERT INTO genres (movie_id,genre) VALUES (3, "Adventure");

INSERT INTO genres (movie_id,genre) VALUES (4, "Action");
INSERT INTO genres (movie_id,genre) VALUES (4, "Romance");
INSERT INTO genres (movie_id,genre) VALUES (4, "Thriller");

INSERT INTO genres (movie_id,genre) VALUES (5, "Comedy");
INSERT INTO genres (movie_id,genre) VALUES (5, "Animation");
INSERT INTO genres (movie_id,genre) VALUES (5, "Children");
INSERT INTO genres (movie_id,genre) VALUES (5, "Fantasy");

INSERT INTO genres (movie_id,genre) VALUES (6, "Action");
INSERT INTO genres (movie_id,genre) VALUES (6, "Adult");
INSERT INTO genres (movie_id,genre) VALUES (6, "Gore");

INSERT INTO genres (movie_id,genre) VALUES (7, "Animation");
INSERT INTO genres (movie_id,genre) VALUES (7, "Musical");
INSERT INTO genres (movie_id,genre) VALUES (7, "Children");
INSERT INTO genres (movie_id,genre) VALUES (7, "Romance");

INSERT INTO genres (movie_id,genre) VALUES (8, "Action");

INSERT INTO genres (movie_id,genre) VALUES (9, "Action");
INSERT INTO genres (movie_id,genre) VALUES (9, "Fantasy");
INSERT INTO genres (movie_id,genre) VALUES (9, "Science Fiction");

INSERT INTO genres (movie_id,genre) VALUES (10, "Animation");
INSERT INTO genres (movie_id,genre) VALUES (10, "Fantasy");
INSERT INTO genres (movie_id,genre) VALUES (10, "Children");

INSERT INTO genres (movie_id,genre) VALUES (11, "Action");
INSERT INTO genres (movie_id,genre) VALUES (11, "Adult");
INSERT INTO genres (movie_id,genre) VALUES (11, "Gore");

INSERT INTO genres (movie_id,genre) VALUES (12, "Musical");
INSERT INTO genres (movie_id,genre) VALUES (12, "Fantasy");
INSERT INTO genres (movie_id,genre) VALUES (12, "Children");

INSERT INTO genres (movie_id,genre) VALUES (13, "Animation");
INSERT INTO genres (movie_id,genre) VALUES (13, "Science Fiction");
INSERT INTO genres (movie_id,genre) VALUES (13, "Children");

INSERT INTO genres (movie_id,genre) VALUES (14, "Science Fiction");
INSERT INTO genres (movie_id,genre) VALUES (14, "Adventure");
INSERT INTO genres (movie_id,genre) VALUES (14, "Children");

INSERT INTO genres (movie_id,genre) VALUES (15, "Adventure");
INSERT INTO genres (movie_id,genre) VALUES (15, "Science Fiction");
INSERT INTO genres (movie_id,genre) VALUES (15, "Fantasy");

-- Now Showing Movies
INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Avatar: The Last Airbender', 'In a world divided by elemental nations, a young boy named Aang discovers he is the last of the Airbenders and the only one capable of restoring harmony. As he teams up with friends Katara and Sokka, they embark on an epic journey across the globe to master all four elements and defeat the Fire Nation, learning the true meaning of friendship, bravery, and destiny along the way.', 'assets/covers/avatar_the_last_airbender_cover.png', 'Michael Dante DiMartino', 'Michael Dante DiMartino, Bryan Konietzko', 'Zach Tyler, Mae Whitman');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Aquaman', 'Arthur Curry, the reluctant heir to the underwater kingdom of Atlantis, must embrace his destiny as Aquaman to reclaim his throne. With the help of powerful allies, he sets out on an epic quest to prevent a war between the surface world and the underwater realm, all while confronting his own inner demons and the legacy of his mother, Queen Atlanna.', 'assets/covers/aquaman_cover.png', 'James Wan', 'David Leslie Johnson-McGoldrick', 'Jason Momoa, Amber Heard');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Deadpool x Wolverine', 'When a formidable new villain threatens both the worlds of mutants and humans, two of the most unconventional heroes, Deadpool and Wolverine, must reluctantly join forces. Their journey is filled with action, humor, and chaos as they navigate their clashing personalities while facing off against mercenaries and villains that put their skills to the ultimate test.', 'assets/covers/deadpool_x_wolverine_cover.png', 'Shawn Levy', 'Rhett Reese, Paul Wernick', 'Ryan Reynolds, Hugh Jackman');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Quantumania', 'In this thrilling sequel, Ant-Man and the Wasp dive into the mysterious quantum realm to face a new and powerful foe. As they explore this bizarre universe, they uncover secrets that could change the course of reality, leading to intense battles, unexpected alliances, and a deeper understanding of what it means to be a hero in a world filled with uncertainties.', 'assets/covers/quantumania_cover.png', 'Peyton Reed', 'Jeff Loveness', 'Paul Rudd, Evangeline Lilly');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Garfield: The Movie', 'Follow the adventures of Garfield, the lasagna-loving cat, as he navigates the ups and downs of life with his owner Jon and his canine companion Odie. When Garfield finds himself in a series of hilarious misadventures, he must discover the importance of friendship, loyalty, and the value of stepping outside his comfort zone.', 'assets/covers/garfield_cover.png', 'Peter Hewitt', 'Joel Cohen, Alec Sokolow', 'Bill Murray, Breckin Meyer');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Fistful Scavengers', 'Set against the backdrop of a post-apocalyptic world, a group of unlikely heroes must band together to reclaim their home from ruthless scavengers. Their journey is filled with perilous challenges, unexpected alliances, and moments of courage as they learn that sometimes the greatest treasures lie within the bonds they form and the sacrifices they make for one another.', 'assets/covers/fistful_scavengers_cover.png', 'Michael Dante DiMartino', 'Michael Dante DiMartino, Bryan Konietzko', 'Zach Tyler, Mae Whitman');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Little Mermaid', 'Dive into an enchanting underwater world with Ariel, a spirited mermaid who dreams of life on the surface. When she makes a fateful deal with the sea witch Ursula, Ariel embarks on a magical adventure filled with friendship, love, and self-discovery as she learns the true meaning of sacrifice and what it truly means to be free.', 'assets/covers/little_mermaid_cover.png', 'James Wan', 'David Leslie Johnson-McGoldrick', 'Jason Momoa, Amber Heard');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Dynasty', 'In a high-stakes world of power and ambition, two legendary heroes—Deadpool and Wolverine—face a new enemy that threatens not just their existence but the fate of the entire universe. Amidst epic battles and personal conflicts, they must rely on their unique skills and unbreakable bond to navigate through a conspiracy that shakes the very foundations of their reality.', 'assets/covers/dynasty_cover.png', 'Shawn Levy', 'Rhett Reese, Paul Wernick', 'Ryan Reynolds, Hugh Jackman');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Avatar: The Lost Ark', 'As Aang continues his quest to master the elements, he uncovers an ancient secret that could either save or destroy the world. Joined by his loyal friends, they traverse perilous terrains, encounter mythical creatures, and confront powerful adversaries in a race against time that tests their strength, resolve, and the very essence of what it means to be a hero.', 'assets/covers/avatar_the_lost_ark_cover.png', 'Peyton Reed', 'Jeff Loveness', 'Paul Rudd, Evangeline Lilly');

INSERT INTO movies ( title, description, picture, director, writers, actors) 
VALUES ('Up!', 'Join Carl Fredricksen, a retired balloon salesman, on an adventure of a lifetime as he fulfills a promise to his late wife by attaching thousands of balloons to his house and flying to South America. Along the way, he unexpectedly befriends a young boy scout, Russell, and together they encounter wild landscapes, exotic creatures, and life-changing experiences that teach them about friendship, loss, and embracing the journey.', 'assets/covers/up_cover.png', 'Peter Hewitt', 'Joel Cohen, Alec Sokolow', 'Bill Murray, Breckin Meyer');

-- Upcoming Movies
INSERT INTO movies ( title, description, picture, director, writers, actors, isUpcoming) VALUES ('Fighter', 'In a world where aerial combat is the ultimate test of skill, a talented fighter pilot must overcome personal challenges and fierce competition to prove himself. As he navigates through high-stakes missions and complex relationships, he discovers the true meaning of bravery, loyalty, and the sacrifices that come with following your dreams.', 'assets/covers/fighter_cover.png', 'Unknown', 'Unknown', 'Unknown', TRUE);

INSERT INTO movies ( title, description, picture, director, writers, actors, isUpcoming)  VALUES ('Symphony', 'A gripping musical drama that follows the journey of a talented composer struggling to find his voice amid personal and professional turmoil. As he confronts his fears and insecurities, he learns to harness his creativity and passion, ultimately leading to a powerful performance that showcases the beauty of resilience and self-discovery.', 'assets/covers/symphony_cover.png', 'Unknown', 'Unknown', 'Unknown', TRUE);

INSERT INTO movies ( title, description, picture, director, writers, actors, isUpcoming) VALUES ('Inside Out 2', 'In this heartfelt sequel, the emotions inside young Riley face new challenges as she navigates her teenage years. With humor and depth, the film explores the complexities of growing up, friendship, and the importance of embracing all emotions—both the joyful and the painful—as Riley learns to find her true self.', 'assets/covers/inside_out_2_cover.png', 'Unknown', 'Unknown', 'Unknown', TRUE);

INSERT INTO movies ( title, description, picture, director, writers, actors, isUpcoming) VALUES ('Wonka', 'Delve into the whimsical world of Willy Wonka as his extraordinary journey unfolds, showcasing his early adventures and the magical inventions that made him a legend. Through trials and tribulations, Willy learns about friendship, creativity, and the importance of believing in oneself, ultimately paving the way for his iconic chocolate factory.', 'assets/covers/wonka_cover.png', 'Paul King', 'Simon Farnaby', 'Timothée Chalamet', TRUE);

INSERT INTO movies ( title, description, picture, director, writers, actors, isUpcoming) 
VALUES ('The Creator', 'Set in a dystopian future where artificial intelligence reigns, a skilled engineer must confront his greatest fears as he embarks on a quest to create a new form of consciousness. Blurring the lines between man and machine, he navigates moral dilemmas and unexpected alliances, ultimately challenging the very fabric of what it means to be human.', 'assets/covers/the_creator_cover.png', 'Gareth Edwards', 'Gareth Edwards', 'John David Washington', TRUE);





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