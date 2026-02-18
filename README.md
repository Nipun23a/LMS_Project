# LMS Project — Learning Management System

A full-featured, web-based Learning Management System (LMS) built with PHP and MySQL. It supports multiple user roles including Students, Teachers, Academic Officers, and Admins, providing a centralized platform for academic content delivery, assessment, and administration.

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Project Structure](#project-structure)
- [User Roles](#user-roles)
- [Screenshots](#screenshots)

---

## Features

- **Multi-role authentication** — Separate portals for Students, Teachers, Academic Officers, and Admins
- **User management** — Registration, email verification, profile management, and password reset
- **Course materials** — Upload and download notes and assignments by grade/subject
- **Grading system** — Mark submission, release, and results viewing
- **Payment portal** — Student subscription and fee payment processing
- **Admin dashboard** — System-wide statistics and user management
- **Email notifications** — Verification codes and password resets via PHPMailer/SMTP
- **Responsive UI** — Mobile-first Bootstrap 5 interface

---

## Tech Stack

| Layer     | Technology                            |
|-----------|---------------------------------------|
| Backend   | PHP 8.1 (procedural + OOP)            |
| Database  | MySQL / MariaDB 10.4                  |
| DB Driver | MySQLi                                |
| Frontend  | HTML5, CSS3, Bootstrap 5              |
| JS        | Vanilla JS + Bootstrap Bundle         |
| Icons     | Bootstrap Icons 1.9.1 (CDN)           |
| Email     | PHPMailer (SMTP)                      |
| Dev Tool  | MySQL Workbench (ER diagrams)         |

---

## Prerequisites

- PHP >= 8.1
- MySQL / MariaDB >= 10.4
- Apache or Nginx web server (with `mod_rewrite` enabled for Apache)
- SMTP credentials for email functionality (PHPMailer)

---

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd LMS_Project
   ```

2. **Move files to your web server root**
   ```bash
   # Apache example
   cp -r . /var/www/html/LMS_Project
   ```

3. **Configure the database connection**

   Edit `modules/db/connection.php` and update the credentials:
   ```php
   $host     = "localhost";
   $user     = "your_db_user";
   $password = "your_db_password";
   $database = "lms";
   $port     = 3306;
   ```

4. **Configure email (PHPMailer)**

   Update the SMTP settings in the relevant mail processing files under `modules/` to match your mail provider credentials.

5. **Set directory permissions** (Linux)
   ```bash
   chmod -R 755 /var/www/html/LMS_Project
   chmod -R 777 shared/notes shared/assignments
   ```

---

## Database Setup

1. Create the database:
   ```sql
   CREATE DATABASE lms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Import the provided SQL dump:
   ```bash
   mysql -u root -p lms < "Database/Database Data Backup/lms.sql"
   ```

3. The ER diagram is available in multiple formats under `Database/ER Diagram/`:
   - `ER.png` — Quick visual reference
   - `ER.pdf` — Printable diagram
   - `ER.svg` — Scalable vector format
   - `lms.mwb` — MySQL Workbench model file

---

## Project Structure

```
LMS_Project/
│
├── index.php                   # Login page (all roles)
├── home.php                    # Dashboard / home after login
├── header.php                  # Shared header component
├── navbar.php                  # Responsive navigation bar
├── register.php                # User registration page
├── profile.php                 # User profile management
├── notes.php                   # Notes listing & download
├── addNotes.php                # Note upload (Teacher/Academic Officer)
├── assignments.php             # Assignments listing & submission
├── addAssignments.php          # Assignment upload (Teacher/Academic Officer)
├── marks.php                   # Marks entry & display
├── results.php                 # Student results view
├── adminPanel.php              # Admin dashboard with statistics
├── manageStudents.php          # Admin: manage student accounts
├── manageTeachers.php          # Admin: manage teacher accounts
├── manageAcademics.php         # Admin: manage academic officers
├── payPortalFee.php            # Student fee payment portal
│
├── modules/                    # Backend processing logic
│   ├── db/
│   │   └── connection.php      # MySQLi database connection
│   │
│   ├── mail/                   # PHPMailer library
│   │   ├── PHPMailer.php
│   │   ├── SMTP.php
│   │   ├── OAuth.php
│   │   ├── POP3.php
│   │   └── Exception.php
│   │
│   ├── signInProcess.php       # Login authentication
│   ├── signOutProcess.php      # Logout / session destroy
│   ├── registerProcess.php     # Registration handler
│   ├── adLogInProcess.php      # Admin login handler
│   ├── changePass.php          # Password change
│   ├── forgotPasswordProcess.php     # Forgot password flow
│   ├── resetPasswordProcess.php      # Password reset
│   ├── verifyUserProcess.php         # Email verification
│   ├── sendVerificationProcess.php   # Send verification email
│   ├── requestCodeProcess.php        # Request new verification code
│   ├── updateProfile.php             # Generic profile update
│   ├── updateProfileST.php           # Student profile update
│   ├── updateStProcess.php           # Student data processing
│   ├── updateTecProcess.php          # Teacher data processing
│   ├── addNotesProcess.php           # Note upload handler
│   ├── addAssignmentsProcess.php     # Assignment upload handler
│   ├── uploadAssignmentsProcess.php  # Assignment file handler
│   ├── loadSubject.php               # Load subjects (general)
│   ├── loadSubjectSt.php             # Load subjects (student)
│   ├── submitMarksProcess.php        # Marks submission handler
│   ├── releaseMarksProcess.php       # Marks release handler
│   ├── search_result_process.php     # Result search & filter
│   ├── payNowProcess.php             # Payment initiation
│   └── payCompleteProcess.php        # Payment completion
│
├── src/                        # Frontend static assets
│   ├── css/
│   │   ├── style.css           # Custom application styles
│   │   └── bootstrap.css       # Bootstrap 5 CSS (local copy)
│   └── js/
│       ├── script.js           # Custom JavaScript
│       ├── bootstrap.js        # Bootstrap 5 JS
│       └── bootstrap.bundle.js # Bootstrap 5 bundle (with Popper)
│
├── assets/                     # Media and static resources
│   ├── logo/                   # Application logos (PNG, PSD)
│   ├── slider/                 # Homepage image slider assets
│   ├── previews/               # Sample file previews (docx, pdf, pptx)
│   └── profile_pic/
│       └── avatar.svg          # Default user avatar
│
├── shared/                     # User-uploaded course content
│   ├── notes/                  # Uploaded notes (organized by grade/subject)
│   └── assignments/
│       ├── [assignment files]  # Uploaded assignments
│       └── answers/            # Student assignment submissions
│
└── Database/                   # Database resources & documentation
    ├── Database Data Backup/
    │   └── lms.sql             # Full MySQL dump
    ├── ER Diagram/
    │   ├── lms.mwb             # MySQL Workbench model
    │   ├── ER.svg
    │   ├── ER.png
    │   └── ER.pdf
    └── Technical Report(LMS Project).docx
```

---

## User Roles

| Role              | Capabilities                                                                 |
|-------------------|------------------------------------------------------------------------------|
| **Student**       | View notes, submit assignments, view marks/results, manage profile, pay fees |
| **Teacher**       | Upload notes & assignments, submit marks, view student results               |
| **Academic Officer** | Manage course content, oversee academic records, release marks            |
| **Admin**         | Full system access — manage all users, view dashboard statistics             |

---

## Screenshots

ER diagram and application previews are available in the `Database/ER Diagram/` directory.

---

## License

This project is for academic and educational use. See the technical report in `Database/Technical Report(LMS Project).docx` for further details.
