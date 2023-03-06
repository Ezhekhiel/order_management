<script src="{{ asset('dist/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery.printPage.js') }}" type="text/javascript"></script>
<script>
    var list_cell_all ='';
    $(document).ready(function(){
        $('.btnprint').printPage();
        main();
        $('#form_set_spk').on('submit', function(event){
            event.preventDefault();
            var qty_set_spk = $('#modal_qty_set_spk_id').val();
            var qty_set = $('#modal_qty_size_id').val();
            var jam = $('#set_jam').val();
            if (parseInt(qty_set_spk)>parseInt(qty_set)) {
                createAlert('','Gagal!','"Jumlah QTY SET SPK tidak boleh lebih dari QTY SET INCOMING','danger',true,true,'pageMessages');
                $('#modal_qty_set_spk_id').focus();
                return false;
            }
            if (qty_set_spk=="") {
                createAlert('','Gagal!','"Jumlah QTY SET SPK tidak boleh KOSONG!','danger',true,true,'pageMessages');
                return false;
            }
            if (jam==="") {
                createAlert('','Gagal!','"Set Jam" tidak boleh kosong','danger',true,true,'pageMessages');
                return false;
            }

            $.ajax({
                url:"{{ route('dc.spk.save') }}",
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
                        $('#modalSetSPK').modal('hide');
                        $('#modal_qty_set_spk_id').val('');
                        $('.resetValue').html('');
                        $('.resetValue').val('');
                        $('#set_jam').prop('selectedIndex',0);
                        $("#tbodyListSPK").html('')
                        // main();
                        createAlert('','Sukses!',data.text,data.color,true,true,'pageMessages');
                        clickDetailIncoming(data.po,data.wide);
                        mappingCell(data.arrayMappingCell);
                        addValueTableListSPK(data.cell,data.arrayMappingCell);
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
        $('#proses_mutasi').on('submit',function (event) {
            event.preventDefault();
            $.ajax({
                url:"{{ route('dc.spk.process_mutasi') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if(data.alert=="Sukses!")
                    {
                        $('#modalMutasiSPK').modal('hide');
                        $('#mutasi_file_id').val('');
                        $("#tbodyListSPK").html('')
                        createAlert('',data.alert,data.text,data.color,true,true,'pageMessages');
                        setTimeout(function(){
                            location.reload(true)
                        }, 3000);
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
        $('#proses_transfer').on('submit',function (event) {
            event.preventDefault();
            $.ajax({
                url:"{{ route('dc.spk.proses_transfer') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    if(data.alert=="Sukses!")
                    {
                        $('#modal_body_form_transfer').html('');
                        $('#modal_serah_terima_id').html('');
                        main();
                        createAlert('',data.alert,data.text,data.color,true,true,'pageMessages');
                        $('#tbodyListSPK').html("");
                        resetProgressBar();
                        mappingCell(data.arrayMappingCell);
                        addValueTableListSPK(data.cell,data.arrayMappingCell);

                        // add print form transfer
                            var link = "/dc/spk/print_priview_transfer/"+data.cell+"/"+data.jam+"/";
                            htmlstringBody='<div class="col-6">Print Surat Mutasi</div>'+
                                            '<div class="col-6">'+
                                                '<a href="'+link+'" target="_blank"  type="button" class="btnprint btn btn-secondary btn-block">Print</a>'+
                                            '</div>';
                            $('#modal_serah_terima_id').html(htmlstringBody);

                    }else{
                        createAlert('','Gagal!',data.text,data.color,true,true,'pageMessages');
                    }
                }
            })
        });
        $('#cell_id').on('change',function (even) {
            event.preventDefault();
            resetProgressBar();
            $('#tbodyListSPK').html("");
            $('#tbody_po_list').html("");
            $('#tbody_detail_incoming tr').remove();
            $('#time_mapping_cell').prop('disabled', false);
            $.ajax({
                url:"{{ route('dc.spk.cell_change') }}",
                method:"get",
                data:{cell:$(this).val()},
                dataType:'JSON',
                success:function(data)
                {
                    $('#cell_Id').prop('selectedIndex',0);
                    $('#po_id').html(data.list_po);
                    mappingCell(data.arrayMappingCell);
                    addValueTableListSPK(data.cell,data.arrayMappingCell);
                }
            });
        });
        $('#po_id').on('change', function (event) {
            event.preventDefault();
            $('#tbody_po_list').html("");
            $('#tbody_detail_incoming tr').remove();
            var cell = $('#cell_id').val();
            //reset
            $('#tbody_po_list').html('');
            $.ajax({
                url:"{{ route('dc.spk.po_change') }}",
                method:"get",
                data:{id_balance:$(this).val(),cell:cell},
                dataType:'JSON',
                success:function(data)
                {
                    $('#tbody_po_list').html(data.tbody_po_list);
                    $('#tbody_list_spk').html(data.tbody_list_spk);
                }
            });
        });
        $('#modalMutasi').on('click',function (event) {
            var id_balance = $('#modal_id_balance').val();
            $('#modalSetSPK').modal('hide');
            $('#modalMutasiSPK').modal('show');
            $('.title_po').html($('.title_po').html());
            var visual_cell = $('#visual_cell_id').html();
            $('#visual_mutasi_cell_id').html(visual_cell);
            $('#modal_mutasi_cell_id').val($('#modal_cell_id').val());
        });
        $('#modalBacksetSPK').on('click',function (event) {
            var cell = $('#modal_mutasi_cell_id').val();
            $('#modal_cell_id').val(cell);
            $('#modalSetSPK').modal('show');
            $('#modalMutasiSPK').modal('hide');
        });
        $('.resetValue').on('keyup',function (event) {

        });
    })
    function resetProgressBar(){
        $('.progress-bar').attr('class','progress-bar progress-bar-striped progress-bar-animated');
        $('.progress-bar').attr('style','width:0%');
        $('.progress-bar').html("");
        $('.display-progress-bar').html("");
    }
    function addValueTableListSPK(cell,arrayMappingCell){
        var tbodyListSPK = $('#tbodyListSPK');
        var trButton = $('.trButton');
        var button_transfer=""
        if (arrayMappingCell.length==0) {
            var stringTr = '<tr><th colspan="3">DATA BELUM ADA</th></tr>';
            $('#tbodyListSPK').append(stringTr);
            return true;
        }
        const arrJam = ['07:00-08:00','08:00-09:00','09:00-10:00','10:00-11:00','11:00-12:00','13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00','17:00-18:00','18:00-19:00'];
        const arrJam2 = ['7','8','9','10','11','13','14','15','16','17','18'];
        for (let i = 0; i < arrJam.length; i++) {
            var buttonDisable = "disabled";
            for (let y = 0; y < arrayMappingCell['id'].length; y++) {
                if (arrayMappingCell['id'][y]==arrJam2[i]) {
                    buttonDisable="";
                }
            }
            if (cell!="SU") {
                button_transfer = '<button type="button" '+buttonDisable+' onclick="functionModalTransfer(\''+cell+'\','+arrJam2[i]+')" class="btn btn-success btn-sm mr-2">Transfer</button>';
            }
            var stringTr = '<tr class="accordion-toggle trButton" data-toggle="collapse" id="trAwal'+arrJam2[i]+'">'+
                                '<th style="width:10%"><button onclick="functionTbodyInside('+arrJam2[i]+',\''+cell+'\')" class="btn btn-default btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></th>'+
                                '<th style="width:50%">'+arrJam[i]+'</th>'+
                                '<th style="width:40">'+
                                    button_transfer+
                                    '<button type="button" '+buttonDisable+' onclick="functionModalMutasi(\''+cell+'\','+arrJam2[i]+')" class="btn btn-info btn-sm mr-2">Mutasi</button>'+
                                    '<button type="button" '+buttonDisable+' onclick="functionModalUpdate(\''+cell+'\','+arrJam2[i]+')" class="btn btn-primary btn-sm mr-2">Update</button>'+
                                    '<button type="button" '+buttonDisable+' onclick="functionModalDelete(\''+cell+'\','+arrJam2[i]+')" class="btn btn-sm btn-danger">Remove</button>'+
                                '</th>'+
                            '</tr>';

            $('#tbodyListSPK').append(stringTr);
        }
    }
    function mappingCell(arrMpCell){
        if (arrMpCell.length !== 0 ) {
            for (let i = 0; i < arrMpCell['id'].length; i++) {
                $('#jam_'+arrMpCell['id'][i]).css('width',arrMpCell['width'][i]);
                $('#jam_'+arrMpCell['id'][i]).html(arrMpCell['width'][i]);
                $('#display_jam_'+arrMpCell['id'][i]).html(arrMpCell['display'][i]);
                $('#jam_'+arrMpCell['id'][i]).attr('class','progress-bar progress-bar-striped progress-bar-animated '+arrMpCell['color'][i]);
            }
        }else{
            $('.progress-bar').css('width','0');
            $('.progress-bar').html('0');
            $('.progress-bar').attr('class','progress-bar progress-bar-striped progress-bar-animated');
        }
    }
    var jamShow = 0;
    function functionTbodyInside(jam,cell)
    {
        if (jamShow!=0&&jamShow!=jam) {
            $('#demoTargetDefault-'+jamShow).remove();
            $('#statusShow').val(0);
        }
        if ($('#statusShow').val()==0) {
            $.ajax({
                url:"{{ route('dc.spk.search_jam') }}",
                method:"get",
                data:{jam:jam,cell:cell},
                dataType:'JSON',
                success:function(data)
                {
                    var tbody_list_spk = '';
                    if (data.tbody_list_spk) {
                        tbody_list_spk=data.tbody_list_spk;
                    }else{
                        tbody_list_spk='';
                    }
                    var stringTbodyInside = '<tr id="demoTargetDefault-'+jam+'">'+
                                            '<td colspan="12">'+
                                                '<div class="accordian-body">'+
                                                    '<table class="table table-striped">'+
                                                        '<thead>'+
                                                            '<tr class="info">'+
                                                                '<th>PO</th>'+
                                                                '<th>STYLE</th>'+
                                                                '<th>XFD</th>'+
                                                                '<th>SIZE</th>'+
                                                                '<th>CELL-AWAL</th>'+
                                                                '<th>CELL-UPDATE</th>'+
                                                                '<th>QTY SET</th>'+
                                                                '<th>JAM</th>'+
                                                                '<th>STATUS MUTASI</th>'+
                                                           ' </tr>'+
                                                        '</thead>'+
                                                        '<tbody>'+
                                                            tbody_list_spk+
                                                            '</tbody>'+
                                                    '</table>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>';
                    $('#trAwal'+jam).after(stringTbodyInside);
                    $('#statusShow').val(1);
                }
            });
        }else{
            $('#demoTargetDefault-'+jam).remove();
            $('#statusShow').val(0);
        }
        jamShow=jam;
    }
    function main() {
        $('#date_id').val(new Date().toJSON().slice(0,10));
        $.ajax({
            url:"{{ route('dc.spk.main') }}",
            method:"get",
            dataType:'JSON',
            success:function(data)
            {
                $('#cell_id').html(data.list_cell);
                list_cell_all=data.list_cell_all;
            }
        });
    }
    function clickDetailIncoming(po,wide) {
        $.ajax({
            url:"{{ route('dc.spk.detail_incoming') }}",
            method:"get",
            data:{po:po,wide:wide},
            dataType:'JSON',
            success:function(data)
            {
                $('#tbody_detail_incoming').html(data.tbody_detail_incoming);
                $('#th_komponen').attr('colspan',4)
            }
        });
    }
    function functionModalTransfer(cell,jam) {
        $('#modalTransferSPK').modal('show');
        $('#cell_modalTransferSPK').val(cell);
        $('#jam_modalTransferSPK').val(jam);
        $.ajax({
            url:"{{ route('dc.spk.detailModalFormTransfer') }}",
            method:"get",
            data:{cell:cell,jam:jam},
            dataType:'JSON',
            success:function(data)
            {
                var stringBody ='';
                if (data.status=="NOTHING") {
                    stringBody = '<table class="table table-striped text-center">'+
                                        '<thead class="thead-dark">'+
                                            '<tr class="info">'+
                                                '<th>PO</th>'+
                                                '<th>STYLE</th>'+
                                                '<th>XFD</th>'+
                                                '<th>SIZE</th>'+
                                                '<th>CELL-AWAL</th>'+
                                                '<th>CELL-UPDATE</th>'+
                                                '<th>QTY SET</th>'+
                                                '<th>JAM</th>'+
                                                '<th>STATUS MUTASI</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                    '<tbody id="tbody_modal_transfer">'+data.tbody_list_spk+'</tbody>'+
                                    '</table>';
                    string_serah_terima = '<div class="col-4 p-2">'+
                                                'Serah Terima Dengan?'+
                                            '</div>'+
                                            '<div class="col-8">'+
                                                '<input type="text" class="form-control" name="logistik" style="text-transform: uppercase;" id="logistik_modalTransferSPK">'+
                                            '</div>';
                }
                $('#modal_body_form_transfer').html(stringBody);
                $('#modal_serah_terima_id').html(string_serah_terima);
            }
        })
    }
    function functionModalMutasi(cell,jam) {
        $('#modalMutasiSPK').modal('show');
        $('#mutasi_cell_id').val(cell);
        $('#mutasi_jam_id').val(jam);
        $.ajax({
            url:"{{ route('dc.spk.detailFormMutasi') }}",
            method:"get",
            data:{cell:cell,jam:jam},
            dataType:'JSON',
            success:function(data)
            {
                var htmlstringBody = '';
                var htmlstringFooter = '';
                if (data.status=="NOTHING") {
                    $('#title_mutasi_spk').html('Kamu yakin akan mutasi Data?');
                    htmlstringBody='<div class="col-2">Cell Baru</div>'+
                                '<div class="col-10">'+
                                    '<select class="form-control" name="cell_new" id="mutasi_cel_new_id">'+
                                        list_cell_all+
                                    '</select>'+
                                '</div>'+
                                '<div class="col-2 mt-2">Set di jam</div>'+
                                '<div class="col-10 mt-2">'+
                                    '<select id="set_jam_new" class="form-control" name="set_jam_new">'+
                                        '<option value="">Pilih jam</option>'+
                                        '<option value="7">07:00</option>'+
                                        '<option value="8">08:00</option>'+
                                        '<option value="9">09:00</option>'+
                                        '<option value="10">10:00</option>'+
                                        '<option value="11">11:00</option>'+
                                        '<option value="13">13:00</option>'+
                                        '<option value="14">14:00</option>'+
                                        '<option value="15">15:00</option>'+
                                        '<option value="16">16:00</option>'+
                                        '<option value="17">17:00</option>'+
                                        '<option value="18">18:00</option>'+
                                    '</select>'+
                                '</div>'+
                                '<div class="col-2 mt-2">Deskripsi</div>'+
                                '<div class="col-10 mt-2">'+
                                    '<textarea class="form-control" name="description" row="3" id="mutasi_description_id"></textarea>'+
                                '</div>'+
                                '<div class="row mt-4">'+
                                    '<div class="col-2">PLANNER PEMOHON</div>'+
                                    '<div class="col-10"><td><input style="text-transform:uppercase"  type="text" name="planner_A" id="mutasi_planner_A_id" class="form-control resetValue"></td></div>'+
                                '</div>'+
                                '<div class="row mt-4">'+
                                    '<div class="col-2">PLANNER PEMILIK</div>'+
                                    '<div class="col-10"><td><input style="text-transform:uppercase"  type="text" name="planner_B" id="mutasi_planner_B_id" class="form-control resetValue"></td></div>'+
                                '</div>'+
                                '<div class="row mt-4">'+
                                    '<div class="col-2">LEADER</div>'+
                                    '<div class="col-10"><td><input style="text-transform:uppercase"  type="text" name="leader" id="mutasi_leader_id" class="form-control resetValue"></td></div>'+
                                '</div>'+
                                '<div class="row mt-4">'+
                                    '<div class="col-2">MANAGER</div>'+
                                    '<div class="col-10"><td><input style="text-transform:uppercase"  type="text" name="manager" id="mutasi_manager_id" class="form-control resetValue"></td></div>'+
                                '</div>'+
                                '<div class="row mt-4">'+
                                    '<div class="col-2">FACTORY MANAGER</div>'+
                                    '<div class="col-10"><td><input style="text-transform:uppercase"  type="text" name="fact_manager" id="mutasi_fact_manager_id" class="form-control resetValue"></td></div>'+
                                '</div>';

                    htmlstringFooter='<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'+
                                    '<button type="button" onClick="functionMutasi(\''+cell+'\','+jam+')" class="btn btn-primary">Process Mutasi</button>';

                }else if (data.status=="NOT YET"){
                    var link = "/dc/spk/print_priview_mutasi/"+cell+"/"+jam+"/";
                    $('#title_mutasi_spk').html('Verivikasi Data Mutasi?');
                    htmlstringBody='<div class="col-6">Print Surat Mutasi</div>'+
                                    '<div class="col-6">'+
                                        '<a href="'+link+'" target="_blank"  type="button" class="btnprint btn btn-secondary btn-block">Print</a>'+
                                    '</div>'+
                                    '<div class="col-6 mt-2">UPLOAD FORM MUTASI</div>'+
                                    '<div class="col-6 mt-2">'+
                                        '<input type="file" name="file" id="mutasi_file_id">'+
                                        '<input type="hidden" name="new_cell" id="mutasi_new_cell_id" value="'+data.new_cell+'">'+
                                        '<input type="hidden" name="set_jam" id="mutasi_set_jam_id" value="'+data.set_jam+'">'+
                                    '</div>';
                    htmlstringFooter='<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'+
                                        '<button type="button" class="btn btn-danger" onClick="functionRejectMutasi(\''+cell+'\','+jam+')">Reject</button>'+
                                        '<button type="submit" class="btn btn-primary">Proses Mutasi</button>';
                                        // onClick="functionVerivicationMutasi(\''+cell+'\','+jam+',\''+po+'\',\''+wide+'\')"
                }else if (data.status=="Ada Stock Upper") {
                    htmlstringBody='<div class="text-center"><h3>STOCK UPPER ADA, TIDAK BISA MUTASI DARI CELL LAIN !</h3></div>';
                }
                $('#html_modal_mutasi').html(htmlstringBody);
                $('#actionModalMutasiSPK').html(htmlstringFooter);
            }
        });
    }
    function functionOpenModalSetSPK(size,id_size,qty_set,po,cell,wide) {

        if (qty_set==0) {
            createAlert('','Gagal!','Qty Set tidak ada !','danger',true,true,'pageMessages');
            return false;
        }
        $('.resetValue').val('');
        $('#set_jam').prop('selectedIndex',0);
        $('.title_po').html(po);
        $('#modalSetSPK').modal('show');
        $('#modal_po_id').val(po);
        $('#modal_wide_id').val(wide);
        $('#modal_cell_id').val(cell);
        $('#modal_size_id').val(id_size);
        $('#modal_qty_size_id').val(qty_set);
        $('#visual_size_id').html(':  '+size);
        $('#visual_qty_size_id').html(':  '+qty_set);
    }
    function hideShowModalFormCell(type){
        if ($('#form-cell:'+type).length==0) {
            $('#form-cell').hide();
        }else{
            $('#form-cell').show();
        }
    }
    function updateCardBalancePo(po,bm) {
        $.ajax({
            url:"{{ route('dc.change.po') }}",
            method:"get",
            data:{po:po,bm:bm},
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
    function updateCardBalanceWide(cell_new,jam) {
        $.ajax({
            url:"{{ route('dc.change.wide') }}",
            method:"get",
            data:{po:po,bm:bm,wide:wide},
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
                        if (data.data_qty[i]!=0) {
                            $('#label_size_'+ke).html(data.size[i]);
                            $('#label_balance_'+ke).html(data.size[i]);
                        }
                        // else{
                        //     $('#size_'+ke).attr('readonly',true);
                        // }
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

    function functionMutasi(cell,jam){
        var cell_new = $('#mutasi_cel_new_id').val();
        var description = $('#mutasi_description_id').val();
        var set_jam_new = $('#set_jam_new').val();
        var planner_A = $('#mutasi_planner_A_id').val();
        var planner_B = $('#mutasi_planner_B_id').val();
        var leader = $('#mutasi_leader_id').val();
        var manager = $('#mutasi_manager_id').val();
        var fact_manager = $('#mutasi_fact_manager_id').val();
        if (cell_new=="" && description=="") {
            createAlert('','Gagal!','Pastikan New Cell dan Description terisi','danger',true,true,'pageMessages');
            return false;
        }
        $.ajax({
            url:"{{ route('dc.spk.saveMutasi') }}",
            method:"post",
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            data:{cell:cell,set_jam_new:set_jam_new,cell_new:cell_new,jam:jam,description:description,planner_A:planner_A,planner_B:planner_B, leader:leader,manager:manager,fact_manager:fact_manager},
            dataType:'JSON',
            success:function(data)
            {
                $('#modalMutasiSPK').modal('hide');
                if(data.alert=="sukses")
                {
                    main();
                    createAlert('','Data Mutasi Berhasil di simpan!',data.text,data.color,true,true,'pageMessages');
                }else{
                    createAlert('','Gagal!',data.text,data.color,true,true,'pageMessages');
                }
            }
        });
    }
    function functionRejectMutasi(cell,jam){
        $.ajax({
            url:"{{ route('dc.spk.reject_mutasi') }}",
            method:"post",
            data:{"_token": "{{ csrf_token() }}",cell:cell,jam:jam},
            dataType:'JSON',
            success:function(data)
            {
                if (data.alert == "Gagal!") {
                    $('#modalMutasiSPK').modal('hide');
                    createAlert('',data.alert,data.text,data.color,true,true,'pageMessages');
                }else{
                    $('#modalMutasiSPK').modal('hide');
                    mappingCell(data.arrayMappingCell);
                    addValueTableListSPK(data.po, data.wide, data.cell,data.arrayMappingCell);
                    createAlert('',data.alert,data.text,data.color,true,true,'pageMessages');
                }
            }
        });
    }
    function listCell()
    {
        $.ajax({
            url:"{{ route('list_cell') }}",
            method:"get",
            dataType:'JSON',
            success:function(data)
            {
            $('#list_new_cell_id').html(data.list_cell);
            }
        });
    }
    function functionUpdate(id) {

    }
    function functionDelete(id) {

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
    function functionVerivicationMutasi(cell,jam,po,wide) {
        var file = $('#mutasi_file_id').val();
        alert(file);
    }

</script>
