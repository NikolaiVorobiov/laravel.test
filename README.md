## Installation

1. Copy .env.example into .env
2. composer install
3. php artisan key:generate
4. Set the following settings in the .env:
- 'MAIL_HOST=smtp.gmail.com'
- 'MAIL_PORT=587'
- 'MAIL_USERNAME=' // Site google mail
- 'MAIL_PASSWORD=' // Site google mail token
- 'MAIL_ENCRYPTION=tls'
- 'MAIL_FROM_ADDRESS=' // Site google mail

- 'GOOGLE_REDIRECT=http://localhost:8000/auth/google/callback'
- 'GOOGLE_CLIENT_ID=' // Take in the site google account
- 'GOOGLE_CLIENT_SECRET=' // Take in the site google account
- 
- 'APP_API_TOKEN="nxI6HIClQRGkeCPYxMee83lE9uJKCicQTJOlED9FGJ9IRxV67RiJlPDk0YVU"'   

5. Setup the project

- `php artisan migrate`
- `php artisan db:seed`

6. php artisan storage:link
7. php artisan serve
