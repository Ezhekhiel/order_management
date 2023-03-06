<script src="{{ asset('dist/js/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function(){
        main();
        checkalert();
        $('#form_incoming').on('submit', function(event){
            event.preventDefault();
            $(".border-danger").attr("class",'form-control clickReset validation ');

            var incoming = $("input[name='qty_incoming[]']").map(function(){return $(this).val();}).get();
            var balance = $("input[name='qty_balance[]']").map(function(){return $(this).val();}).get();
            var status = validationInput(incoming, balance);
            $.ajax({
                url:"{{ route('dc.incoming.save') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if(data.alert=="sukses")
                    {
                        $('#modal_cell_target').modal('hide');
                        main();
                        updateCardBalance(data.po,data.bm,data.wide,data.komponen);
                        createAlert('','Sukses!',data.text,data.color,true,true,'pageMessages');
                         $('.validation').val('');

                    }else{
                        if (data.open=='Modal not the same') {
                            $('#modal_not_the_same').modal('show');
                            $('#data_not_the_same').html(data.table_not_same);
                        }else{
                            createAlert('','Gagal!',data.text,data.color,true,true,'pageMessages');
                        }
                    }
                }
            })
        });
        $('#update_incoming').on('submit',function (event) {
            event.preventDefault();
            $.ajax({
                url:"{{ route('dc.incoming.update') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if(data.alert=="sukses")
                    {
                        $('#modal_update_income').modal('hide');
                        main();
                        createAlert('','Sukses!',data.text,data.color,true,true,'pageMessages');
                        updateCardBalance(data.po,data.bm,data.wide,data.komponen);
                    }else{
                        createAlert('','Gagal!',data.text,data.color,true,true,'pageMessages');
                    }
                }
            })
        });
        $('#not_the_same').on('submit',function (event) {
            event.preventDefault();
            $.ajax({
                url:"{{ route('dc.incoming.save_not_the_same') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if(data.alert=="sukses")
                    {
                        $('#modal_cell_target').modal('hide');
                        main();
                        createAlert('','Sukses!',data.text,data.color,true,true,'pageMessages');
                    }else{
                        if (data.open=='Modal not the same') {
                            $('#modal_not_the_same').modal('show');
                            $('#data_not_the_same').html(data.table_not_same);
                        }else{
                            createAlert('','Gagal!',data.text,data.color,true,true,'pageMessages');
                        }
                    }
                }
            })
        });
        $('.validation').on('click',function (event) {
            var gender = $('#gender_id').val();
            if (gender=="") {
                $(this).blur();
                createAlert('','Gagal!','form Gender harus di isi terlebih dahulu.','danger',true,true,'pageMessages');
            }
        });
        $('.clickReset').on('click',function (event) {
            $(this).val('');
        })
        $('.buymonth_id').on('.clickReset','click',function (event) {
            $(this).val('');
        })
        $('#buymonth_id').on('change',function (event) {
            $.ajax({
                url:"{{ route('dc.change.bm') }}",
                method:"get",
                data:{bm:$(this).val()},
                dataType:'JSON',
                success:function(data)
                {
                    if ($('#po_id').val()=="") {
                        $('#po_list').html(data.list_po);
                    }
                }
            })
        });
        $('#po_id').on('change',function (event) {
            // //disale input wide
                $('#wide_id').attr('readonly',true);
            //reset validation / size incoming
                $('.validation').val('');
                $('.validation_balance').val('');
                $('.balance_value').val('');
                $('.validation_balance').css({'background-color':'',color:'black'});
            var bm = $("#buymonth_id").val();
            if (bm=="") {
                $.ajax({
                url:"{{ route('dc.search.bm') }}",
                method:"get",
                data:{po:$(this).val()},
                dataType:'JSON',
                success:function(data)
                {
                    if (data.count>1) {
                        $('#buymonth_list').html(data.listBM);
                    }else{
                        $('#buymonth_id').val(data.listBM);
                    }
                }
            })
            }
            $.ajax({
                url:"{{ route('dc.change.po') }}",
                method:"get",
                data:{po:$(this).val(),bm:bm},
                dataType:'JSON',
                success:function(data)
                {
                    $('#komponen_id').html(data.komponen_list);
                }
            })
        });
        $('#wide_id').on('change',function (event) {
            var po = $('#po_id').val();
            var bm = $('#buymonth_id').val();
            var wide = $(this).val();
            var komponen = $('#komponen_id').val();
            //disale input wide
                $('#wide_id').attr('readonly',true);
            //reset validation / size incoming
                $('.validation').val('');
                updateCardBalance(po,bm,wide,komponen)
        });
        $('#komponen_id').on('change',function (event) {
            var po = $('#po_id').val();
            var bm = $('#buymonth_id').val();
            var wide= $('#wide_id').val();
            var komponen = $(this).val();
            //disale input wide
                $('#wide_id').attr('readonly',true);
            //reset validation / size incoming
                $('.validation').val('');
                updateCardBalance(po,bm,wide,komponen)
        });
    })
    function validationInput(incoming,balance) {
        var arrData =[];
        for (let i = 0; i < incoming.length; i++) {
            arrData=parseInt(incoming[i])-parseInt(balance[i]);
            if (arrData>0) {

                return i+1;
            }
        }
    }
    function checkalert() {
        var checkID = $('#alert_incoming').length;
        var checkIDbuymonthConfirm = $('#buymonthConfirm').length;
        if (checkID == 1) {
            if (checkIDbuymonthConfirm != 1) {
                timeout = setTimeout(alert_incomingHide, 3000);
            }
        }
    }
    function alert_incomingHide() {
        $('#alert_incoming').fadeOut();
    }
    function main() {
        $('#date_id').val(new Date().toJSON().slice(0,10));
        $.ajax({
            url:"{{ route('dc.incoming.main') }}",
            method:"get",
            dataType:'JSON',
            success:function(data)
            {
                $('#buymonth_list').html(data.bm_list);
            }
        });
    }
    function stockUpperCheck() {
        var checkBox = document.getElementById("checkStockUpper");
        if (checkBox.checked == true){
            $("#komponen_id").prop('disabled', true);
            $("#komponen_id").prop('selectedIndex', 0);
        } else {
            $("#komponen_id").prop('disabled', false);
        }
    }
    function openModal(id) {
        var po = $('#po_id').val();
        var wide = $('#wide_id').val();
        var komponen = $('#komponen_id').val();
        var size = $('#label_balance_'+id).html();
        var val = $('#visual_'+id).val();
        const val_convert = val.split(" of ")
        $('#modal_update_income').modal('show');
        $('#modal_po').val(po);
        $('#modal_wide').val(wide);
        $('#modal_size').val(size);
        $('#modal_komponen').val(komponen);
        $('#modal_qty_incoming').val(val_convert[0]);
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
    function updateCardBalance(po,bm,wide,komponen) {
        $.ajax({
            url:"{{ route('dc.change.data') }}",
            method:"get",
            data:{po:po,bm:bm,wide:wide,komponen:komponen},
            dataType:'JSON',
            success:function(data)
            {
                if (data.count_data>1) {
                    $('#wide_id').attr('readonly',false);
                    $('#wide_id').val('');
                    $('#wide_list').html(data.wide_list);
                }else{
                    $('#wide_id').val(data.wide);
                    $('#cell_id').val(data.cell);
                    $('#style_id').val(data.style);
                    $('#qty_po_id').val(data.qty);
                    $('#gender_id').val(data.gender);
                    for (let i = 0; i < data.size.length; i++) {
                        var ke = i+1;
                        if (data.data_qty[i]==="") {
                            $('#size_'+ke).attr('readonly',true);
                            $('#label_balance_'+ke).html(data.size[i]);
                        }else{
                            $('#label_size_'+ke).html(data.size[i]);
                            $('#label_balance_'+ke).html(data.size[i]);
                        }
                    }
                    for (let i = 0; i < data.data_qty.length; i++) {
                        var ke = i+1;
                        if (data.data_qty[i]==="") {
                            $('#balance_'+ke).val('');
                            $('#visual_'+ke).css({'background-color':'',color:'black'});
                        }else{
                            if (data.data_qty[i]==data.balance_qty[i]) {
                                var color = 'white';
                                var font = 'black';
                            }else if(data.data_qty[i]==0){
                                var color = 'green';
                                var font = 'white';
                            }else if(data.data_qty[i]<0){
                                var color = 'red';
                                var font = 'white';
                            }else{
                                var color = 'yellow';
                                var font = 'black';
                            }
                            $('#balance_'+ke).val(data.data_qty[i]);
                            $('#visual_'+ke).val(data.arrVisual[i]);
                            $('#visual_'+ke).css({'background-color':color,color:font});
                        }
                    }
                }
            }
        })
    }
</script>
