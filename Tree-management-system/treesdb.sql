CREATE DATABASE IF NOT EXISTS treesdb;
USE treesdb;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE feedback (
    fid INT AUTO_INCREMENT PRIMARY KEY,
    uid INT,
    fdescription VARCHAR(300) NOT NULL,
    status INT(1) NOT NULL,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uid) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;
INSERT INTO users (user_id, username, email, password, role) VALUES
(1, 'BrianOkinyi', 'brian@gmail.com', '$2y$10$SnitLTQ9wStdB9WvfvwFcOvSJ87ZydZyydJw7asKk2Hyiym0KFvqq', 'Admin'),
(2, 'User28', 'user28@example.com', 'hashed_password', 'customer'),
(3, 'User33', 'user33@example.com', 'hashed_password', 'customer');

INSERT INTO feedback (uid, fdescription, status) VALUES
(1, 'This is a demo feedback in order to use set it as Testimonial for the site.', 1),
(2, 'This is great. This is just great. Hmmm, just a dummy text for users feedback.', 1);

-- Create the trees table
CREATE TABLE trees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    scientific_name VARCHAR(100),
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT NOT NULL,
    image_url VARCHAR(255),
    category VARCHAR(50),
    growth_rate VARCHAR(20),
    mature_height VARCHAR(20),
    sunlight_requirement VARCHAR(50),
    watering_need VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data into the trees table
INSERT INTO trees (name, scientific_name, description, price, stock_quantity, image_url, category, growth_rate, mature_height, sunlight_requirement, watering_need) VALUES 
('Acacia', 'Acacia tortilis', 'A iconic African tree with a flat-topped canopy, known for its ability to thrive in arid conditions.', 55, 80, 'images/tree9.jpg', 'Deciduous', 'Medium', '15-20 meters', 'Full sun', 'Low'),

('African Olive', 'Olea europaea subsp. cuspidata', 'An evergreen tree with silver-green leaves, producing small edible fruits.', 60, 65, 'images/tree4.jpg', 'Evergreen', 'Slow', '10-15 meters', 'Full sun', 'Low to Medium'),

('Baobab', 'Adansonia digitata', 'The iconic "upside-down tree" known for its massive trunk and long lifespan.', 800, 40, 'images/tree3.jpg', 'Deciduous', 'Slow', '20-30 meters', 'Full sun', 'Low'),

('Meru Oak', 'Vitex keniensis', 'A valuable timber tree native to Kenya, with purple flowers and edible fruits.', 700, 55, 'images/tree1.jpg', 'Deciduous', 'Medium', '25-35 meters', 'Full sun', 'Medium'),

('Nandi Flame', 'Spathodea campanulata', 'A spectacular flowering tree with bright red-orange blooms.', 450, 70, 'images/tree10.jpg', 'Evergreen', 'Fast', '15-25 meters', 'Full sun', 'Medium'),

('African Blackwood', 'Dalbergia melanoxylon', 'A slow-growing tree prized for its dense, dark heartwood used in woodworking.', 300, 30, 'images/tree9.jpg', 'Deciduous', 'Slow', '10-15 meters', 'Full sun', 'Low'),

('Croton', 'Croton megalocarpus', 'A fast-growing tree commonly used for firewood and as a windbreak.', 350, 100, 'images/tree8.jpg', 'Evergreen', 'Fast', '15-20 meters', 'Full sun', 'Medium'),

('Mugumo (Fig Tree)', 'Ficus thonningii', 'A sacred tree in Kikuyu culture, known for its extensive root system and ability to regenerate.', 100, 50, 'images/tree6.jpg', 'Evergreen', 'Fast', '20-30 meters', 'Full sun to partial shade', 'Medium'),

('African Juniper', 'Juniperus procera', 'A coniferous tree native to the mountains of East Africa, valued for its durable timber.', 50, 45, 'images/tree2.jpg', 'Evergreen', 'Slow', '20-50 meters', 'Full sun', 'Low'),

('Umbrella Thorn', 'Vachellia tortilis', 'A tree with a distinctive flat-topped crown, important for wildlife and soil conservation.', 60, 75, 'images/tree3.jpg', 'Deciduous', 'Medium', '4-20 meters', 'Full sun', 'Low'),

('Markhamia', 'Markhamia lutea', 'A popular ornamental tree with yellow bell-shaped flowers, used for timber and medicine.', 40, 85, 'images/tree4.jpg', 'Evergreen', 'Fast', '15-25 meters', 'Full sun to partial shade', 'Medium'),

('African Mahogany', 'Khaya anthotheca', 'A large deciduous tree prized for its valuable timber used in furniture making.', 80, 35, 'images/tree5.jpg', 'Deciduous', 'Medium', '30-40 meters', 'Full sun', 'Medium');
-- Create orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) -- Corrected here
);

-- Create order_items table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    tree_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (tree_id) REFERENCES trees(id)
);

-- Create inquiries table
CREATE TABLE inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('open', 'closed') DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Create feedback table
CREATE TABLE feedbackuser (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    rating INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `about` (`title`, `description`, `image`) VALUES
(
    'Tree Nursery Web System: Nurturing Nature, Empowering Growth',
    'Welcome to our innovative Tree Nursery Management System, where technology meets horticulture to create a greener tomorrow. Our state-of-the-art platform seamlessly integrates every aspect of tree nursery operations, from seed to sale.We are dedicated to providing the best quality trees, seeds, and planting accessories. Our goal is to ensure that every tree we sell thrives and contributes positively to the environment. We deliver tree oders to counties such as: Kisumu, Homabay, Migori, Kisii, Kakamega, Busia, Bungoma and Nyamira.
By leveraging cutting-edge technology, we''re not just growing trees; we''re cultivating a sustainable future. Our Tree Nursery Management System empowers nurseries to operate more efficiently, educate customers effectively, and contribute meaningfully to global reforestation efforts. Join us in revolutionizing the green industry, one tree at a time.',
    'images/tree1.jpg'
);