var searchRequest = null;
var typephieu               = '';
$(document).ready(function(){
    let position            = '';
    let pass                = '';
    let type                = '';
    let quyenso             = '';
    let id                  = '';
    let name                = '';
    let data_all            = '';
    let selectedRow         = 0;
    let remember_quyenso    = '';
    let remember_search     = '';
    let remember_type       = '';
    let remember_pass       = '';
    let remember_added      = false;
    let is_kho              = false;
    let kho_id              = -1;
    let ngaychungtu         = '';
    let use_all             = '';
    var minlength = 3;
    // show modal tìm kiếm
    $(document).on('click','.btn-show-modal-select', function (event) {
        getValue($(this));
        $('.search-select').val('');
        $('#show-table-select table').remove();
        getData();
    });
    //đóng modal tìm kiếm
    $('#btn-close-modal-select').on('click', function () {
        $('#modal-select').modal('hide');
        resetValue();
    });
    //tìm kiếm trong modal
    $(document).on('keyup','.search-select',function(){
        getData();
    });
    //tìm kiếm gợi ý

    $(document).on('keyup change','.barcode',function(e){
        getValue($(this));
        var minlength   = 3;
        var that        = this,
        search_suggest  = $(this).val();
        if (search_suggest == '') {
            if (position && id) {
                $('#'+position+' #'+id).val('');
                $('.'+position).val('');
                $("#"+position+' input[name="'+name+'"]').val('');
            }
        } else if (search_suggest.length >= minlength) {
            if (searchRequest != null) {
                searchRequest.abort();
            }
            getSuggest(search_suggest,$(this).parents('.select-box'), true);
            e.stopPropagation();
        }
    });

    $(document).on('keyup','.search-suggest',function(e){
        getValue($(this));
        var minlength   = 3;
        var that        = this,
        search_suggest  = $(this).val();
        if (search_suggest == '') {
            if (position && id) {
                $('#'+position+' #'+id).val('');
                $('.'+position).val('');
                $("#"+position+' input[name="'+name+'"]').val('');
            }
        } else if (search_suggest.length >= minlength) {
            if (searchRequest != null) {
                searchRequest.abort();
            }
            getSuggest(search_suggest,$(this).parents('.select-box'));
            e.stopPropagation();
        }
    });

    //phân trang trong modal
    $(document).on('click','#show-page-select a',function(e){
        e.preventDefault();
        page = $(this).attr('href').split('page=')[1];
        getData(page);
    });
    //chọn trong modal
    $(document).on('click','#show-table-select tr',function(e){
        var ma = $(this).find('.ma');
        data_id  =   $(ma).data('id');
        if (is_kho == true && pass == 'use') {
            kho_id = data_id;
        }
        data_ma  =   $(ma).html();
        data_ten =   $(ma).data('name');
        reset_forcus(id,position);
        $('#'+position+' #'+id).val(data_ma);
        $('#'+position).find('input[name=\''+name+'\']').val(data_id);
        if (pass == 'yes') {
            temp   =   data_all.filter(item => item.id == data_id);
            setValue(temp[0],position,typephieu);
        }
        $('#modal-select').modal('hide');
        resetValue();
        e.stopPropagation();

    })

    //chọn trong gợi ý
    $(document).on('click','.result-suggest tr',function(e){
        var ma = $(this).find('.ma');
        data_id  =   $(ma).data('id');
        if (is_kho == true && pass == 'use') {
            kho_id = data_id;
        }
        data_ma  =   $(ma).html();
        data_ten =   $(ma).data('name');
        reset_forcus(id,position);
        $('#'+position+' #'+id).val(data_ma);
        $('#'+position).find('input[name=\''+name+'\']').val(data_id);
        if (pass == 'yes') {
            temp   =   data_all.filter(item => item.id == data_id);
            setValue(temp[0],position,typephieu);
        }
        $(this).parents('.select-box').find('.result-suggest').css('display','none');
        resetValue();
        e.stopPropagation();
    })

    function reset_forcus(id,position) {
        var _id = id;
        var _position = position;
        setTimeout(function (){
            $('#'+_position+' #'+_id).focus();
        }, 500);
    }

    //check bấm ra ngoài
    $(document).click(function(){
        $('.select-box').find('.result-suggest').css('display','none');
    });

    //check up down enter
    $(document).on('keydown',function(e) {

        //ko phải up down enter thi vào đây
        if((e.which != 38) && (e.which != 40) && (e.which != 13)) {
            return;
        }
        //chọn modal vào đây
        if($('#modal-select').hasClass('show')) {
            var rows = $("#detail_table tbody").find("tr");
            select_row(e,rows);
        }
        //chon suggest vào đây
        else if ($('.select-box').find('.result-suggest').is(':visible')) {
            var rows = $("#detail_table_search").find('tr');
            select_row(e,rows);
        }

    });

    function select_row(e,rows)
    {
        //Prevent page scrolling on keypress
        e.preventDefault();
        //Clear out old row's color
        rows[selectedRow].style.backgroundColor = "#FFFFFF";
        //Calculate new row
        if(e.which == 38){
            selectedRow--;
        } else if(e.which == 40) {
            selectedRow++;
        } else if(e.which == 13) {

            //check model show or hidden
            if($('#modal-select').hasClass('show')) {
                var row = rows.get(selectedRow).getElementsByClassName('ma')[0]
                data_id  =   row.getAttribute('data-id');
                data_ma  = row.innerHTML;
                data_ten =   row.getAttribute('data-name')
                $('#'+position+' #'+id).val(data_ma);
                reset_forcus(id,position);
                $('#'+position).find('input[name=\''+name+'\']').val(data_id);
                if (pass == 'yes') {
                    temp   =   data_all.filter(item => item.id == data_id);
                    setValue(temp[0],position,typephieu);
                }
                $('#modal-select').modal('hide');
                resetValue();
            }

            //check find on input or no
            if($('.select-box').find('.result-suggest').is(':visible')) {
                var row = rows.get(selectedRow).getElementsByClassName('ma')[0]
                data_id  =   row.getAttribute('data-id');
                data_ma  = row.innerHTML;
                data_ten =   row.getAttribute('data-name')
                reset_forcus(id,position);
                $('#'+position+' #'+id).val(data_ma);
                $('#'+position).find('input[name=\''+name+'\']').val(data_id);
                if (pass == 'yes') {
                    temp   =   data_all.filter(item => item.id == data_id);
                    setValue(temp[0],position,typephieu);
                }
                e.stopPropagation();
                $('.result-suggest').remove();
                resetValue();
            }
        }
        if(selectedRow >= rows.length){
            selectedRow = 0;
        } else if(selectedRow < 0){
            selectedRow = rows.length-1;
        }
        //Set new row's color
        rows[selectedRow].style.backgroundColor = "#d8f6ff";
        $("input").blur();
    }

    //phan trang trong model
    function getData(page)
    {
        search    =   $('.search-select').val();
        if (remember_added == false) {
            remember_quyenso    = quyenso;
            remember_search     = search;
            remember_type       = type;
            remember_pass       = pass;
        }
        $.ajax({
            url     :   url_getdata,
            type    :   'GET',
            cache   :   false,
            data:{
                quyenso     :   remember_added == true ? remember_quyenso : quyenso,
                search      :   remember_added == true ? remember_search : search,
                page        :   page ? page : '',
                type        :   remember_added == true ? remember_type : type,
                pass        :   remember_added == true ? remember_pass : pass,
                kho_id      :   kho_id,
                ngaychungtu :   ngaychungtu,
                use_all     :   use_all
            },
            success: function (data) {
                $('#show-page-select').html(data['page']);
                $('#show-table-select').html(data['table']);
                $('#select-box-title').html(data['title']);
                // check nut add
                if (data['action'] != '') {
                    $('.select-add-element').show();
                    $('.select-add-element').data('name',data['action']['modal_name']);
                    $('.select-add-element').data('route',data['action']['route']);
                } else{
                    $('.select-add-element').hide();
                }
                data_all        = data.data_all;
                remember_added  = false;
            },
            error: function (data) {
                console.log('error');
            }
        })
    }

    function getSuggest(search_suggest,suggest)
    {
        var setupclass  = suggest.children().attr('id');
        searchRequest = $.ajax({
            url     :   url_getdata,
            type    :   'GET',
            cache   :   false,
            data:{
                quyenso     :   quyenso,
                search      :   search_suggest,
                suggest     :   'yes',
                type        :   type,
                pass        :   pass,
                kho_id      :   kho_id,
                ngaychungtu :   ngaychungtu,
                use_all     :   use_all
            },
            success: function (data) {
                if (data.isset == true) {
                    $('.result-suggest').remove();
                    suggest.append(data.resurl_suggest);
                    data_all    = data.data_all;
                    sg          = suggest.find('.result-suggest');
                    sg.css('display','block');
                    sg.css('top',suggest.find('.input-group').offset().top + 30);
                    sg.css('left',suggest.find('.input-group').offset().left);
                    if (data.data_all.length == 1 || search_suggest == 'Khách lẻ') {
                        $('.result-suggest tr:first').click();
                    }
                } else {
                    suggest.find('.result-suggest').css('display','none');
                    $('.'+setupclass).val('');
                    suggest.children().children('input[type=hidden]').val('');
                }
            },
            error: function (data) {
                console.log('error');
            }
        })
    }

    function getValue(e)
    {
        position    = e.parents('.select-box').children().attr('id');
        pass        = e.parents('.select-box').children().data('pass');
        type        = e.parents('.select-box').children().data('type');
        if (type == 'kho') {
            is_kho = true;
        }

        quyenso     = e.parents('.select-box').children().data('quyenso');
        id          = e.parents('.select-box').find('.search-suggest').attr('id');
        name        = e.parents('.select-box').find('.name').attr('name');
        if (type == 'chungtutaisan' && id == 'chungtutaisan_id_in') {
            ngaychungtu = $('#ngaychungtu_in').val();
        }
        if (type == 'chungtutaisan' && id == 'chungtutaisan_id_de') {
            ngaychungtu = $('#ngaychungtu_de').val();
        }
        use_all     = e.parents('.select-box').children().data('usetk');
    }

    function resetValue()
    {
        position    = '';
        pass        = '';
        type        = '';
        quyenso     = '';
        id          = '';
        name        = '';
        data_all    = '';
    }
    // EVENT-ADD-ELEMENT
    $('.select-add-element').click(function(){
        var data = [];
        data['modal_name'] = $(this).data('name');
        data['modal_form'] = $(data['modal_name']).find('form').attr('id');
        data['modal_route'] = $(this).data('route');
        getForm(data);
    });

    function getForm(data)
    {
        $('#modal-select').modal('hide');

        $(data['modal_name']).modal('show');
        // reset-form
        $('.'+data['modal_form']).trigger('reset');
        $('.'+data['modal_form']).removeClass('was-validated');
        //event-modal-show
        $(data['modal_name']).on('shown.bs.modal', function (e) {
            validForm(data);
            $(this).off('shown.bs.modal');
        });
    }

    function validForm(data)
    {
        form = $('.'+data['modal_form']);
        // xóa event submit
        form.unbind( "submit" );
        form.submit(function( event ) {
          event.preventDefault();
          event.stopPropagation()
            if (form[0].checkValidity()) {
                addElement(data);
            } else{
                form.addClass('was-validated');
            }
        });
    }

    function addElement(data)
    {
        remember_added = true;
        form = $('.'+data['modal_form']).serialize();
        $.ajax({
            url     :   data['modal_route'],
            type    :   'POST',
            cache   :   false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form,
            success: function (result) {
                if (result.success == false) {
                    notify(result.msg,'error');
                }else{
                    $('#modal-select').modal('show');
                    getData();
                    $(data['modal_name']).modal('hide');
                }
            },
            error: function (err) {
                message(err, '.'+data['modal_form']);
                validForm(data);
            }
        })
    }
    // EVENT-MODAL-SELECT-CLOSE
    $('.modal-select-close').click(function(){
        $('#modal-select').modal('show');
        getData();
    });

    $(".action_add").click(function() {
        isAdded = true;
        $("#add").show();
        $("#edit").hide();
    });
});

function onlyNumbers(str) {
    return /^[0-9]+$/.test(str);
}
