# Travel Destinations CMS (Course Assignment)

## Overview
This is a PHP + MySQL CMS for managing travel destinations. It includes:
- Admin panel (login, dashboard)
- CRUD for destinations
- Photo uploads with foreign keys
- YouTube video support for destinations
- Frontend that reads from the CMS

## Setup (local XAMPP)
1. Copy the folder into your XAMPP `htdocs` directory, e.g. `C:\xampp\htdocs\travel_cms`.
2. Open phpMyAdmin and import `database.sql` or run the SQL using the SQL tab.
3. Ensure `uploads/destinations` and `uploads/photos` are writable by PHP.
4. Update database credentials in `db_connect.php` if needed.
5. Start Apache + MySQL in XAMPP.
6. Visit:
   - Frontend: `http://localhost/travel_cms/frontend/`
   - Admin: `http://localhost/travel_cms/admin/login.php`

## Admin Credentials (sample)
- Username: `team`
- Password: `Team@123`

## Notes
- This is a demo implementation. For production: add CSRF protection, improved file sanitization, role-based authorization, and limit access to admin assets.
