## Stripe API

### Extension Requirements
- `ext-sodium`

### Installation Guide
- `composer install`
- `php artisan key:generate`
- `chmod -R 777 storage bootstrap/cache`
- `php artisan migrate:fresh --seed --force`

## Passport JWT Installation
- **Generate Encryption Keys**
  - `php artisan passport:keys --force`
- **Generate Client**
  - `php artisan passport:client --password --name=Client1 --provider=users`
  - you will need the output client id & client secret in the login request.

### Unit Test
- **Testing**
    - `php artisan test`
- **Testing** with coverage report
  - Code coverage driver is needed (Xdebug or PCOV)
  - `php artisan test --coverage`

### Code Quality
- **Static Code Analysis** (PHP Stan + LaraStan) - Testing for potential errors.
    - `./vendor/bin/phpstan analyse`
- **Php Code Sniffer** - Testing for Common Standard for code writing style.
    - Detect Problems `./vendor/bin/phpcs --standard=PSR12 app`
    - Fix Problems `./vendor/bin/phpcbf --standard=PSR12 app`

