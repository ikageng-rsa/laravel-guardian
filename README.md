# Laravel Guardian
Laravel Guardian is a comprehensive security package designed for Laravel applications. This package provides functionalities to enhance the security of user accounts, starting with email notifications for password changes. Future versions will include additional features such as login activity logging, pattern detection, two-factor authentication, and account lockout capabilities.

## Installation

You can install the package via composer:
  ```
    composer require qanna/laravel-guardian
  ```
After installing the package, you need to publish the configuration file:

  ```
    php artisan vendor:publish --tag=guardian-config
  ```

## Configuration

After publishing the configuration file, you will find it in config/guardian.php. You can configure parameters as needed.

## Usage

### Password Change Notification

Laravel Guardian sends an email notification to users when their password is changed. To use this feature, you only need to add the HasGuardian trait to your User model.

#### Adding the Trait
Add the **HasGuardian** trait to your User model:
  ```php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Qanna\Guardian\Traits\HasGuardian;
    
    class User extends Authenticatable
    {
        use HasGuardian;
    
        // Your model code here
    }

  ```
With this trait added, Laravel Guardian will automatically handle sending the email notification when a user's password is changed.

## Features
- Password Change Notification
  - Guardian sends an email notification to users whenever their password is changed. This feature helps users to be immediately aware of any changes made to their password, enhancing account security.

### Todo
  - [ ] **Login Activity Logging** - Guardian will log all user login activities, including timestamps and IP addresses.
  - [ ] **Login Pattern Detection** - Using the logged activities, Guardian will analyze login patterns to detect anomalies. If an unusual pattern is detected, the user will be notified, and additional security measures may be triggered.
  - [ ] **Two-Factor Authentication (2FA)** - Guardian will integrate 2FA capabilities, providing an extra layer of security. Users will be able to set up 2FA using some popular methods.
  - [ ] **Account Lockout** - To prevent brute force attacks, Guardian will implement an account lockout feature. After a configurable number of failed login attempts, the user's account will be temporarily locked, and they will be notified.


## License

Laravel Guardian is open-source software licensed under the MIT license.


