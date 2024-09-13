
# Task Management System (API-based)

This project is a simple **Task Management System** built entirely on a RESTful API architecture using Laravel. Users can manage tasks and folders via API calls, enabling flexibility for front-end implementation.

## Features

- **User Registration**: Users can register for an account.
- **User Login and Authentication**: Users can log in and authenticate their requests.
- **Create Folders**: Users can create folders to organize tasks.
- **Create Tasks**: Users can create tasks and assign them to a folder.
- **Task Status Management**: Users can update task statuses to:
  - ToDo
  - Doing
  - Done
  - Missed
- **Edit and Delete Folders/Tasks**: Users can update or delete their folders and tasks.
- **Retrieve Folder and Task Lists**: Users can fetch:
  - Folder and task lists in JSON Collection format.
  - Specific folder or task details in JSON Resource format.
- **Filter Tasks by Status**: Users can retrieve tasks based on their status.
- **Manage Account**: Users can:
  - Edit their account information.
  - Delete their account.

## Project Highlights

- **Resources & Collections**: API responses utilize Laravel’s Resource and Collection classes to format JSON output.
- **Authentication**: Authentication is handled using **Laravel Breeze** and **Sanctum** for token-based authentication.
- **Authorization**: Controllers and methods implement authorization using Laravel Gates or Policies to restrict access.
- **CSRF Protection**: CSRF token handling is integrated throughout the project.
- **Data Validation**: All data validation is managed using Laravel's **Form Request** classes to ensure input integrity.
- **Unit Testing**: PHP Unit tests are written to cover essential functionalities.
- **Latest Laravel Version**: The project is built using the latest version of **Laravel (v11)**.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/devpiderman/to-do.git
   ```
2. Navigate into the project directory:
   ```bash
   cd to-do
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Set up environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Set up your database credentials in the `.env` file, then run the migrations:
   ```bash
   php artisan migrate
   ```
6. Run the server:
   ```bash
   php artisan serve
   ```

## API Documentation

For API testing, use **Postman** or a similar tool. The available endpoints include registration, login, CRUD operations for folders and tasks, task status updates, and more.
