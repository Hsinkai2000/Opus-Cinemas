CREATE DATABASE opus_cinemas;

use opus_cinemas;

CREATE TABLE users {
  id INT AUTO_INCREMENT PRIMARY KEY,
  email varchar(255),
  password varchar(255),
  booking_ids varchar(255),
}

CREATE TABLE [users] (
  [id] integer PRIMARY KEY,
  [email] nvarchar(255),
  [password] nvarchar(255),
  [booking_ids] nvarchar(255)
)
GO

CREATE TABLE [cinemas] (
  [id] integer PRIMARY KEY,
  [picture] nvarchar(255),
  [name] nvarchar(255),
  [description] nvarchar(255)
)
GO

CREATE TABLE [movies] (
  [id] integer PRIMARY KEY,
  [cinema_id] integer,
  [genre] nvarchar(255),
  [title] nvarchar(255),
  [description] nvarchar(255),
  [picture] nvarchar(255),
  [director] nvarchar(255),
  [writers] nvarchar(255),
  [actors] nvarchar(255)
)
GO

CREATE TABLE [movie_timings] (
  [id] integer PRIMARY KEY,
  [movie_id] integer,
  [cinema_id] integer,
  [timing] nvarchar(255)
)
GO

CREATE TABLE [bookings] (
  [id] integer PRIMARY KEY,
  [movie_timing_id] integer,
  [seats] nvarchar(255),
  [price] nvarchar(255),
  [name] nvarchar(255),
  [email] nvarchar(255)
)
GO

CREATE TABLE [customer_support] (
  [id] integer PRIMARY KEY,
  [name] nvarchar(255),
  [email] nvarchar(255),
  [question] nvarchar(255)
)
GO

ALTER TABLE [bookings] ADD FOREIGN KEY ([id]) REFERENCES [users] ([booking_ids])
GO

ALTER TABLE [cinemas] ADD FOREIGN KEY ([id]) REFERENCES [movie_timings] ([id])
GO

ALTER TABLE [movie_timings] ADD FOREIGN KEY ([id]) REFERENCES [movies] ([id])
GO

ALTER TABLE [bookings] ADD FOREIGN KEY ([movie_timing_id]) REFERENCES [movie_timings] ([id])
GO
