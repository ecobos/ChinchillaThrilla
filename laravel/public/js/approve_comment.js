$(document).ready(function () {
    $('#alertMessage').hide();
    $('.commentApprovalMsg').hide();

    $('.commentApprovalBtn').click(function(){
        var prodID = $(this).data('prodid');
        var userID = $(this).data('userid');
        var section =  "#section-" + prodID + "-" + userID;
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

    $('#deleteComment').click(function () {
        var prodID = $(this).data('which').prodID;
        var userID = $(this).data('which').userID;
        var section =  "#section-" + prodID + "-" + userID;

        $.post("/reviews/delete", {
            user_id: userID,
            prod_id: prodID
        }, function () {
            console.log("Deleted product: " + prodID + " user: " + userID);
            $.fn.hideSection(section);
        });
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var productID = button.data('prodid');
        var userID = button.data('userid');
        console.log("Got " + productID + " " + userID);
        $(this).find('#deleteComment').data('which', {prodID: productID, userID: userID});
    });

    // Helper function
    // section is defined by: #section-productID-userID
    $.fn.hideSection = function(section){
        $(section + " div:first").delay("slow").slideUp("slow", function(){
            $(section).fadeOut("slow");
            var newVal = $('.nav-tabs .active span').text() - 1;
            $('.nav-tabs .active span').text(newVal);
        });
    }
});
