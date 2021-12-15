<!-- app/views/layout/layout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InspireAcademy</title>

    {!! HTML::script(URL::to('/').'/js/custom.js') !!}

    {!! HTML::script(URL::to('/').'/jquery/jquery-1.12.4.js') !!}
    {!! HTML::script(URL::to('/').'/jquery/jquery-ui-1.12.1/jquery-ui.min.js') !!}
    {!! HTML::style(URL::to('/').'/jquery/jquery-ui-1.12.1/jquery-ui.min.css') !!}

    {!! HTML::script(URL::to('/').'/bootstrap/js/bootstrap.js') !!}
    {!! HTML::style(URL::to('/').'/bootstrap/css/bootstrap.min.css') !!}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>

    {!! HTML::script(URL::to('/').'/DataTables/media/js/jquery.dataTables.js') !!}
    {!! HTML::style(URL::to('/').'/DataTables/media/css/jquery.dataTables.min.css') !!}

    {!! HTML::script(URL::to('/').'/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') !!}
    {!! HTML::script(URL::to('/').'/DataTables/extensions/Buttons/js/buttons.print.min.js') !!}
    {!! HTML::style(URL::to('/').'/DataTables/extensions/Buttons/css/buttons.dataTables.min.css') !!}
    {!! HTML::script(URL::to('/').'/DataTables/extensions/Buttons/js/buttons.html5.js') !!}
    {!! HTML::script(URL::to('/').'/DataTables/extensions/Buttons/js/buttons.flash.js') !!}

    {!! HTML::script(URL::to('/').'/ckeditor/ckeditor.js') !!}

    {!! HTML::style(URL::to('/').'/bootstrap-select/css/bootstrap-select.css') !!}
    {!! HTML::script(URL::to('/').'/bootstrap-select/js/bootstrap-select.js') !!}

    {!! HTML::style(URL::to('/').'/select2/css/select2.min.css') !!}
    {!! HTML::script(URL::to('/').'/select2/js/select2.full.min.js') !!}


    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            bottom: 0;
            background-color: #fffff;
            overflow-x: hidden;
            transition: 0.2s;
            padding-top: 40px;
        }
        .sidenav a {
            padding: 5px 5px 5px 20px;
            text-decoration: none;
            font-size: 12px;
            color: #818181;
            display: inline;
            transition: 0.3s;
        }
        .sidenav a:hover {
            color: #f1f1f1;
        }
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        #main {
            transition: margin-left .5s;
            padding: 16px;
        }
        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>

</head>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script>
<body>
<div class="container-fluid">
    @if(!Auth::guest())
        <div class="row">
            <div class="col-md-12">
                <div style = "position: absolute;top: 0;left: 0;z-index: 1000;">
                    <!-- sidebar content -->
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        @include('layout.sidebar')
                    </div>
                    <div id="main">

                        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
                    </div>
                </div>

                <div class="header navbar">
                    @include('layout.header')
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            @if ( session()->has('success') )
                <div class="alert alert-success alert-dismissable" role="alert">{{ session()->get('success') }} <button type="button" class="close" data-dismiss="alert" aria-label="close">&times;</button></div>
            @elseif ( session()->has('warning') )
                <div class="alert alert-warning alert-dismissable">{{ session()->get('warning') }}</div>
            @elseif ( session()->has('info') )
                <div class="alert alert-info alert-dismissable">{{ session()->get('info') }}</div>
            @elseif ( session()->has('danger') )
                <div class="alert alert-danger alert-dismissable">{{ session()->get('danger') }}</div>
            @endif
            @yield('content')
        </div>
    </div>

</div>

<script type='text/javascript'>
    jQuery(document).ready(function() {
        jQuery('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {extend: 'print', footer: true},
                {extend: 'excelHtml5', footer: true}
            ],
            "aaSorting": [],
            'iDisplayLength': 100
        });
    });
</script>
</body>
</html>