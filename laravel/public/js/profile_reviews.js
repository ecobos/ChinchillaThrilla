// Wait for the DOM to load before running the script
$(document).ready(function () {
    $('#alertMessage').hide();

    /**
     *  Take action when the delete comment button is pressed.
     *  Show an animation to indicate that work is being done. Run an async task
     *  to update the database with the delete action.
     */
    $('#doDelete').click(function () {
        var id = $(this).val();
        $.post("/reviews/rm", {
            productID: id
        }, function () {
            $('#section-' + id).fadeOut(500, function () {
                $("#alertMessage").fadeTo(2000, 500).slideUp(500, function () {
                    $("#alertMessage").hide();
                });
            });
        });
    });

    /**
     * Display a modal asking to confirm or cancel the irreversible action
     */
    $('#confirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var productID = button.data('val'); // Extract info from data-* attributes
        $(this).find('#doDelete').val(productID);
    });

});
