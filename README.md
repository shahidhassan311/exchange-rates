## This project implements a Currency API

```markdown
## Installation

1. Clone project
   
2. composer install
   - php artisan install
   
3. Run the migration and seeder
   - php artisan migrate --seed

4. Run cron job for storing currency data
   - php artisan exchange:update
   ```
```markdown
## Features

- Implemented repository pattern for better code organization.
- Cron job for currency updates.
- Middleware for checking API token.
- Use of AJAX for API integration with debouncing.
- Retrieve a list of currencies with pagination.
- Fetch detailed information about a specific currency.
- Access historical data associated with a currency.
   ```


```markdown

## API Endpoints

- Get All Currencies: `GET /api/currencies`
- Get Currency by ID: `GET /api/currencies/{id}`
- Get Currency History: `GET /api/currencies/{id}/history`
```

