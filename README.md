
# EdTech REST API

This project is a simple EdTech REST API.

## Project Setup Steps

### On Windows
1. Clone the repository:
    ```bash
    git clone https://github.com/Ibtesam-k/edtech.git
    cd edtech
    ```
2. Install dependencies:
    ```bash
    composer install
    npm install
    ```
3. Set up the environment file:
    ```bash
    copy .env.example .env
    php artisan key:generate
    ```
4. Generate jwt secret:
    ```bash
    php artisan jwt:secret
    ```

5. Create the SQLite database file:
    ```bash
    cd database
    call>database.sqlite
    cd ..
    ```
6. Run migrations and seed the database:
    ```bash
    php artisan migrate:fresh --seed
    ```

## Project Structure

The project consists of the following models:

- **Users**: Can be a student or teacher defined by the role field (a package like Spatie can give us more flexibility in defining roles and applying authorization).
- **Courses**: Each course is taught by a teacher and can be attended by multiple students, and each student can attend multiple courses.
- **Assignments**: Each assignment belongs to a course.
- **Submissions**: Each submissoin is defined by a user (student) and an assignment.
- **Submission Logs**: Contains the results of logging submission data to external API.

**CRUD operations for all models are implemented except for updating submissions (the student might delete the submission and upload new one).**


## Project  Endpoints

- A Postman collection by the name **edtech.postman_collection.json** containing all endpoints is included in the repository.

- All endpoint expect an Accpet header with value application/json

- The following endpoints can be accessed without authentication:

  - `POST api/auth/login`

  - `POST api/auth/register` 

- You can use the default user created by the seeder to login:
```json
{
    "email": "admin@example.com",
    "password": "password123"
}
```

- You can register as a student using the register endpoint.

- Once you login, you can use the returned token to access the rest of the endpoints by adding it to Bearer token authorization.


- Note: 
  - I chose to go with simplicity for the sake of time, but there are still so many functionalities to add.

  - I didn't get the time to write full tests, but I added a simple example for user. 
  You can run the tests using:

    ```bash
        php artisan test
    ```