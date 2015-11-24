window.onload =  function(){

    var checkBoxes = document.querySelectorAll("input[type=checkbox]");

    for(var i = 0 ; i < checkBoxes.length ; i++){
        checkBoxes[i].addEventListener("change", checkUncheck, false);
    }

    function checkUncheck(){
        for(var i = 0 ; i < checkBoxes.length ; i++){
            if(this.name !== checkBoxes[i].name && checkBoxes[i].checked){
                checkBoxes[i].checked = false;
            }
        }
    }

}