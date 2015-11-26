$(document).ready(function () {
    $('#alertMessage').hide();
    $('.commentApprovalMsg').hide();

    $('.commentApprovalBtn').click(function(){
        var prodID = $(this).data('prodid');
        var userID = $(this).data('userid');

        $('#' + prodID + "-" + userID).after('<span class=\"glyphicon glyphicon-refresh glyphicon-refresh-animate\"></span>');
        $.post("/reviews/approve", {
            user_id: prodID,
            prod_id: userID
        }, function () {
            $('.glyphicon-refresh-animate').remove();
            $('#' + prodID + "-" + userID).show();
            $(this).addClass('disabled');
        });
    });

    $('#approveComment').click(function () {
        alert('approve moderation');
        var id = $(this).val();
        var prodID = id.substring(0,id.indexOf("-"));
        var userID = id.substring(id.indexOf("-"));
        $.post("/reviews/approve", {
            user_id: prodID,
            prod_id: userID
        }, function () {
            $('#section-' + id).fadeOut(500, function () {
                $("#alertMessage").fadeTo(2000, 500).slideUp(500, function () {
                    $("#alertMessage").hide();
                });
            });
        });
    });

    $('#confirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var productID = button.data('val'); // Extract info from data-* attributes
        $(this).find('#approveComment').val(productID);
    });

});
