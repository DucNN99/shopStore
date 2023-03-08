<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('/package/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/package/noty/noty.min.css') }}" rel="stylesheet">
<link href="{{ asset('/package/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .breardcumb-cs a:hover{
        text-decoration:none;
    }
    .noty_buttons{
        text-align:center;
    }
    .select-box input{
        height:31px;
    }
    #detail_table {
        color:black;
    }
    .my-custom-scrollbar {
        position: relative;
        height: 550px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
    }
    #modal-select .modal-lg, #modal-select-add .modal-lg {
        max-width: 60% !important;
    }
    .select-box .result-suggest {
        display: none;
        position: fixed;
        background-color: #fff;
        width: 350px;
        box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 20%);
        z-index: 10;
        border: 1px solid #bfbfbf;
    }
    .select-box .result-suggest #detail_table_search{
        margin-bottom: 0 !important;
    }
    #detail_table tbody th, #detail_table tbody td {
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        border: 1px solid #9d9696 !important;
    }
</style>
