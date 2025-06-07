# Learning Platform

A simple web-based learning platform built using **PHP** and **CodeIgniter 4**, with basic user authentication, discussion forum, personal notes, and profile management features.

## Notes

This project was developed as part of the **INFS7202 Information Systems Architecture** course assignment at The University of Queensland.  
It is a learning platform prototype built for educational purposes.  
For demonstration purposes only; security and production hardening are not fully implemented.

## Features

- User Authentication

  - Login / Logout
  - Cookie-based session management
  - (Optional) Google OAuth support

- User Dashboard

  - View personal profile
  - Upload profile image

- Discussion Forum

  - View all questions
  - Post new questions
  - Comment on existing questions
  - User-specific favorites / bookmarks

- Personal Notes

  - Create and manage personal learning notes

- Donation Page
  - Static donation information page

## Tech Stack

- Backend: PHP 8.x, CodeIgniter 4
- Frontend: HTML, CSS, basic Bootstrap (if used)
- Database: MySQL (assumed, based on CI usage)
- Others: Composer, Google OAuth (optional)

## Setup Instructions

1. Clone this repository
2. Configure your `.env` file with database settings
3. Run database migrations (if any)
4. Serve the project using built-in PHP server or your preferred web server

```bash
php spark serve
```
