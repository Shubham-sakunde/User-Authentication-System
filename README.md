# User-Authentication-System
This project is a secure User Authentication system built with Laravel 11 and MongoDB. It includes essential features like user signup, login, logout, and password update. Designed with industry best practices, the system uses RESTful APIs and is secured with Bearer Token-based Authentication via Laravel Sanctum.

# User Authentication API

## Overview

This project is a secure and scalable User Authentication system developed with Laravel 11 and MongoDB. It features essential authentication functionalities such as user signup, login, logout, and password update. The API follows industry standards and is secured with Bearer Token-based Authentication, utilizing Laravel Sanctum.

## Features

- **Signup API:** Allows new users to register by providing an email and password.
- **Login API:** Authenticates users and issues a Bearer Token for session management.
- **Logout API:** Securely logs out users by revoking their Bearer Token.
- **Update Password API:** Enables users to update their password securely.

## Technologies Used

- **Laravel 11:** A PHP framework following the MVC pattern, known for its elegance and simplicity.
- **MongoDB:** A flexible and scalable NoSQL database.
- **Laravel Sanctum:** Provides API token authentication without the complexity of OAuth.
- **Postman:** Used for API testing and documentation.
- **Apache Server:** Serves the application in a stable environment.
- **REST APIs:** Ensures standardized and predictable endpoints.

## Key Components

- **Bearer Token-based Authentication:** Ensures secure API access, with tokens generated during login and revoked upon logout.
- **Request Validation:** Comprehensive validation of API requests to ensure data integrity.
- **Exception Handling:** Graceful handling of errors, with clear and consistent API responses.

## API Endpoints

1. **POST /signup**
   - Registers a new user with email and password.
   - Validates input to ensure data integrity.
   
2. **POST /login**
   - Authenticates the user and returns a Bearer Token.
   - Validates the email and password.
   
3. **POST /logout**
   - Revokes the user's Bearer Token, logging them out of the system.
   - Requires authentication.
   
4. **POST /update-password**
   - Allows the user to update their password.
   - Requires authentication.
