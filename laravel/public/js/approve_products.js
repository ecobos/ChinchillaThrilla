$(document).ready(function () {
    $('#alertMessage').hide();


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

    $('#confirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var productID = button.data('val'); // Extract info from data-* attributes
        $(this).find('#approveProduct').val(productID);
    });

});
