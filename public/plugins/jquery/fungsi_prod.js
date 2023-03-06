var dataBarang = ["tes"];

function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

//--------------------------------------------input production Sewing-------------------------//

$("#input_sewing").keyup(
    delay(function (e) {
        document.getElementById("hasil-outputsewing").value = this.value;
        var data = $(".form-usersewing").serialize();
        $.ajax({
            type: "GET",
            url: "/prod/save_sewing",
            data: data,
            success: function () {
                // $(".tampildata_sewing").load("tampil.php");
                document.getElementById("input_sewing").value = "";
            }
        });
    }, 200)
);

//--------------------------------------------input production Assembling-------------------------//

$("#input_assembling").keyup(
    delay(function (e) {
        document.getElementById("hasil-outputassembling").value = this.value;
        var data = $(".form-userassembling").serialize();
        $.ajax({
            type: "GET",
            url: "/prod/save_assembling",
            data: data,
            success: function () {
                // $(".tampildata_sewing").load("tampil.php");
                document.getElementById("input_assembling").value = "";
            }
        });
    }, 200)
);

//--------------------------------------------input production Finish-------------------------//

$("#input_finish").keyup(
    delay(function (e) {
        document.getElementById("hasil-outputfinish").value = this.value;
        var data = $(".form-userfinish").serialize();
        $.ajax({
            type: "GET",
            url: "/prod/save_finish",
            data: data,
            success: function () {
                // $(".tampildata_sewing").load("tampil.php");
                document.getElementById("input_finish").value = "";
            }
        });
    }, 200)
)
