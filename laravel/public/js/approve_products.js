$(document).ready(function () {
    $('#alertMessage').hide();


    $('#approveProduct').click(function () {
        var id = $(this).val();
        $.post("/products/publish", {
            productID: id
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
        $(this).find('#approveProduct').val(productID);
    });

});
