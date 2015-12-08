// Wait for the DOM to load before running the script
$(document).ready(function () {
    $('#alertMessage').hide();

    $('#cancelReview').click(function () {
        // redirects user back to search page
        window.history.back();
    });

});
