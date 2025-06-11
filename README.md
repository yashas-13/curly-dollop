# Team Portal

This is a simple internal messaging and file sharing system built with PHP and Bootstrap. It is designed for small teams that need to exchange messages and files on a shared hosting environment.

## Features

- User registration and login
- Message board visible to all users
- File upload and download
- File upload and download (up to 1GB per file)
- Uses SQLite for storage (single `data.sqlite` file)

## Setup

1. Upload all files to your hosting account.
2. Run `install.php` once to create the database and a default admin account:
   - **Username:** `admin`
   - **Password:** `admin`
3. Log in via `login.php` and start using the portal.
4. Delete `install.php` after installation for security.

Uploaded files are stored in the `uploads/` directory, which is excluded from version control.
By default, each upload is limited to **1GB**. Ensure your PHP configuration allows files of this size (`upload_max_filesize` and `post_max_size` directives).
