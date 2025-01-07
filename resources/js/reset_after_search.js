document.addEventListener("DOMContentLoaded", function () {
    // Get the search button element
    const searchButton = document.getElementById("name-search-btn");

    // Add a click event listener to the search button
    searchButton.addEventListener("click", function () {
        // Clear all other filter fields
        document.getElementById("brand").value = ""; // Clear multi-select brand field
        document.getElementById("type").value = ""; // Clear type field
        document.getElementById("material").value = ""; // Clear multi-select material field
        document.getElementById("price").value = ""; // Clear price field
        document.getElementById("colours").value = ""; // Clear multi-select colours field

        // Submit the form
        document.getElementById("filter-form").submit();
    });
});
