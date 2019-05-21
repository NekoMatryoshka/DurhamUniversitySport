function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validationMessage(id, message) {
    $(id).css({
        "border": '#FF0000 1px solid'
    });
    $(id).val("");
    $(id).attr("placeholder", message);
    return;
}


function validationPass(ids) {
    for (i = 0; i < ids.length; i++) {
        $(ids[i]).css({
            "border": '#ced4da 1px solid'
        });
    }

}