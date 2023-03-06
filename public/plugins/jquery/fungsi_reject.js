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

//input bgrade
$("#input2").keyup(
    delay(function (e) {
        document.getElementById("hasil-output2").value = this.value;
        var data = $(".form-user2").serialize();
        $.ajax({
            type: "GET",
            url: "/prod/save2",
            data: data,
            success: function () {
                $(".tampildata2").load("tampil2.php");
                document.getElementById("input2").value = "";
            }
        });
    }, 100)
);

//input cgrade
$("#input3").keyup(
    delay(function (e) {
        document.getElementById("hasil-output3").value = this.value;
        var data = $(".form-user3").serialize();
        $.ajax({
            type: "GET",
            url: "/prod/save3",
            data: data,
            success: function () {
                $(".tampildata3").load("tampil3.php");
                document.getElementById("input3").value = "";
            }
        });
    }, 100)
);
