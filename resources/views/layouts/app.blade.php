<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character set and responsive viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page title -->
    <title>Shoe Store</title>
    
    <!-- Bootstrap CSS for layout and styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
    <!-- Google Fonts for the Roboto font family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    
    <style>
        /* Body styling with background image and custom font */
        body {
            font-family: 'Roboto', sans-serif; /* Apply Roboto font */
            background-image: url('{{ asset('images/background.jpg') }}'); /* Background image */
            background-size: cover;       /* Ensures the background image covers the whole page */
            background-position: center;  /* Centers the background image */
            background-attachment: fixed; /* Keeps the background fixed while scrolling */
            color: #343a40; /* Text color */
            line-height: 1.6; /* Line spacing for readability */
            position: relative; /* Required for positioning the overlay */
        }

        /* Overlay styling to darken the background, so that readability is better */
        body::before {
            content: ""; 
            position: fixed; /* Fixed position to cover the entire screen */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent dark overlay */
            z-index: -1; /* Ensure the overlay is behind all content */
        }

        /* Header and footer styling */
        header, footer {
            background-color: #8B0000; /* Dark red color for header/footer */
            color: #ffffff; /* White text color */
        }

        /* Header navigation link styling */
        header nav a {
            color: #ffffff; /* White text for links */
            font-weight: 500; /* Medium font weight */
            margin-right: 20px; /* Right margin between links */
            transition: color 0.3s; /* Smooth color transition on hover */
            text-decoration: none; /* Remove underline from links */
        }

        /* Hover effect for navigation links */
        header nav a:hover {
            color: #ffd1d1; /* Light red color on hover */
        }

        /* Main content area styling */
        main.container {
            padding: 20px; /* Padding around the content */
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent white background */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Subtle shadow */
            position: relative; /* Ensure content is above the overlay */
            z-index: 1; /* Keep content above the dark overlay */
        }

        /* Heading styling for better readability */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 500; /* Medium font weight for headings */
            color: #212529; /* Dark text color for headings */
        }

        /* Footer text alignment and styling */
        footer .text-center {
            font-weight: 500; /* Medium font weight for footer text */
        }

        /* Primary button styling */
        .btn-primary {
            background-color: #007bff; /* Blue background color */
            border: none; /* Remove border */
            font-weight: 500; /* Medium font weight */
        }

        /* Hover effect for primary buttons */
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    
    <!-- Header section with navigation links -->
    <header class="p-3">
        <nav class="container d-flex justify-content-between align-items-center">
            <!-- Links for navigation to home, create and search pages -->
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
            <a href="{{ route('create') }}" class="text-decoration-none">Create</a>
            <a href="{{ route('search') }}" class="text-decoration-none">Search</a>
        </nav>
    </header>

    <!-- Main content area where the dynamic page content will be injected -->
    <main class="container my-4 flex-grow-1">
        @yield('content') <!-- This will inject content from other views -->
    </main>

    <!-- Footer section with copyright text -->
    <footer class="p-3 mt-auto">
        <div class="text-center">
            © {{ date('Y') }} Shoe Store. All rights reserved by Shoeshop.
        </div>
    </footer>

</body>
</html>
