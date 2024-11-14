# Shoeshop Website

## Overview

This is a web application for Shoeshop, featuring Home, Create, Search, and Edit pages. The purpose of the website is to allow the admin (user) to interact with the database containing all the shoes in the inventory. Overall, the application simplifies shoe management and searching with an efficient, user-friendly interface.

- The **Home** page contains an introductory message for the user.
- The **Create** page includes a form that needs to be filled out to add shoes to the database's `shoes` table.
- The **Search** page offers input and selection filter options to allow the user to view desired shoes from the dataset, which are displayed in a table below the filter button. Inside the table, each shoe has an edit and delete button.
- Finally, the **Edit** page is similar to the Create page but with the forms pre-filled with the current values of the shoe to be edited.

## Main Features

The following features have been implemented:

### 1. **Laravel Framework and MySQL**
   - The application uses the **Laravel framework** for an easier and more streamlined web development experience.
   - For the database, **1NF** (First Normal Form) was implemented, as the database was restricted to a single table. **2NF** was not fully possible as the shoe brand is sometimes included as part of the shoe name.

### 2. **Migration and Seeders**
   - **Seeding**: The use of seeders allowed me to populate the database with randomly generated data. In the `database/factories/ShoeFactory.php` file, I ensured that each attribute (brand, type, material, etc.) was randomized using Faker.
   - **Migration**: Laravel's migration system enabled me to seamlessly create the `shoes` table in the database using Artisan commands.

### 3. **Basic CRUD Operations**
   - In the **Create**, **Search**, and **Edit** pages, CRUD operations (Create, Read, Update, and Delete) are implemented successfully. Both the **Create** and **Edit** operations share the same Blade view file (`shoe-form.blade.php`), ensuring code reusability.
   - These CRUD operations are vital for interacting with the `shoes` database table and managing shoe records.

### 4. **User-Friendly Design**
   - Using color contrast and consistent navigation, the user has an easy and enjoyable experience with the website. In the header of each page, the user can easily navigate between the core pages (Home, Create, Search, Edit).
   - **Readability**: The use of appropriate fonts, font sizes, and color schemes ensures that users can easily read and interact with the site. These design choices are implemented in the `resources/views/layouts/app.blade.php` file.

## Additional Features

These are additional features added to enhance the user experience or showcase a deeper understanding of Laravel:

### 1. **Search Facility**
   - Siple single selection or input search for the name.
   - Multiple selections can be made for brand, material, and colour using multi-select dropdowns to filter the shoe records accordingly.
   - Allow the user to view the desired shoe/s and view additional information about them like stock number or perform update and/or delete.
   - Found in the search.bladed.php file.

### 2. **Input Validation**
   - **Form Validation**: Using Laravel framework input validation is performed inline of each input tag in the sho-form.php file. This ensures that the integrity of the data in the shoes table is mainained and any future errors are prevented.
For both update and sore methods inside ShoeController.php, each attribute and correct data type is required for the the successful CRUD operation to take place.

### 3. **Pagination**
   - **Pagination** is implemented to handle a large number of shoe records efficiently. The page displays a limited number of shoes per page and provides navigation links to browse through pages of results.

### 4. **Flash Messages**
   - They are included inside the redirerct method, this ensures the user that the update and edit operations executed successfull.

### 5. **Ambitious CSS**
   - Within app.blade.php, is the external css that is used by all views. This style code is for page layout, styling forms and other component features. This ives more visual structure to the user and they find it easier to navigate through the website.

## Good Practices

The following best practices were applied to this project to ensure a clean, maintainable, and efficient codebase:

### 1. **MVC Architecture**
   - The project follows the **Model-View-Controller (MVC)** architecture, which ensures that the business logic, user interface, and data handling are cleanly separated, making the application easier to maintain and scale.

### 2. **Eloquent ORM**
   - Laravel's **Eloquent ORM** was used for database interactions. It simplifies querying the database and avoids the need for raw SQL queries, improving code readability and maintainability.

### 3. **Form Request Validation**
   - Custom **form request validation** was used for shoe creation and editing. This separates validation logic from controllers and makes the code more organized and maintainable.

### 4. **RESTful Routes and Resource Controllers**
   - **RESTful routes** were used for managing shoe records, ensuring that the application follows standard conventions for REST APIs.
   - **Resource controllers** were used to handle CRUD operations, ensuring a standardized and easy-to-follow structure for managing shoe data.
   - **Method Spoofing** was implemented to handle PUT and DELETE requests through HTML forms (since HTML forms only support GET and POST).

### 5. **Route Binding**
   - **Route binding** was used for automatically injecting model instances into the controller methods based on the route parameters. This improves the readability of routes and ensures consistency in how data is handled.

### 6. **Code Reusability with Blade Components**
   - Common UI components such as the header, footer, and filter form were created as reusable **Blade components**, which simplifies the code and enhances maintainability.

### 7. **Security Features**
   - **CSRF Protection**: Laravel’s built-in CSRF protection is enabled to protect the application from cross-site request forgery attacks, ensuring secure form submissions.
   - **Data Sanitization**: User inputs are sanitized to prevent potential security vulnerabilities like SQL injection and XSS (cross-site scripting).

### 8. **Templating**
   - Blade templating is used extensively to create reusable views and components, which helps avoid code duplication and makes the application more maintainable.

