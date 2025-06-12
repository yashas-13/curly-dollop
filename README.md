# Team Portal

This is a simple internal messaging and file sharing system built with PHP and Bootstrap. It now ships with a small custom stylesheet that applies a dark "Discord-like" appearance. The system is designed for small teams that need to exchange messages and files on a shared hosting environment.

## Features

- User registration and login
- Message board visible to all users
- File upload and download (up to 1GB per file)
- Uses SQLite for storage (single `data.sqlite` file)
- Dark theme inspired by the Discord interface
- User list so members can see who is online
- Dashboard shows recent messages and uploaded files

## Setup

1. Upload all files to your hosting account.
2. Run `install.php` once to create the database and a default admin account:
   - **Username:** `admin`
   - **Password:** `admin`
3. Log in via `login.php` and start using the portal.
4. Delete `install.php` after installation for security.

Uploaded files are stored in the `uploads/` directory, which is excluded from version control.
