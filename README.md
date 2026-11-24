# Campus Found — Lost & Found Portal

A responsive campus Lost & Found web application built with HTML, CSS, JavaScript, PHP and MySQL.

## Features
- Browse lost/found listings, search by keywords and filter by category/type
- User registration and login (password hashing)
- Report lost or found items with optional image upload
- Item detail pages
- Claim requests for found items
- Personal dashboard and close listing action
- Responsive layout for mobile and desktop

## Setup (XAMPP)
1. Install XAMPP and start **Apache** and **MySQL**.
2. Copy the `campus_lost_found` folder into `C:\xampp\htdocs\`.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Import `database.sql`.
5. If your MySQL settings differ, edit `config.php`.
6. Open `http://localhost/campus_lost_found/`.

## Notes
- PHP uploads are stored in `uploads/`. Ensure this folder can be written by PHP.
- Image upload currently allows JPG, PNG and WEBP; the form says max 5 MB and client-side checks it. For production, add server-side file-size checks, CSRF tokens, rate limits, email verification and claim approval/rejection controls.
- This is a student project starter. Use real campus email restrictions and moderation before deploying publicly.
