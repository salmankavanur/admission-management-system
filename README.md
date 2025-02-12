<div align="center">

# 🎓 Admission Management System
### A Comprehensive Solution for Student Admission, Attendance, and Reporting

[![Live Demo](https://img.shields.io/badge/DEMO-Live%20Website-4285F4?style=for-the-badge&logo=google-chrome&logoColor=white)](https://admission.aicedu.in/)
[![Made with Love](https://img.shields.io/badge/Made%20with-♥-ff0000?style=for-the-badge)](https://admission.aicedu.in/)

**A Laravel-powered platform for managing admissions, attendance, and reports for multiple schools**

[✨ Features](#-features) • 
[🛠️ Tech Stack](#%EF%B8%8F-tech-stack) • 
[🚀 Getting Started](#-getting-started) • 
[📞 Contact](#-connect-with-us)

![Macbook-Air-127 0 0 1](https://github.com/user-attachments/assets/19f0f268-295b-4b47-9bea-436cd4e30c78)
![Macbook-Air-127 0 0 1 (1)](https://github.com/user-attachments/assets/c99ebdfe-e16f-4c1c-a5e6-07b695fcefd5)
![Macbook-Air-127 0 0 1 (2)](https://github.com/user-attachments/assets/505639c1-7beb-456f-bf6d-3ec187bb9cc7)
![Macbook-Air-127 0 0 1 (3)](https://github.com/user-attachments/assets/5bd3dbdb-9078-46e1-bda7-eb6495d76075)
![Macbook-Air-127 0 0 1 (4)](https://github.com/user-attachments/assets/120de1c0-fe97-4f0b-b428-f825d902f77c)
![Macbook-Air-127 0 0 1 (5)](https://github.com/user-attachments/assets/8201a6d1-e6c7-4bbb-8a43-4353ae63bb51)
![Macbook-Air-127 0 0 1 (6)](https://github.com/user-attachments/assets/2326c4e1-4835-4647-9add-ca1f4076b879)
![image](https://github.com/user-attachments/assets/07f2dc42-e51b-4a3e-a574-36633b9664f7)


</div>

## 🌟 About Admission Management System

The **Admission Management System** is a modern web application designed to streamline the process of managing school admissions, attendance tracking, student data, and reports. This platform supports multiple schools, each with its own admin, manager, and department management features. The system offers key features like QR-based attendance, SMS, Email, and WhatsApp notifications, and an easy way to track admission statuses.

## ✨ Features

### 🎯 Core Features
- **📅 Multi-School Support**: Manage multiple schools, each with its own admin and manager.
- **📄 Prospectus Management**: Each school can upload and manage its own prospectus PDF files.
- **🎓 Paid/Free Admission**: Departments can be marked as paid or free when setting up.
- **🧾 QR-Based Attendance**: Track interview attendance by scanning QR codes.
- **🔔 Notification System**: Real-time notifications via SMS, email, and WhatsApp.
- **💳 Payment Gatewat Integration**: Razorpay Payment Gateway Integration. 
- **🏢 Separate Dashboard**: for Applicant, Staff Admin, Manager, Super Admin.
- **📊 Reports**: Generate detailed reports on admissions, attendance, and more.
- **📍 Admission Status**: Check the current status of admissions for students.

### 🛠️ Admin Tools
- **📊 Admin Dashboard**: Centralized dashboard to manage all admissions, attendance, and reports.
- **📝 User Role Management**: Assign roles such as Super Admin, Admin, Manager, and User (Student/Parent).
- **🔍 Search and Filter**: Find records with advanced search and filtering capabilities.

## 🛠️ Tech Stack

<div align="center">

### Backend
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00618A?style=for-the-badge&logo=mysql&logoColor=white)

### Notifications
![Twilio](https://img.shields.io/badge/Twilio-1D9BF0?style=for-the-badge&logo=twilio&logoColor=white)
![WhatsApp](https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white)
![Email](https://img.shields.io/badge/Email-0078D4?style=for-the-badge&logo=microsoft-outlook&logoColor=white)

### Hosting
<img src="https://img.shields.io/badge/Digibayt_Server-4285F4?style=for-the-badge&logo=google-cloud&logoColor=white" alt="Digibayt Cloud Server">

![LiteSpeed Server](https://img.shields.io/badge/LiteSpeed-009639?style=for-the-badge&logo=litespeed&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-FF5733?style=for-the-badge&logo=apache&logoColor=white)



</div>

## 🚀 Getting Started

### Prerequisites
Before you begin, ensure you have the following installed:
- PHP (v8.0 or higher)
- Composer
- MySQL or MariaDB
- Laravel Installer
- Redis (optional)

### Installation

```bash
# Clone the repository
git clone https://github.com/salmankavanur/admission-management-system.git
cd admission-management-system

# Install dependencies
composer install

# Copy .env example file
cp .env.example .env

# Set up your environment variables in the .env file
# Configure database, mail, and Twilio settings

# Generate application key
php artisan key:generate

# Run migrations and seed the database
php artisan migrate --seed

# Set appropriate file permissions
chmod -R 777 storage bootstrap/cache

# Serve the application
php artisan serve
```

### Sample `.env` File
```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:/bCdjqfu4ItZpeSAGDxI6cIh0X00NYElBYL0Bw+nzwQ=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=admission2k25
DB_USERNAME=root
DB_PASSWORD=

# Add this to set utf8mb4 as default charset
DB_CHARSET=utf8
DB_COLLATION=utf8_unicode_ci

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

TWILIO_SID=your_twilio_sid
TWILIO_AUTH_TOKEN=your_twilio_auth_token
TWILIO_NUMBER=your_twilio_number
```

## 🔧 Useful Commands

```bash
# Run migrations and seed data
php artisan migrate --seed

# Fresh migration (drops all tables)
php artisan migrate:fresh --seed

# Create a symbolic link for storage
php artisan storage:link

# Clear cache and compiled views
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan view:clear
php artisan route:clear

# Serve the application
php artisan serve
```

## 📞 Connect with Us

<div align="center">

### Let's Build Something Amazing Together!

[![Website](https://img.shields.io/badge/Website-admission.aicedu.in-000000?style=for-the-badge&logo=vercel&logoColor=white)](https://admission.aicedu.in/)

</div>

## 🏆 Acknowledgments

Special thanks to all contributors, mentors, and everyone who supported this project!

## 🔑 Default Super Admin Login Details
Email: admin@admin.com <br/>
Password: Admin@123#

---
<div align="center">
<sub>Built with ♥️ by the Admission Management System Team | © 2025 All Rights Reserved</sub>

