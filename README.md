## :rocket: SIABSENSI By HiskiaDev

## WHAT IS SIABSENSI?
Siabsensi was made to manage student and teacher absenteeism at SMK Wikrama 1 Jepara

## System Requirement
- PHP Version 7.2 or Above
- Composer
- Git

## Installation
1. Open the terminal, navigate to your directory (htdocs or public_html).
```bash
git clone https://github.com/hiskiadev/siabsensi.git
cd siabsensi
composer install
```

2. Setting the database configuration, open .env file at project root directory
```
DB_DATABASE=**your_db_name**
DB_USERNAME=**your_db_user**
DB_PASSWORD=**password**
```

3. Install Project
```bash
php artisan project:install
```
You will get the administrator credential and url access like example bellow:
```bash
::Administrator Credential::
URL Login: http://localhost/login
Email: admin@siabsensi.com
Password: 12345678

```

### Change Password
- Random Password
```bash
php artisan set:password
```
- Custom Password
```bash
php artisan set:password --password=secret123
```
