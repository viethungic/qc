<!-- Extends Layouts -->
<?php $view->extend('NHKQcBundle:Layout:layout.html.php') ?>
<!-- Title Page -->
<?php $view['slots']->start('title') ?>
<?php echo BASE_TITLE; ?> | Manage worker
<?php $view['slots']->stop() ?>

<!-- CSS -->
<?php $view['slots']->start('css') ?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/bundles/qc/assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/bundles/qc/assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/bundles/qc/assets/plugins/data-tables/DT_bootstrap.css"/>

<?php $view['slots']->stop() ?>
<!-- JS -->
<?php $view['slots']->start('js') ?>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/bundles/qc/assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/bundles/qc/assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/bundles/qc/assets/plugins/data-tables/DT_bootstrap.js"></script>

<script>
var TableEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[5] + '">';
            jqTds[6].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[6] + '">';
            jqTds[7].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[7] + '">';
            jqTds[35].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[36].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
            oTable.fnUpdate(jqInputs[7].value, nRow, 7, false);
            oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 35, false);
            oTable.fnUpdate('<a class="delete" href="">Xóa</a>', nRow, 36, false);
            oTable.fnDraw();

            var el = $("#setup-worker");
            App.blockUI({target: el, iconOnly: true});
            $.ajax({
                type: "POST",
                url: "<?php echo $view['router']->generate('nhk_qc_stock_edit') ?>",
                data: {
                    workerno:jqInputs[0].value,
                    fullname:jqInputs[1].value,
                    sex:jqInputs[2].value,
                    id:aData[5],
                },
                success: function(data) {
                    if (data == 'OK') {
                        alert('Editing success!');
                    } else if (data == 'Exist') {
                        alert('Item exist!');
                    } else {
                        alert('Editing failed!');
                    }
                    App.unblockUI(el);
                },
                error: function(){
                    alert('Error on Process');
                    App.unblockUI(el);
                }
            });
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
            oTable.fnUpdate(jqInputs[7].value, nRow, 7, false);
            oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 35, false);
            oTable.fnDraw();
        }

        var table = $('#worker_table');

        var oTable = table.dataTable({
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#worker_table_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
//                    alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();
</script>
<script>
    jQuery(document).ready(function() {
        TableEditable.init();
    });
</script>
<?php $view['slots']->stop() ?>

<div class="row" id="setup-worker">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit" STYLE="FONT-SIZE: 18PX"> PHIẾU THEO DÕI SẢN XUẤT</i>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="btn-group">
                        <button id="worker_table_new" class="btn green">
                            Export Excel <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="#">
                                    Print
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Save as PDF
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Export to Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered" id="worker_table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã số CN</th>
                        <th>Mã số Máy</th>
                        <th>Mã số SP</th>
                        <th>Số bộ</th>
                        <th>Số CAV</th>
                        <th>Cường độ lao đông %</th>
                        <th>Kế hoạch sản xuất ca 12h</th>
                        <th>Trọng lương phôi</th>
                        <th>Kế hoạch giao keo</th>

                        <th>ĐV</th>
                        <th>SL</th>
                        <th>Keo THỬ</th>
                        <th>Keo XỬ LÝ</th>
                        <th>Keo KHÁC</th>
                        <th>Quy đổi</th>
                        <th>Phế 1</th>
                        <th>Phế 2</th>
                        <th>Thừa </th>
                        <th>Thiếu keo</th>

                        <th>Tồn</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>STT Cây keo</th>

                        <th>MS QC</th>
                        <th>MS Ghi chú</th>
                        <th>Ghi chú của Đốc Công
                            hoăc Trưởng ca</th>
                        <th>ID</th>
                        <th></th>
                        <th style="display: none" class="cancel-col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $item): ?>
                        <tr>
                            <td>
                                <?php echo $item['id'] ?>
                            </td>
                            <td>
                                <?php echo $item['shapserialno'] ?>
                            </td>
                            <td>
                                <?php echo $item['machineserialno'] ?>
                            </td>
                            <td>
                                <?php echo $item['workerno'] ?>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo $item['kehoachsxca12h'] ?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                            <td><?php echo $item['soluongkeogiaosx'] ?></td>
                            <td><?php echo $item['keothusanpham'] ?></td>
                            <td><?php echo $item['keoxulysanpham'] ?></td>
                            <td><?php echo $item['keokhac'] ?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo $item['ton'] ?></td>

                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                            <td><?php echo $item['masoghichu'] ?></td>
                            <td><?php echo $item['ghichucuadoccong'] ?></td>
                            <td>&nbsp;</td>
                            <td>
                                <?php echo $item['id'] ?>
                            </td>
                            <td><a class="edit" href="javascript:;">Sửa</a></td>
                            <td style="display: none" class="cancel-col"><a class="delete" href="javascript:;"></a></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>