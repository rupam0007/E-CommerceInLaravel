# Admin User Setup Guide

## How to Create Admin Users

Since admin registration has been removed for security, admins must be added directly to the database.

### Method 1: Using the Seeder (Recommended)

1. Open `database/seeders/AdminUserSeeder.php`

2. Modify the admin credentials:
   ```php
   $email = 'admin@nexora.com';      // Change to desired email
   $name = 'Admin User';             // Change to desired name
   $password = 'Admin@123456';       // Change to desired password
   ```

3. Run the seeder:
   ```bash
   php artisan db:seed --class=AdminUserSeeder
   ```

### Method 2: Using Tinker (For Quick Creation)

```bash
php artisan tinker
```

Then run:
```php
App\Models\Admin::create([
    'name' => 'Your Name',
    'email' => 'your-email@example.com',
    'password' => bcrypt('YourPassword123')
]);
```

### Method 3: Direct Database Insert

Insert into the `admins` table:
```sql
INSERT INTO admins (name, email, password, created_at, updated_at)
VALUES (
    'Admin Name',
    'admin@example.com',
    '$2y$12$your-hashed-password-here',
    NOW(),
    NOW()
);
```

Note: Use bcrypt to hash passwords. You can generate a hash using:
```bash
php -r "echo password_hash('YourPassword', PASSWORD_BCRYPT);"
```

## Default Admin Credentials

After running migrations and seeders:
- **Email:** admin@nexora.com
- **Password:** Admin@123456

⚠️ **Important:** Change the default password immediately after first login!

## Admin Login URL

Access the admin panel at: `/admin/login`
