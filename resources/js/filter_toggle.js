document.addEventListener("DOMContentLoaded", function () {
    let isFilterOpen = false; // Track whether the filter options are open
    const filterOptions = document.querySelector(".filter-options");
    const filterButton = document.getElementById("filter-btn");

    if (!filterOptions || !filterButton) {
        console.error("Filter options or button not found in the DOM.");
        return;
    }

    // Toggle filter options on button click for small screens
    function toggleFilter() {
        const currentDisplay = window.getComputedStyle(filterOptions).display;

        if (currentDisplay === "none") {
            filterOptions.style.display = "block"; // Open the filter options
            isFilterOpen = true;
        } else {
            filterOptions.style.display = "none"; // Close the filter options
            isFilterOpen = false;
        }
    }

    if (window.innerWidth < 1024) {
        // Set initial state based on computed style
        isFilterOpen = window.getComputedStyle(filterOptions).display !== "none";

        filterButton.addEventListener("click", toggleFilter);

        // Prevent closing when clicking inside the filter area
        filterOptions.addEventListener("click", function (event) {
            event.stopPropagation();
        });
    }

    // Ensure filter options are always visible on large screens
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 1024) {
            filterOptions.style.display = "block"; // Always show filter options
            isFilterOpen = true;
        } else {
            // For small screens, hide if it was closed or show if it was open
            if (isFilterOpen) {
                filterOptions.style.display = "block";
            } else {
                filterOptions.style.display = "none";
            }
        }
    });
});
