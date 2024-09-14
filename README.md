
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

## Authentication
These endpoints handle user authentication, registration, and session management.

### 1. Register
- **Method**: `POST`
- **URL**: `/register`
- **Description**: Register a new user.
- **Request Body**:
  ```json
  {
    "name": "string, required",
    "email": "string, required, unique",
    "password": "string, required, confirmed"
  }
  ```
- **Response**:
  ```json
  {
    "token": "your-token"
  }
  ```
- **Auth Required**: No

### 2. Login
- **Method**: `POST`
- **URL**: `/login`
- **Description**: Login a user and generate a token.
- **Request Body**:
  ```json
  {
    "email": "string, required",
    "password": "string, required"
  }
  ```
- **Response**:
  ```json
  {
    "token": "your-token"
  }
  ```
- **Auth Required**: No

### 3. Logout
- **Method**: `POST`
- **URL**: `/logout`
- **Description**: Logout the authenticated user.
- **Auth Required**: Yes (Bearer token)

---

## Folders
These endpoints handle the management of folders.

### 1. Get All Folders
- **Method**: `GET`
- **URL**: `/folders`
- **Description**: Retrieve all folders of the authenticated user.
- **Auth Required**: Yes (Bearer token)

### 2. Create a Folder
- **Method**: `POST`
- **URL**: `/folders`
- **Description**: Create a new folder.
- **Request Body**:
  ```json
  {
    "title": "string, required"
  }
  ```
- **Response**:
  ```json
  {
    "message": "Folder Created Successfully"
  }
  ```
- **Auth Required**: Yes (Bearer token)

### 3. Get a Specific Folder
- **Method**: `GET`
- **URL**: `/folders/{folder}`
- **Description**: Retrieve a specific folder by ID.
- **Auth Required**: Yes (Bearer token)

### 4. Update a Folder
- **Method**: `PUT`
- **URL**: `/folders/{folder}`
- **Description**: Update the folder’s details.
- **Request Body**:
  ```json
  {
    "title": "string, required"
  }
  ```
- **Response**:
  ```json
  {
    "message": "Folder Updated Successfully"
  }
  ```
- **Auth Required**: Yes (Bearer token)

### 5. Delete a Folder
- **Method**: `DELETE`
- **URL**: `/folders/{folder}`
- **Description**: Delete a folder by ID.
- **Response**:
  ```json
  {
    "message": "Folder Deleted Successfully"
  }
  ```
- **Auth Required**: Yes (Bearer token)

---

## Tasks
These endpoints handle task creation and management.

### 1. Get All Tasks
- **Method**: `GET`
- **URL**: `/tasks`
- **Description**: Retrieve all tasks of the authenticated user.
- **Auth Required**: Yes (Bearer token)

### 2. Create a Task
- **Method**: `POST`
- **URL**: `/tasks`
- **Description**: Create a new task.
- **Request Body**:
  ```json
  {
    "title": "string, required",
    "description": "string, optional",
    "status": "enum:todo,doing,done,missed, required",
    "folder_id": "integer, required"
  }
  ```
- **Response**:
  ```json
  {
    "message": "Task Created Successfully"
  }
  ```
- **Auth Required**: Yes (Bearer token)

### 3. Get a Specific Task
- **Method**: `GET`
- **URL**: `/tasks/{task}`
- **Description**: Retrieve a specific task by ID.
- **Auth Required**: Yes (Bearer token)

### 4. Update a Task
- **Method**: `PUT`
- **URL**: `/tasks/{task}`
- **Description**: Update the task details.
- **Request Body**:
  ```json
  {
    "title": "string, required",
    "description": "string, optional",
    "status": "enum:todo,doing,done,missed, required",
    "folder_id": "integer, required"
  }
  ```
- **Response**:
  ```json
  {
    "message": "Task Updated Successfully"
  }
  ```
- **Auth Required**: Yes (Bearer token)

### 5. Delete a Task
- **Method**: `DELETE`
- **URL**: `/tasks/{task}`
- **Description**: Delete a task by ID.
- **Response**:
  ```json
  {
    "message": "Task Deleted Successfully"
  }
  ```
- **Auth Required**: Yes (Bearer token)

### 6. Get Tasks in a Folder
- **Method**: `GET`
- **URL**: `/folders/{folder}/tasks`
- **Description**: Retrieve all tasks in a specific folder.
- **Auth Required**: Yes (Bearer token)

---

## User Management
These endpoints handle user profile management.

### 1. Get User Info
- **Method**: `GET`
- **URL**: `/users`
- **Description**: Retrieve the authenticated user’s information.
- **Auth Required**: Yes (Bearer token)

### 2. Update User Info
- **Method**: `PUT`
- **URL**: `/users`
- **Description**: Update the authenticated user’s name.
- **Request Body**:
  ```json
  {
    "name": "string, required"
  }
  ```
- **Response**:
  ```json
  {
    "message": "User Name Updated Successfully"
  }
  ```
- **Auth Required**: Yes (Bearer token)

### 3. Delete User Account
- **Method**: `DELETE`
- **URL**: `/users`
- **Description**: Delete the authenticated user’s account.
- **Response**:
  ```json
  {
    "message": "User Account Deleted Successfully"
  }
  ```
- **Auth Required**: Yes (Bearer token)
