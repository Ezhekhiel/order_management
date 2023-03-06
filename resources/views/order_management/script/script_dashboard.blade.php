<script src="{{ asset('dist/js/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function(){
        main();
        $('#cell_id').on('change',function(e){
            $('#po_id').val('');
            $.ajax({
                url:"{{ route('dashboard.change.cell') }}",
                method:"get",
                data:{cell:$(this).val()},
                dataType:'JSON',
                success:function(data)
                {
                    $('#list_po_id').html(data.po);
                }
            })
        });
        $('#po_id').on('change',function(e){
            var cell = $('#cell_id').val();
            $.ajax({
                url:"{{ route('dashboard.change.po') }}",
                method:"get",
                data:{po:$(this).val(),cell:cell},
                dataType:'JSON',
                success:function(data)
                {
                    if (data.modal=="modal") {
                        $('#modal_detail').modal('show');
                        $('#list_style_id').html(data.style);
                        $('#modal_cell_id').val(data.cell);
                        $('#modal_po_id').val(data.po)
                    }else{
                        searchByPO(cell,data.po);
                    }
                }
            })
        });
        $('#modal_style_id').on('change',function(e){
            var po = $('#modal_po_id').val();
            var cell = $('#modal_cell_id').val();
            $.ajax({
                url:"{{ route('dashboard.change.modal.style') }}",
                method:"get",
                data:{po:po,cell:cell,style:$(this).val()},
                dataType:'JSON',
                success:function(data)
                {
                    $("#list_wide_id").html(data.list_wide);
                    $("#list_width_id").html(data.list_width);
                }
            })
        });
        $('.reset').on('click',function (e) {
            $(this).val('');
        });
        $('#searchDetail').on('submit',function(e) {
            event.preventDefault();
            $.ajax({
                url:"{{ route('dashboard.search.detail') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if (data.alert=='Data Gender tidak di temukan') {
                        $('#modal_detail').modal('hide');
                        alert('Data tidak di temukan');
                    }else{
                        $('.remove').remove();
                        $('#modal_detail').modal('hide');
                        $('#list_size_id').append(data.tdSize);
                        $('#gender_id').html(data.gender);
                        $('#list_qty_size').append(data.cuttingTdtotalQtySize);
                        $('#list_qty_size').append(data.cuttingTdQtySize);

                        $('#list_balance_cutting_id').append(data.cuttingThBalance);
                        $('#list_output_cutting_id').append(data.cuttingTdOutput);
                        $('#list_defect_cutting_id').append(data.cuttingTdDefect);
                        $('#list_shortage_cutting_id').append(data.cuttingTdShortage);

                        $('#list_balance_preparation_id').append(data.preparationThBalance);
                        $('#list_output_preparation_id').append(data.preparationTdOutput);
                        $('#list_defect_preparation_id').append(data.preparationTdDefect);
                        $('#list_shortage_preparation_id').append(data.preparationTdShortage);

                        $('#list_balance_sewing_id').append(data.sewingThBalance);
                        $('#list_output_sewing_id').append(data.sewingTdOutput);
                        $('#list_defect_sewing_id').append(data.sewingTdDefect);
                        $('#list_shortage_sewing_id').append(data.sewingTdShortage);

                        $('#list_balance_assembling_id').append(data.assemblingThBalance);
                        $('#list_output_assembling_id').append(data.assemblingTdOutput);
                        $('#list_defect_assembling_id').append(data.assemblingTdDefect);
                        $('#list_shortage_assembling_id').append(data.assemblingTdShortage);

                        $('#list_balance_stockfit_id').append(data.stockfitThBalance);
                        $('#list_output_stockfit_id').append(data.stockfitTdOutput);
                        $('#list_defect_stockfit_id').append(data.stockfitTdDefect);
                        $('#list_shortage_stockfit_id').append(data.stockfitTdShortage);
                    }
                }
            })
        })
    })

    function main() {
        $.ajax({
            url:"{{ route('dashboard.main') }}",
            method:"get",
            dataType:'JSON',
            success:function(data)
            {
                $('#list_cell').html(data.cell);
            }
        });
        working_report_cell();
        // setInterval(function() {working_report_cell()}, 5000);
    }
    function working_report_cell() {
        $.ajax({
            url:"{{ route('dashboard.working.report.cell') }}",
            method:"get",
            dataType:'JSON',
            success:function(data)
            {
                if (data.colomn_not_found) {
                    $('#tbody_working_report_cell').html(data.colomn_not_found);
                }else{
                    $('#tbody_working_report_cell').html(data.firstTr);
                }
            }
        });
    }
    function searchByPO(cell,po) {
        $.ajax({
            url:"{{ route('dashboard.search.po') }}",
            method:"GET",
            data:{cell:cell,po:po},
            dataType:'JSON',
            success:function(data)
            {
                if (data.alert=='Data Gender tidak di temukan') {
                    $('#modal_detail').modal('hide');
                    alert('Data tidak di temukan');
                }else{
                    $('.remove').remove();
                    $('#modal_detail').modal('hide');
                    $('#list_size_id').append(data.tdSize);
                    $('#gender_id').html(data.gender);
                    $('#list_qty_size').append(data.cuttingTdtotalQtySize);
                    $('#list_qty_size').append(data.cuttingTdQtySize);

                    $('#list_balance_cutting_id').append(data.cuttingThBalance);
                    $('#list_output_cutting_id').append(data.cuttingTdOutput);
                    $('#list_defect_cutting_id').append(data.cuttingTdDefect);
                    $('#list_shortage_cutting_id').append(data.cuttingTdShortage);

                    $('#list_balance_preparation_id').append(data.preparationThBalance);
                    $('#list_output_preparation_id').append(data.preparationTdOutput);
                    $('#list_defect_preparation_id').append(data.preparationTdDefect);
                    $('#list_shortage_preparation_id').append(data.preparationTdShortage);

                    $('#list_balance_sewing_id').append(data.sewingThBalance);
                    $('#list_output_sewing_id').append(data.sewingTdOutput);
                    $('#list_defect_sewing_id').append(data.sewingTdDefect);
                    $('#list_shortage_sewing_id').append(data.sewingTdShortage);

                    $('#list_balance_assembling_id').append(data.assemblingThBalance);
                    $('#list_output_assembling_id').append(data.assemblingTdOutput);
                    $('#list_defect_assembling_id').append(data.assemblingTdDefect);
                    $('#list_shortage_assembling_id').append(data.assemblingTdShortage);

                    $('#list_balance_stockfit_id').append(data.stockfitThBalance);
                    $('#list_output_stockfit_id').append(data.stockfitTdOutput);
                    $('#list_defect_stockfit_id').append(data.stockfitTdDefect);
                    $('#list_shortage_stockfit_id').append(data.stockfitTdShortage);
                }
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
