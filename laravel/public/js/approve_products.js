// Wait for the DOM to load before running the script
$(document).ready(function () {
    $('#alertMessage').hide();

    /**
     *  Take action when the approve comment button is pressed.
     *  Show an animation to indicate that work is being done. Run an async task
     *  to update the database with the approved action.
     */
    $('#approveProduct').click(function () {
        var id = $(this).val();
        $.post("/products/publish", {
            productID: id
        }, function () {
            $('#section-' + id).fadeOut(500);
            var activeBadge = $('.active .badge');
            var oldVal = activeBadge.text();
            activeBadge.text(oldVal-1);
        });
    });

    /**
     * Display a modal asking to confirm or cancel the irreversible action
     */
    $('#confirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var productID = button.data('val'); // Extract info from data-* attributes
        $(this).find('#approveProduct').val(productID);
    });

});
