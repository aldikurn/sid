<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- <div class="card-header">
      <h3 class="card-title">Daftar Penduduk</h3>
    </div> -->
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Address</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                </table>
            </div><!-- /.card-body -->
        </div> <!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->


<script>
    function format(d) {
        return '<div class="dt-row-detail">' +
            '<button type="button" class="dt-btn-row-detail btn btn-warning">Edit</button>' +
            '<button type="button" class="dt-btn-row-detail btn btn-danger">Delete</button></div>';

    }

    $(document).ready(function () {

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

        $('#example tbody').on('click', 'tr', function () {
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
        dt.on('draw', function () {
            dt.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
            $.each(detailRows, function (i, id) {
                $('#' + id + ' td.details-control').trigger('click');
            });
        });
    });
</script>