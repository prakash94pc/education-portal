🎓 Shikhar Shiksha - Learning Management System

> A production-ready, cloud-native Learning Management System (LMS) deployed on AWS with CI/CD automation.

[![AWS](https://img.shields.io/badge/AWS-EC2%20%7C%20RDS%20%7C%20VPC-orange)](https://aws.amazon.com/)
[![PHP](https://img.shields.io/badge/PHP-8.5-blue)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)](https://mysql.com/)
[![CI/CD](https://img.shields.io/badge/CI/CD-GitHub%20Actions-green)](https://github.com/features/actions)

---

🌐 Live Demo

| Portal | URL | Credentials |
|--------|-----|-------------|
| **Student Portal** | http://13.201.12.22 | Register as new user |
| **Admin Panel** | http://13.201.12.22/admin/login.php | `admin@admin.com` / `admin123` |

---

📋 Project Overview

This is a **complete Learning Management System** built from scratch and deployed on **AWS Cloud Infrastructure**. The platform allows students to browse courses, enroll, and learn - while admins can manage everything from a dashboard.

Key Metrics
- ⚡ **Zero-downtime deployments** using GitHub Actions
- 🔒 **100% SSL encrypted** data in transit
- 🏗️ **High availability** architecture across 2 AZs
- 💰 **Cost-optimized** running on AWS free tier

---

🏗️ AWS Architecture

┌─────────────────┐
│ 🌐 Internet │
└────────┬────────┘
│
┌────────▼────────┐
│ Security Group │
│ (Port 80, 443) │
└────────┬────────┘
│
┌──────────────────┼──────────────────┐
│ │ │
┌───────▼───────┐ ┌───────▼───────┐ ┌───────▼───────┐
│ Public Subnet │ │ Public Subnet │ │ Public Subnet │
│ (AZ 1) │ │ (AZ 2) │ │ (NAT GW) │
└───────┬───────┘ └───────┬───────┘ └───────┬───────┘
│ │ │
┌───────▼───────┐ ┌───────▼───────┐ │
│ Private Subnet│ │ Private Subnet│ │
│ (AZ 1) │ │ (AZ 2) │ │
│ ┌─────────┐ │ │ ┌─────────┐ │ │
│ │ EC2 │ │ │ │ EC2 │ │ │
│ │ Apache │ │ │ │ Apache │ │ │
│ │ PHP │ │ │ │ PHP │ │ │
│ └────┬────┘ │ │ └────┬────┘ │ │
└───────┼───────┘ └───────┼───────┘ │
│ │ │
└──────────────────┼──────────────────┘
│
┌────────▼────────┐
│ AWS RDS │
│ (MySQL 8.0) │
│ Private Subnet │
└─────────────────┘

text

### AWS Services Used

| Service | Purpose | Configuration |
|---------|---------|---------------|
| **VPC** | Isolated network | 4 subnets (2 public + 2 private) across 2 AZs |
| **EC2** | Application hosting | t3.micro, Ubuntu 26.04, Apache + PHP 8.5 |
| **RDS** | Managed database | MySQL 8.0, db.t3.micro, Multi-AZ ready |
| **NAT Gateway** | Internet for private subnets | 1 per public subnet |
| **Security Groups** | Firewall rules | Port 22 (SSH), 80 (HTTP), 3306 (MySQL) |
| **IAM** | Access management | Least privilege policies |
| **GitHub Actions** | CI/CD | Auto-deploy on git push |

---

🛠️ Technology Stack

### Frontend
- HTML5, CSS3, JavaScript
- Font Awesome Icons
- Responsive Design (Mobile-first)

### Backend
- PHP 8.5
- MySQL 8.0
- Apache 2.4

### Security
- Password Hashing (bcrypt)
- SQL Injection Prevention (Prepared Statements)
- SSL/TLS for RDS connections
- Session Management

---

📊 Database Schema

```sql
-- Core Tables
users (id, name, email, password, phone, role, created_at)
courses (id, title, description, price, original_price, image, duration, level, featured)
enrollments (id, student_id, course_id, status, enrolled_at)
chat_messages (id, user_id, message, response, created_at)
Relationships
enrollments.student_id → users.id (CASCADE)

enrollments.course_id → courses.id (CASCADE)

🚀 Features
👨‍🎓 Student Features
Feature	Description
User Registration	Sign up with name, email, phone
Secure Login	Password hashed with bcrypt
Browse Courses	View all courses with search
Course Enrollment	Enroll with one click
My Dashboard	See enrolled courses
AI Chat Support	24/7 intelligent assistant
Responsive UI	Works on mobile, tablet, desktop
👑 Admin Features
Feature	Description
Admin Dashboard	See total students, courses, enrollments
Manage Students	View, delete students
Manage Courses	Add, edit, delete courses
View Enrollments	Track all enrollments
Analytics	Real-time platform stats
🤖 AI Chatbot Intelligence
The chatbot can answer questions about:

📚 Courses offered

💰 Pricing and discounts

📅 Duration of courses

🎓 Certificate information

💳 Payment methods

📞 Support contact

📁 Project Structure
text
education-portal/
│
├── admin/                   # Admin Panel
│   ├── login.php           # Admin login
│   ├── dashboard.php       # Admin dashboard
│   ├── manage-students.php # Student management
│   ├── manage-courses.php  # Course management
│   └── logout.php          # Logout handler
│
├── api/                    # API Endpoints
│   └── chat-response.php   # AI chatbot API
│
├── config/                 # Configuration
│   └── database.php        # Database connection
│
├── css/                    # Stylesheets
│   └── style.css           # Main styles
│
├── js/                     # JavaScript
│   └── script.js           # Client-side logic
│
├── includes/               # Reusable components
│   ├── header.php          # Navbar
│   └── footer.php          # Footer + Chatbot
│
├── sql/                    # Database
│   └── database.sql        # Schema
│
├── .github/workflows/      # CI/CD
│   └── deploy.yml          # GitHub Actions
│
├── index.php               # Home page
├── login.php               # Student login
├── signup.php              # Student registration
├── courses.php             # Browse all courses
├── course-detail.php       # Course details
├── dashboard.php           # Student dashboard
├── my-courses.php          # Enrolled courses
├── enroll.php              # Enrollment handler
└── logout.php              # Student logout
🔧 Local Development Setup
Prerequisites
PHP 7.4+

MySQL 5.7+

Apache/Nginx

Git

Installation Steps
bash
# 1. Clone repository
git clone https://github.com/prakash94pc/education-portal.git
cd education-portal

# 2. Configure database
mysql -u root -p < sql/database.sql

# 3. Update database config
nano config/database.php
# Update: host, username, password

# 4. Run locally
php -S localhost:8000

# 5. Open browser
http://localhost:8000
🚀 AWS Deployment Guide
Prerequisites
AWS Account (Free Tier eligible)

GitHub Account

Step 1: Create VPC & Subnets
bash
# Create VPC with CIDR 10.0.0.0/16
# Create 2 Public Subnets (10.0.1.0/24, 10.0.2.0/24)
# Create 2 Private Subnets (10.0.3.0/24, 10.0.4.0/24)
# Create Internet Gateway & NAT Gateways
Step 2: Launch EC2 Instance
bash
# AMI: Ubuntu 26.04
# Type: t3.micro
# Subnet: Private subnet
# Security Group: SSH (22), HTTP (80)
# User data (install LAMP):
sudo apt update && sudo apt install -y apache2 php libapache2-mod-php php-mysql
Step 3: Create RDS Database
bash
# Engine: MySQL 8.0
# Template: Free tier
# Subnet: Private subnet
# Security Group: MySQL (3306) from EC2 SG only
Step 4: Setup GitHub Actions
yaml
# Add Secrets in GitHub:
EC2_HOST: your-ec2-ip
EC2_USER: ubuntu
EC2_SSH_PRIVATE_KEY: your-private-key
Step 5: Deploy
bash
git push origin main
# GitHub Actions will auto-deploy!

🤝 Connect with Me
Prakash - Cloud & DevOps Enthusiast

https://img.shields.io/badge/GitHub-prakash94pc-black
https://img.shields.io/badge/LinkedIn-Prakash-blue

Project Link: https://github.com/prakash94pc/education-portal

Live Demo: http://13.201.12.22

📄 License
MIT License - Free for educational and commercial use.

⭐ Show Your Support
If this project helped you, please star this repository! ⭐

Built with ❤️ using AWS Cloud & PHP
