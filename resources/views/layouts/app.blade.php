<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding and viewport settings for responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to Bootstrap CSS (commented out, potentially for later use) -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <title>Shoe Store</title>

    <style>
        /* Basic body styling for font, color, and layout */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffe6e6; /* Light red background color */
            color: #343a40; /* Dark gray text color */
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes at least full viewport height */
        }

        /* Header and footer styling for consistent branding */
        header, footer {
            background-color: #8B0000; /* Dark red background for header and footer */
            color: #ffffff; /* White text color */
            padding: 15px;
        }

        /* Navigation bar styling within the header */
        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Styling for navigation links */
        header nav a {
            color: #ffffff; /* White text color for links */
            font-weight: 500;
            margin-right: 20px;
            transition: color 0.3s; /* Smooth color transition on hover */
            text-decoration: none; /* Remove underline */
        }

        /* Hover effect for navigation links */
        header nav a:hover {
            color: #ffd1d1; /* Lighter red color on hover */
        }

        /* Main content styling */
        main {
            flex-grow: 1; /* Ensures main section takes up remaining space */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Light shadow for depth */
        }

        /* Headers styling for consistent heading appearance */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 500;
            color: #212529; /* Darker shade for headings */
        }

        /* Footer text styling */
        footer .text-center {
            font-weight: 500;
        }

        /* Primary button styling */
        .btn-primary {
            background-color: #007bff; /* Blue color for button */
            border: none;
            font-weight: 500;
            padding: 10px 15px;
            color: white;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            border-radius: 5px; /* Rounded corners */
        }

        /* Hover effect for primary button */
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Custom styles specific to the Search Page */
        .filter-form .card {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow for filter card */
            padding: 20px;
        }

        /* Label styling within the filter form */
        .filter-form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /* Input and select box styling for filter form */
        .filter-form select, .filter-form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Styling for smaller text within the filter form */
        .filter-form small {
            font-size: 0.9em;
            color: #6c757d; /* Lighter gray for subtle text */
        }

        /* Styling for button row within the filter form */
        .filter-form .button-row {
            text-align: center;
            margin-top: 20px;
        }

        /* Button styling within the filter form */
        .filter-form .btn {
            background-color: #007bff; /* Blue button color */
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Hover effect for filter form button */
        .filter-form .btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Table styling for displaying shoe records */
        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        /* Styling for table headers and cells */
        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6; /* Light gray border */
        }

        /* Styling for table header row */
        .table th {
            background-color: red; /* Red background for headers */
            color: white;
        }

        /* Alternate row coloring for better readability */
        .table tr:nth-child(even) {
            background-color: #f8f9fa; /* Light gray background for even rows */
        }

        /* Button styling within the table */
        .table .btn {
            padding: 5px 10px;
            font-size: 0.9em;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Warning button styling within the table */
        .table .btn-warning {
            background-color: #8B8000; /* Dark yellow color */
            color: white;
        }

        /* Hover effect for warning button */
        .table .btn-warning:hover {
            background-color: #e0a800; /* Lighter yellow on hover */
        }

        /* Danger button styling within the table */
        .table .btn-danger {
            background-color: darkred;
            color: white;
        }

        /* Hover effect for danger button */
        .table .btn-danger:hover {
            background-color: red;
        }

        /* Container styling for form fields */
        .field-container {
            margin-bottom: 15px;
        }

        /* Label styling for form fields */
        .field-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        /* Input field styling */
        .field-input {
            width: 100%;
            padding: 10px 12px; /* Slightly increased padding */
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724; /* Dark green text */
            background-color: #d4edda; /* Light green background */
            border: 1px solid #c3e6cb; /* Slightly darker green border */
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>

    <!-- Header with navigation links -->
    <header>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('create') }}">Create</a>
            <a href="{{ route('search') }}">Search</a>
        </nav>
    </header>

    <!-- Main content section where page-specific content will be injected -->
    <main>
        @yield('content')
    </main>

    <!-- Footer section with a centered copyright message -->
    <footer>
        <div class="text-center">
            © {{ date('Y') }} Shoe Store. All rights reserved by Shoeshop.
        </div>
    </footer>

</body>
</html>
