<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="application/json; charset=UTF-8">

    <!-- Set charset to UTF-8 -->
    <meta charset="utf-8">

    <div class="title">
        <title>Datable</title>
    </div>

    <meta name="description" content="A simple and easy to use client-side PGP system.">
    <meta name="author" content="Heiswayi Nrird">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        tbody td{
            min-width: 10%;
        }
        thead th{
            min-width: 10%;
        }

        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }

        
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
            <div class="table-responsive">
                <table id="example" class="display" style="width:100%">
                    <thead id="head2">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th style="max-width: 70px;">Age</th>
                            <th width="16%">Start date</th>
                        </tr>
                    </thead>
                   
                    <thead class="filters">
                        <tr>
                            <th></th>
                            <th class="FilterinputSearch">Name</th>
                            <th class="FilterinputSearch">Position</th>
                            <th class="FilterinputSearch">Office</th>
                            <th class="FilterinputSearch" style="max-width: 70px;">Age</th>
                            <th> 
                               <div class="input-prepend input-group"> 
                                <span class="add-on input-group-addon">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" style="width: 90%; padding-left: 10px; font-size: 10px;" name="reportrange" id="reportrange2" class="form-control" value="">
                                </div> 
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script>
    
    $(document).ready(function() {

    function format (d) {
    // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<th>Salary:</th>'+
                '<td>'+d.salary+'</td>'+
            '</tr>'+
        '</table>';
    }

    var startdate;
    var enddate;
    $('#reportrange2').daterangepicker({
            "opens": "right",
            locale: { format: 'DD/MM/YYYY' },
        },
        function(start, end,label) {
        var s = moment(start.toISOString());
        var e = moment(end.toISOString());
        startdate = s.format("YYYY-MM-DD");
        enddate = e.format("YYYY-MM-DD");
    });
       
    $('#example .filters .FilterinputSearch').each( function () {
        var title = $('#example thead .FilterinputSearch').eq( $(this).index()-1).text();
        $(this).html( '<input type="text" style="margin-left 0 important; padding-left: 0 important; width: 95% !important" />' );
    });
    // DataTable
    var table = $('#example').DataTable({
        "responsive": true,
        "scrollX": true,
        "pagingType": "numbers",
        "processing": false,
        'serverSide': true,
        "ajax": {
           "url": "employees.php",
           "type": "GET",
           "data": function (d) {
                d.paramIni = startdate;
                d.paramEnd = enddate;
            }
        },
        "columns": [
            {
                "class": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "age" },
            { "data": "startdate" }
        ],
        "order": [[1, 'asc']],
        "columnDefs": [
            { "width": "5%", "targets": 4 }
        ],

        initComplete: function () {
            this.api().columns([1,2,3,4]).eq(0).each( function ( colIdx ) {
                var that = this;
                $( 'input', $('.filters th')[colIdx] ).on( 'keyup change', function () {
                    that
                    .column(colIdx)
                    .search( this.value )
                    .draw();
                });        
            });
        }
    });

    $('#reportrange2').on('apply.daterangepicker', function (ev, picker) {
       startdate = picker.startDate.format('YYYY-MM-DD');
       enddate = picker.endDate.format('YYYY-MM-DD');
       table.draw();
    });

    $('#example tbody').on('click', 'td.details-control', function() {
        var tr = $(this).parents('tr');
        var row = table.row(tr);
 
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
})

</script>
</html>