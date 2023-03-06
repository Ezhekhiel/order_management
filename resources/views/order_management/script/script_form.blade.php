<script src="{{ asset('dist/js/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function(){
        main();
        $('#form_update_cell_target').on('submit', function(event){
            $('.modal_cell_target').modal('hide');
            event.preventDefault();
            $.ajax({
                url:"{{ route('formInput.update.cell_target') }}",
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
                        createAlert('','Sukses','Update Sukses.','success',true,true,'pageMessages');
                    }else{
                        createAlert('','Gagal!','Update Gagal.','danger',true,true,'pageMessages');
                    }
                }
            })
        });
        $('#form_save').on('submit', function(event){
            $('.modal_save').modal('hide');
            event.preventDefault();
            $.ajax({
                url:"{{ route('formInput.save.process') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if(data.alert=="Sukses")
                    {
                        $('#modal_save').modal('hide');
                        if (data.detail) {
                            getDetailResult(data.detail)
                        }else{
                            getProcessResult(data.area,data.cell,data.po);
                        }
                        createAlert('',data.alert,data.pesan,'success',true,true,'pageMessages');
                    }else{
                        $('#modal_save').modal('hide');
                        createAlert('',data.alert,data.pesan,'danger',true,true,'pageMessages');
                    }
                }
            })
        });
        $('#cell_id').on('change',function (event) {
            $("select#process_id").prop('selectedIndex', 0);
            event.preventDefault();
            resetTable();
            $.ajax({
                url:"{{ route('formInput.cell.change') }}",
                method:"get",
                data:{cell:$(this).val()},
                dataType:'JSON',
                success:function(data)
                {
                    $('#po_list').html(data.option_po);
                    $('#qty_id').val(data.qty_order);
                }
            })
            $('#po_id').val('');
            $('#detail_id').val('');
            $('#bm_id').val('');
            $('#style_id').val('');
            $('#due_date_id').val('');
            $('#th_size_run').html('');
            $('#th_balance').html('');
            $('#td_output').html('');
            $('#td_defect').html('');
            $('#td_shortage').html('');
        });
        $('.reset-onclick').on('click',function (event) {
            $(this).val("");
        })
        $('#process_id').on('change',function(event){
            event.preventDefault();
            var cell = $('#cell_id').val();
            var po_id = $('#po_id').val();
            getProcessResult($(this).val(),cell,po_id);
        });
        $('#po_id').on('change',function (e) {
            resetTable();
            $("select#process_id").prop('selectedIndex', 0);
        });
        $('#po_id').on('click','.OutputSave',function (event) {
            event.preventDefault();
            var name = $(this).attr('name');
            var value = $(this).val();
            alert(name);
        })
        $("#detail_id").on('change',function () {
            event.preventDefault();
            getDetailResult($(this).val());
        })
    })
    function getDetailResult(detail) {
        var po = $('#po_id').val();
        var process = $('#process_id').val();
        $.ajax({
            url:"{{ route('formInput.detail.change') }}",
            method:"get",
            data:{detail:detail,po:po,process:process},
            dataType:'JSON',
            success:function(data)
            {
                resetTable();
                $('#qty_id').val(data.qty);
                $('#bm_id').val(data.bm);
                $('#style_id').val(data.style);
                $('#due_date_id').val(data.due_date);
                $('#th_size_run').html(data.thSize);
                $('#th_balance').html(data.thBalance);
                $('#td_output').html(data.tdOutput);
                $('#td_defect').html(data.tdDefect);
                $('#td_shortage').html(data.tdShortage);
            }
        })
    }
    function getProcessResult(area,cell,po) {
        $.ajax({
            url:"{{ route('formInput.process.change') }}",
            method:"get",
            data:{area:area,cell:cell,po:po},
            dataType:'JSON',
            success:function(data)
            {
                $('#qty_id').val(data.qty_order);
                if (data.jumlah==2) {
                    resetDetail();
                    resetTable();
                    $('.po_detail').show();
                    $('#detail_id').val('');
                    $('#detail_list').html(data.detail);
                }else{
                    $('.po_detail').hide();
                    $('#detail_id').val('');
                    $('#detail_list').html("");
                    $('#bm_id').val(data.bm);
                    $('#style_id').val(data.style);
                    $('#due_date_id').val(data.due_date);
                    $('#th_size_run').html(data.thSize);
                    $('#th_balance').html(data.thBalance);
                    $('#td_output').html(data.tdOutput);
                    $('#td_defect').html(data.tdDefect);
                    $('#td_shortage').html(data.tdShortage);
                }
            }
        })
    }
    function resetTable() {
        $('#th_size_run').html('');
        $('#th_balance').html('');
        $('#td_output').html('');
        $('#td_defect').html('');
        $('#td_shortage').html('');
    }
    function resetDetail()
    {
        $('.po_detail').hide();
        $('#detail_id').val('');
    }
    function main() {
        $('#date_id').val(new Date().toJSON().slice(0,10));
        $.ajax({
            url:"{{ route('formInput.main') }}",
            method:"get",
            dataType:'JSON',
            success:function(data)
            {
                $('#tr_header_cell').html(data.cell_tr);
                $('#tr_eolr').html(data.eolr_tr);
                $('#tr_mp_direct').html(data.mp_tr);
                $('#cell_id').html(data.option_cell);
            }
        });
    }
    function clickOutput(size,qty_size,type) {
        $('#modal_save').modal('show');
        $('#title_save').html(type+" Size : "+size);
        $('#id_size_save').val(size);
        $('#id_type_save').val(type);
        $('#id_po_save').val($('#po_id').val());
        $('#id_detail_save').val($('#detail_id').val());
        $('#id_cell_save').val($('#cell_id').val());
        $('#id_area_save').val($('#process_id').val());
        $('#id_qty_size_save').val(qty_size);
        $('#id_value_save').val('');
    }
    function updateCellTarget(id,title,val) {
        $('#modal_cell_target').modal('show')
        $('#old_val').html("old_val: "+val);
        $('#id_cell_target').val(id);
        $('#title_cell_target').val(title);
        $('#modal_title_input').html(title);
        $('#title_update_cell_target').html(title);
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
