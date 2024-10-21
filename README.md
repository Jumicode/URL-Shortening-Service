
# URL Shortener API

This is a RESTful API built with Laravel for shortening URLs. It allows users to create, retrieve, update, delete, and track statistics of shortened URLs.

## Features

- **Shorten URLs**: Create a short version of a long URL.
- **Retrieve Original URL**: Get the original long URL using the short code.
- **Update Shortened URL**: Modify the long URL for an existing short code.
- **Delete Shortened URL**: Remove a shortened URL from the system.
- **Statistics**: Track the number of times a shortened URL has been accessed.

## Requirements

- PHP 8.1 or higher
- Composer
- Laravel 10
- MySQL or any other supported database

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/url-shortener-api.git
   ```

2. Navigate into the project directory:

   ```bash
   cd url-shortener-api
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Create a copy of the `.env` file:

   ```bash
   cp .env.example .env
   ```

5. Set up your environment variables in the `.env` file (e.g., database settings).

6. Generate an application key:

   ```bash
   php artisan key:generate
   ```

7. Run the database migrations:

   ```bash
   php artisan migrate
   ```

8. Start the local development server:

   ```bash
   php artisan serve
   ```

The API should now be accessible at `http://localhost:8000`.

## API Endpoints

### 1. Shorten a URL

- **URL**: `/api/shorten`
- **Method**: `POST`
- **Request Body**:

  ```json
  {
    "url": "https://www.example.com/some/long/url"
  }
  ```

- **Response** (`201 Created`):

  ```json
  {
    "id": "1",
    "url": "https://www.example.com/some/long/url",
    "shortCode": "abc123",
    "createdAt": "2021-09-01T12:00:00Z",
    "updatedAt": "2021-09-01T12:00:00Z"
  }
  ```

### 2. Retrieve Original URL

- **URL**: `/api/shorten/{shortCode}`
- **Method**: `GET`
- **Response** (`200 OK`):

  Redirects to the original URL.

### 3. Update a Shortened URL

- **URL**: `/api/shorten/{shortCode}`
- **Method**: `PUT`
- **Request Body**:

  ```json
  {
    "url": "https://www.example.com/some/updated/url"
  }
  ```

- **Response** (`200 OK`):

  ```json
  {
    "id": "1",
    "url": "https://www.example.com/some/updated/url",
    "shortCode": "abc123",
    "createdAt": "2021-09-01T12:00:00Z",
    "updatedAt": "2021-09-01T12:30:00Z"
  }
  ```

### 4. Delete a Shortened URL

- **URL**: `/api/shorten/{shortCode}`
- **Method**: `DELETE`
- **Response** (`204 No Content`):  
  No response body.

### 5. Get URL Statistics

- **URL**: `/api/shorten/{shortCode}/stats`
- **Method**: `GET`
- **Response** (`200 OK`):

  ```json
  {
    "id": "1",
    "url": "https://www.example.com/some/long/url",
    "shortCode": "abc123",
    "createdAt": "2021-09-01T12:00:00Z",
    "updatedAt": "2021-09-01T12:00:00Z",
    "accessCount": 10
  }
  ```

## Running Tests

To run the tests for this project:

```bash
php artisan test
```

## License

This project is open-source and available under the [MIT License](LICENSE).
```
https://roadmap.sh/projects/url-shortening-service
### Key Sections Included:
1. **Introduction**: Overview of the project.
2. **Features**: A quick list of what the API does.
3. **Requirements**: Necessary software for the project.
4. **Installation**: Steps to set up the project on your local machine.
5. **API Endpoints**: Detailed instructions on how to use the API.
6. **Running Tests**: How to execute unit tests.
7. **License**: Mention of the open-source license.

Make sure to replace `your-username` with your actual GitHub username in the clone URL.
