function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var image = document.getElementById("myImage");
        reader.onload = function (e) {
            $('#myImage')
                .attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }
}