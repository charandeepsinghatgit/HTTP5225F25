DROP DATABASE IF EXISTS travel_cms;
CREATE DATABASE travel_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE travel_cms;

-- Admin users
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  full_name VARCHAR(150),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Destinations table
CREATE TABLE destinations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  country VARCHAR(150) NOT NULL,
  description TEXT,
  rating DECIMAL(3,1) DEFAULT 0.0,
  date_added DATE DEFAULT (CURRENT_DATE),
  image VARCHAR(255),
  youtube_id VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Photos table (foreign key)
CREATE TABLE destination_photos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  destination_id INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  caption VARCHAR(255),
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Sample admin (password: Team@123) - hashed using PHP password_hash
INSERT INTO admins (username, password_hash, full_name) VALUES
('team', '$2y$10$U9q/fpQHNcB2g/.kQ1vZkO1tZ3R1dYkHkqk3UQqZQd0mT9dY2rA6', 'Team CMS Admin');

-- Sample destinations
INSERT INTO destinations (name, country, description, rating, date_added, image, youtube_id)
VALUES
('Tokyo', 'Japan', 'A bustling city with neon lights, temples and incredible food.', 9.2, '2024-01-10', 'tokyo.jpg', 'dQw4w9WgXcQ'),
('Paris', 'France', 'City of Lights — museums, cafés and romance.', 8.7, '2024-02-05', 'paris.jpg', ''),
('Toronto', 'Canada', 'Multicultural city, waterfront, and great food scenes.', 8.0, '2024-03-12', 'toronto.jpg', '');

-- Sample photos (placeholders)
INSERT INTO destination_photos (destination_id, image, caption)
VALUES
(1, 'tokyo-street.jpg', 'Shibuya at night'),
(1, 'tokyo-temple.jpg', 'Historic temple'),
(2, 'paris-eiffel.jpg', 'Eiffel Tower at sunset'),
(3, 'toronto-skyline.jpg', 'Toronto skyline from the island');
