document.addEventListener("DOMContentLoaded", function () {
    let isFilterOpen = false; // Track whether the filter options are open
    const filterOptions = document.querySelector(".filter-options");
    const filterButton = document.getElementById("filter-btn");

    // Ensure the filter options and button exist before attaching event listeners
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

    // Reattach the filter listener after page loads or refreshes (e.g., after login)
    function reattachFilterListener() {
        if (window.innerWidth < 1024) {
            filterButton.addEventListener("click", toggleFilter);

            // Prevent closing when clicking inside the filter area (if filter is open)
            filterOptions.addEventListener("click", function (event) {
                if (isFilterOpen) {
                    event.stopPropagation(); // Prevent the filter from closing
                }
            });
        }
    }

    // Initial setup and ensure the listener is attached
    reattachFilterListener();

    // Ensure the filter options remain visible on large screens
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 1024) {
            // On large screens, always show the filter options
            filterOptions.style.display = "block"; 
            isFilterOpen = true; // Make sure it is marked as open
        } else {
            // On small screens, we need to adjust the filter options display based on the previous state
            if (isFilterOpen) {
                filterOptions.style.display = "block";
            } else {
                filterOptions.style.display = "none";
            }
            
            // Reattach the filter button listener if not already done
            reattachFilterListener();
        }
    });
});
