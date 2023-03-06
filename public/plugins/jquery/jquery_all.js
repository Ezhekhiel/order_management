$(document).ready(function () {
    $("#submit").click(function () {
        $.ajax({
            url: "roving/save",
            type: "post",
            data: $("#form_checklist").serialize(),
            success: function (data) {
                alert("Save Sukses");
            }
        });
        return false;
    });

});
