<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Edit Ajax</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f1f1f1;
    }

    .box {
        width: 900px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h3 align="center">Live Edit dengan Ajax</h3><br />
        <div class="table-responsive">
            </br>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<script type="text/javascript" language="javascript">
$(document).ready(function() {

    function load_data() {
        $.ajax({
            url: "<?php echo base_url(); ?>Welcome/load_data",
            dataType: "JSON",
            success: function(data) {
                var html = '<tr>';
                html +=
                    '<td id="nama_barang" contenteditable placeholder="Masukkan nama barang"></td>';
                html += '<td id="jumlah" contenteditable placeholder="Masukkan jumlah"></td>';
                html += '<td id="harga" contenteditable placeholder="Masukkan harga"></td>';
                html += '<td id="total" contenteditable></td>';
                html +=
                    '<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span></button></td></tr>';
                for (var count = 0; count < data.length; count++) {
                    html += '<tr>';
                    html += '<td class="table_data" data-row_id="' + data[count].id +
                        '" data-column_name="nama_barang" contenteditable>' + data[count]
                        .nama_barang + '</td>';
                    html += '<td class="table_data" data-row_id="' + data[count].id +
                        '" data-column_name="jumlah" contenteditable>' + data[count].jumlah +
                        '</td>';
                    html += '<td class="table_data" data-row_id="' + data[count].id +
                        '" data-column_name="harga" contenteditable>' + data[count].harga + '</td>';
                    html += '<td class="table_data" data-row_id="' + data[count].id +
                        '" data-column_name="total" contenteditable>' + data[count].total +
                        '</td>';
                    html += '<td><button type="button" name="delete_btn" id="' + data[count].id +
                        '" class="btn btn-xs btn-danger btn_delete"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                }
                $('tbody').html(html);
            }
        });
    }

    load_data();

    $(document).on('click', '#btn_add', function() {
        var nama_barang = $('#nama_barang').text();
        var jumlah = $('#jumlah').text();
        var harga = $('#harga').text();
        var total = $('#total').text();
        if (nama_barang == '') {
            alert('Masukkan nama barang');
            return false;
        }
        if (jumlah == '') {
            alert('Masukkan jumlah');
            return false;
        }
        if (harga == '') {
            alert('Masukkan harga');
            return false;
        }
        if (total == '') {
            alert('Masukkan total');
            return false;
        }
        $.ajax({
            url: "<?php echo base_url(); ?>Welcome/insert",
            method: "POST",
            data: {
                nama_barang: nama_barang,
                jumlah: jumlah,
                harga: harga,
                total: total
            },
            success: function(data) {
                load_data();
            }
        })
    });

    $(document).on('blur', '.table_data', function() {
        var id = $(this).data('row_id');
        var table_column = $(this).data('column_name');
        var value = $(this).text();
        $.ajax({
            url: "<?php echo base_url(); ?>Welcome/update",
            method: "POST",
            data: {
                id: id,
                table_column: table_column,
                value: value
            },
            success: function(data) {
                load_data();
            }
        })
    });

    $(document).on('click', '.btn_delete', function() {
        var id = $(this).attr('id');
        if (confirm("Apakah anda yakin ingin menghapus?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>Welcome/delete",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    load_data();
                }
            })
        }
    });

});
</script>