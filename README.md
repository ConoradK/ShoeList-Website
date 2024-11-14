# Shoeshop Website

## Overview

This is a web application for Shoeshop, featuring Home, Create, Search, and Edit pages. The purpose of the website is to allow the admin (user) to interact with the database containing all the shoes in the inventory. Overall, the application simplifies shoe management and searching with an efficient, user-friendly interface.

## Main Features

### 1. **Laravel Framework and MySQL**
   - The application uses the **Laravel framework**.
   - MySQL for the database, **1NF** (First Normal Form) was implemented.

### 2. **Migration and Seeders**
   - **Seeding**: Each appropriate attribute was randomised using Faker.
   - **Migration**: Artisan commands were used to create the `shoes` table in the database.

### 3. **Basic CRUD Operations**
   - In the **Create**, **Search**, and **Edit** pages, CRUD operations (Create, Read, Update, and Delete) are implemented successfully.

### 4. **User-Friendly Design**
   - **Colour contrast and Readability**: Styles are implemented in `resources/views/layouts/app.blade.php` and provide font choice, size, and colour.

## Additional Features

### 1. **Search Facility**
   - The search function includes filter selections and displays the filtered results in a table format.
     
### 2. **Input Validation**
   - **Form Input Validation**: Each filter option is marked as required in the HTML input/select tags.
   ![required](public\images\required.png)
   - Custom **form request validation** is used for shoe creation and editing, separating validation logic from restful route controllers and making the code more organised and maintainable. It also includes data type validation, as seen in the store and update methods.
   ![validation](public\images\validation.png)

### 3. **Pagination**
   - **Loop through Pagination Elements**: Elements are iterated through. Every element that is an array is either in an active or inactive state (determining if it is the current page or not). Also, previous and next links are enabled when necessary.
   - `resources/views/pagination/custom.blade.php`

### 4. **Flash Messages**
   - Used in Search and Create pages to confirm create, delete, and update CRUD operations. Success messages are passed inside the `ShoeController` when the create or update views are returned.
   
   ![flash_message](public\images\flash_message.png)
   ![flash_message](public\images\flash_message1.png)

### 5. **Ambitious CSS**
   - **Templating and styling**: The `resources/views/layouts/app.blade.php` layout file includes CSS that is used across all views, defining page layout, form styles, and other component features.

### 6. **Logical resoning**
   - **Previous Page**: Redirect users to the previous page after editing/updating a shoe. 
   ![logic](public\images\logic.png)

## Good Practices

### 1. **Eloquent ORM**
   - **Laravel's Eloquent ORM**: Laravel's Eloquent ORM is used for database interactions, which simplifies query execution and eliminates the need for raw SQL. This can be observed throughout the `ShoeController` file.
   ![eloquent](public\images\eloquent.png)

### 2. **Resource Controllers**
   - **Resource controllers** handle CRUD operations, ensuring a standardised and easy-to-follow structure for managing shoe data.
   - **Method Spoofing** is implemented to handle PUT and DELETE requests through HTML forms, making CRUD operations more manageable.
   ![spoofing](public\images\spoofing.png)

### 3. **Route Binding**
   - **Route binding**: Automatically injecting model instances into the controller methods based on the route parameters, improving route readability and data consistency.
   ![route_binding](public\images\route_binding.png)

### 4. **Code Reusability with Blade Components**
   - Any component inside the `app.blade.php` file, such as the footer and header, is reused throughout the view files.

### 5. **Security Features**
   - **CSRF Protection**: Laravel’s built-in CSRF protection is enabled to protect the application from cross-site request forgery attacks, ensuring secure form submissions.
   ![Crsf_protection](public\images\Crsf_protection.png)
   - **Data Sanitisation**: User inputs are sanitised to prevent SQL injections.
   ![data_sanitisation](public\images\data_sanitisation.png)


