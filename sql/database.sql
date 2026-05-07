-- Database: education_db
CREATE DATABASE IF NOT EXISTS education_db;
USE education_db;

-- Table: users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    role ENUM('student', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default Admin (password: admin123)
INSERT INTO users (name, email, password, phone, role) VALUES 
('Admin', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9999999999', 'admin');

-- Table: categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: courses
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    original_price DECIMAL(10,2),
    image VARCHAR(255),
    duration VARCHAR(50),
    category_id INT,
    level ENUM('beginner', 'intermediate', 'expert') DEFAULT 'beginner',
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Table: enrollments
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    status ENUM('active', 'completed', 'cancelled') DEFAULT 'active',
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Table: chat_messages (AI Chat History)
CREATE TABLE chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT NOT NULL,
    response TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Insert Categories
INSERT INTO categories (name) VALUES 
('Web Development'),
('Data Science'),
('Artificial Intelligence'),
('Mobile Development'),
('Cloud Computing'),
('Digital Marketing');

-- Insert Sample Courses
INSERT INTO courses (title, description, price, original_price, image, duration, category_id, level, featured) VALUES
('Full Stack Web Development', 'Complete HTML, CSS, JavaScript, React, Node.js, MongoDB', 999, 4999, 'webdev.jpg', '6 Months', 1, 'beginner', 1),
('Data Science Pro', 'Python, Pandas, NumPy, Machine Learning, Tableau, SQL', 1499, 6999, 'datascience.jpg', '5 Months', 2, 'intermediate', 1),
('AI & Machine Learning', 'Deep Learning, NLP, Computer Vision, TensorFlow', 1999, 9999, 'aiml.jpg', '4 Months', 3, 'expert', 1),
('React Native', 'Cross Platform Mobile App Development', 799, 3999, 'reactnative.jpg', '3 Months', 4, 'beginner', 0),
('AWS Cloud Practitioner', 'Cloud Computing Fundamentals, AWS Services', 1299, 5999, 'aws.jpg', '2 Months', 5, 'beginner', 0),
('Digital Marketing Mastery', 'SEO, SEM, Social Media, Email Marketing', 899, 4499, 'digital.jpg', '3 Months', 6, 'beginner', 0);