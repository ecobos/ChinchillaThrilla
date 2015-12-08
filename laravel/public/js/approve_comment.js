// Wait for the DOM to load before running the script
$(document).ready(function () {
    $('#alertMessage').hide();
    $('.commentApprovalMsg').hide();

    /**
     *  Take action when the approve comment button is pressed.
     *  Show an animation to indicate that work is being done. Run an async task
     *  to update the database with the approved action.
     */
    $('.commentApprovalBtn').click(function () {
        var prodID = $(this).data('prodid');
        var userID = $(this).data('userid');
        var section = "#section-" + prodID + "-" + userID;
        var sectionBtn = '#' + prodID + "-" + userID;

        $(sectionBtn).after('<span class=\"glyphicon glyphicon-refresh glyphicon-refresh-animate\"></span>');

        $.post("/reviews/approve", {
            user_id: userID,
            prod_id: prodID
        }, function () {
            $('.glyphicon-refresh-animate').remove();
            $(sectionBtn).show();
            $(section + " button:first").addClass('disabled');
            $.fn.hideSection(section);
        });
    });


    /**
     *  Take action when the delete comment button is pressed.
     *  Hide the target comment. Run an async task
     *  to update the database with the delete action.
     */
    $('#deleteComment').click(function () {
        var prodID = $(this).data('which').prodID;
        var userID = $(this).data('which').userID;
        var section = "#section-" + prodID + "-" + userID;

        $.post("/reviews/delete", {
            user_id: userID,
            prod_id: prodID
        }, function () {
            console.log("Deleted product: " + prodID + " user: " + userID);
            $.fn.hideSection(section);
        });
    });

    /**
     * Display a modal asking to confirm or cancel the irreversible action
     */
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var productID = button.data('prodid');
        var userID = button.data('userid');
        console.log("Got " + productID + " " + userID);
        $(this).find('#deleteComment').data('which', {prodID: productID, userID: userID});
    });

    // Helper function
    // section is defined by: #section-productID-userID
    $.fn.hideSection = function (section) {
        $(section + " div:first").delay("slow").slideUp("slow", function () {
            $(section).fadeOut("slow");
            var newVal = $('.nav-tabs .active span').text() - 1;
            $('.nav-tabs .active span').text(newVal);
        });
    }
});
