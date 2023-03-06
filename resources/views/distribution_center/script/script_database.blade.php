<script src="{{ asset('dist/js/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function(){
        main();
    });
    function main() {
        $.ajax({
                url:"{{ route('dc.dashboard.main') }}",
                method:"get",
                dataType:'JSON',
                success:function(data)
                {
                    var arrayResult = data.arrayResult;
                    var jam = data.jam;
                    var cell = data.cell;
                    var value_colom = '<td><div class="circle"></div></td>';
                    for (let i = 0; i < arrayResult.length; i++) {
                        $('#'+arrayResult[i]['jam']+'_'+arrayResult[i]['cell']).addClass(arrayResult[i]['color']);
                    }
                    // for (let i = 0; i < data.jam.length-1; i++) {
                    //     if (cell[i]=="SU") {
                    //         var cell_colom = '<th style="font-size:120%">STOCK UPPER</th>'
                    //     }else{
                    //         var cell_colom = '<th style="font-size:120%">CELL - '+cell[i]+'</th>'
                    //     }

                    //     $('#table_cell_id').append(cell_colom);
                    // }
                    // if (data.arrayResult.length==0) {
                    //     for (let i = 0; i < jam.length; i++) {
                    //         for (let y = 0; y < cell.length; y++) {
                    //             value_colom = '<td><div class="circle"></div></td>';
                    //             $('#colomn_jam_'+jam[i]).append(value_colom);
                    //         }
                    //     }
                    // }
                    // for (let i = 0; i < 11; i++) {
                    //     for (let y = 0; y < 10; y++) {
                    //         for (let b = 0; b < arrayResult.length; b++) {
                    //             if (jam[i]==arrayResult[b]['jam'] && cell[y]==arrayResult[b]['cell']){
                    //                 value_colom = '<td><div class="circle '+arrayResult[b]['color']+'"</div></td>';
                    //             }else{
                    //                 value_colom = '<td><div class="circle"></div></td>';
                    //             }
                    //         }
                    //         $('#colomn_jam_'+jam[i]).append(value_colom);
                    //     }
                    // }
                }
            })
    }

    function createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId) {
        var iconMap = {
            info: "fa fa-info-circle",
            success: "fa fa-thumbs-up",
            warning: "fa fa-exclamation-triangle",
            danger: "fa ffa fa-exclamation-circle"
        };

        var iconAdded = false;

        var alertClasses = ["alert", "animated", "flipInX"];
        alertClasses.push("alert-" + severity.toLowerCase());

        if (dismissible) {
            alertClasses.push("alert-dismissible");
        }

        var msgIcon = $("<i />", {
            "class": iconMap[severity] // you need to quote "class" since it's a reserved keyword
        });

        var msg = $("<div />", {
            "class": alertClasses.join(" ") // you need to quote "class" since it's a reserved keyword
        });

        if (title) {
            var msgTitle = $("<h4 />", {
            html: title
            }).appendTo(msg);

            if(!iconAdded){
            msgTitle.prepend(msgIcon);
            iconAdded = true;
            }
        }

        if (summary) {
            var msgSummary = $("<strong />", {
            html: summary
            }).appendTo(msg);

            if(!iconAdded){
            msgSummary.prepend(msgIcon);
            iconAdded = true;
            }
        }

        if (details) {
            var msgDetails = $("<p />", {
            html: details
            }).appendTo(msg);

            if(!iconAdded){
            msgDetails.prepend(msgIcon);
            iconAdded = true;
            }
        }


        if (dismissible) {
            var msgClose = $("<span />", {
            "class": "close", // you need to quote "class" since it's a reserved keyword
            "data-dismiss": "alert",
            html: "<i class='fa fa-times-circle'></i>"
            }).appendTo(msg);
        }

        $('#' + appendToId).prepend(msg);

        if(autoDismiss){
            setTimeout(function(){
            msg.addClass("flipOutX");
            setTimeout(function(){
                msg.remove();
            },1000);
            }, 5000);
        }
    }
</script>
