$(document).ready(function () {
    // Attach an event listener to the search input
    $("#searchInput").on("input", function () {
        // Get the value from the input
        var trx = $(this).val();

        // Perform AJAX request
        $.ajax({
            type: "GET",
            url: "searchDonationController.php", // Change to your actual search controller file
            data: { ser: "live", trx: trx },
            success: function (data) {
                // Update the result container with the returned data
                $("#liveSearchResults").html(data);
            },
        });
    });
});
