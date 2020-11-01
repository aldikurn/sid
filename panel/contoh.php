<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- DataTable -->
    <script src="../dependencies/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../dependencies/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../dependencies/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../dependencies/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <title>Document</title>
    <style>
        td.details-control {
            background: url('assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.details td.details-control {
            background: url('assets/images/details_open.png') no-repeat center center;
        }
    </style>
</head>

<body>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>First name</th>
                <th>Last name</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>First name</th>
                <th>Last name</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>
        </tfoot>
    </table>
    <script>
        function format(d) {
            return 'Full name: ' + d.first_name + ' ' + d.last_name + '<br>' +
                'Address' + d.address + '<br>' +
                'Phone: ' + d.phone + '<br>' +
                'The child row can contain any data you wish, including links, images, inner tables etc.';
        }

        $(document).ready(function() {
            var dt = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "services/ajax/getPendudukDT.php",
                "columns": [{
                        "class": "details-control",
                        "orderable": false,
                        "data": null,
                        "defaultContent": ""
                    },
                    {
                        "data": "first_name"
                    },
                    {
                        "data": "last_name"
                    },
                    {
                        "data": "address"
                    },
                    {
                        "data": "phone"
                    }
                ],
                "order": [
                    [1, 'asc']
                ]
            });

            // Array to track the ids of the details displayed rows
            var detailRows = [];

            $('#example tbody').on('click', 'tr td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = dt.row(tr);
                var idx = $.inArray(tr.attr('id'), detailRows);

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                } else {
                    tr.addClass('details');
                    row.child(format(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });

            // On each draw, loop over the `detailRows` array and show any child rows
            dt.on('draw', function() {
                $.each(detailRows, function(i, id) {
                    $('#' + id + ' td.details-control').trigger('click');
                });
            });
        });
    </script>
</body>

</html>