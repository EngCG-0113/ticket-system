
# Ticket System

### Requirement
- PHP Version: v8.1 or Above
- Node Js: v14 or above
- Composer

### Installation
1. After clone to your local, run `composer install`
2. Run `npm install && npm run dev`
3. Check Your **.env** file, make sure the database have been setup.
4. Run `php artisan migrate --seed`


### Postman API
- URL: **POST** `{url}/api/v1/login`
- Data: **Form** with elements
  - email
  - password

**!! Please save the token once you get it, it only show once !!**

- Other Urls:
  - **GET** `{url}/api/v1/tickets`
  - **GET** `{url}/api/v1/tickets/{id}`
  - **PUT** `{url}/api/v1/tickets`
    - **Body** with
      - id
      - status (open / closed)
  - **POST** `{url}/api/v1/tickets/{id}`
    - **Body** with
      - id
      - status (open / closed)
      - status
      - issue_headline
      - issue_description
      - requested_by
      - requested_date


