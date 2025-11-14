# Fix for strtolower() Deprecation Warning on DigitalOcean

## Problem
The error `strtolower(): Passing null to parameter #1 ($string) of type string is deprecated` occurs because the vendor's `CodeIgniter\Validation\FormatRules::valid_ip()` method passes a null value to `strtolower()` in PHP 8.1+.

## Solution
An override class has been created at `app/Validation/Override/FormatRules.php` that fixes this issue. The override replaces the vendor version of the class.

## Configuration
The override is configured in `composer.json`:
```json
"CodeIgniter\\Validation\\": "app/Validation/Override"
```

This ensures that when CodeIgniter tries to load `CodeIgniter\Validation\FormatRules`, it loads our override instead of the vendor version.

## Steps to Fix on DigitalOcean

1. **Ensure the override file exists**: The file `app/Validation/Override/FormatRules.php` must be present in your deployment.

2. **Regenerate Composer autoloader**: After deployment, run:
   ```bash
   composer dump-autoload -o
   ```
   This regenerates the autoloader files and ensures the override is properly loaded.

3. **Verify the override is working**: Check that the autoloader includes the override by looking in `vendor/composer/autoload_psr4.php` - it should show:
   ```php
   'CodeIgniter\\Validation\\' => array($baseDir . '/app/Validation/Override'),
   ```

## Note
The override file already contains the fix for the `valid_ip()` method:
- It checks if `$which` is null before calling `strtolower()`
- It defaults to 'ipv4' if `$which` is null or empty
- It casts the value to string before passing to `strtolower()`

This fix is compatible with PHP 8.1+ and resolves the deprecation warning.

