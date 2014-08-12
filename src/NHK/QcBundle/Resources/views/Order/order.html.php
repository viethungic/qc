<!-- Extends Layouts -->
<?php $view->extend('NHKQcBundle:Layout:layout.html.php') ?>
<!-- Title Page -->
<?php $view['slots']->start('title') ?>
<?php echo BASE_TITLE; ?> | Manage order
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
            jqTds[0].innerHTML = aData[0];
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = aData[3];
            jqTds[4].innerHTML = aData[4];
            jqTds[5].innerHTML = '<input type="text" class="form-control input-small" placeholder="0000-00-00" value="' + aData[5] + '">';
            jqTds[6].innerHTML = '<input type="text" class="form-control input-small" placeholder="0000-00-00" value="' + aData[6] + '">';
            jqTds[7].innerHTML = aData[7];
            jqTds[8].innerHTML = aData[8];
            jqTds[9].innerHTML = aData[9];
            jqTds[10].innerHTML = aData[10];
            jqTds[11].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[12].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(aData[0], nRow, 0, false);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
            oTable.fnUpdate(aData[3], nRow, 3, false);
            oTable.fnUpdate(aData[4], nRow, 4, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 6, false);
            oTable.fnUpdate(aData[7], nRow, 7, false);
            oTable.fnUpdate(aData[8], nRow, 8, false);
            oTable.fnUpdate(aData[9], nRow, 9, false);
            oTable.fnUpdate(aData[10], nRow, 10, false);
            oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 11, false);
            oTable.fnUpdate('<a class="delete" href="">Xóa</a>', nRow, 12, false);
            oTable.fnDraw();

            var el = $("#setup-order");
            App.blockUI({target: el, iconOnly: true});
            if(aData[13]=='add'){
                $.ajax({
                    type: "POST",
                    url: "<?php echo $view['router']->generate('nhk_qc_order_add') ?>",
                    data: {
                        shapserialno:jqInputs[0].value,
                        soluongyeucau:jqInputs[1].value,
                        ngaybatdau:jqInputs[2].value,
                        ngayhoanthanh:jqInputs[3].value,
                        id:aData[10],
                    },
                    success: function(data) {
                        //                        $("#confirm-order-data").html(data);
                        if (data == 'OK') {
                            alert('Adding success!');
                        } else if (data == 'Not Exist') {
                            alert('Mã SP does not exist!');
                        } else {
                            alert('Adding failed!');
                        }
                        App.unblockUI(el);
                    },
                    error: function(){
                        alert('Error on Process');
                        App.unblockUI(el);
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo $view['router']->generate('nhk_qc_order_edit') ?>",
                    data: {
                        shapserialno:jqInputs[0].value,
                        soluongyeucau:jqInputs[1].value,
                        ngaybatdau:jqInputs[2].value,
                        ngayhoanthanh:jqInputs[3].value,
                        id:aData[10],
                    },
                    success: function(data) {
                        if (data == 'OK') {
                            alert('Editing success!');
                        } else if (data == 'Not Exist') {
                            alert('Mã SP does not exist!');
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
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 10, false);
            oTable.fnDraw();
        }

        var table = $('#order_table');

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

        var tableWrapper = $("#order_table_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#order_table_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previous row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '', '', '', '', '', '', '', 'add']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }
            var nRow = $(this).parents('tr')[0]
            var aData = oTable.fnGetData(nRow);

            var el = $("#setup-order");
            App.blockUI({target: el, iconOnly: true});
            $.ajax({
                type: "POST",
                url: "<?php echo $view['router']->generate('nhk_qc_order_delete') ?>",
                data: {
                    id:aData[10],
                },
                success: function(data) {
                    oTable.fnDeleteRow(nRow);
                    alert('Deleting success!');
                    App.unblockUI(el);
                },
                error: function(){
                    alert('Error on Process');
                    App.unblockUI(el);
                }
            });
        });

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

<div class="row" id="setup-order">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit" STYLE="FONT-SIZE: 18PX"> YÊU CẦU SẢN XUẤT</i>
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
                        <button id="order_table_new" class="btn green">
                            Thêm mới <i class="fa fa-plus"></i>
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
                <table class="table table-striped table-hover table-bordered" id="order_table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã số SP</th>
                        <th>SL yêu cầu</th>
                        <th>SL hoàn thành</th>
                        <th>SL còn lại</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày hoàn thành</th>
                        <th>Trạng thái hoàn thành</th>
                        <th>Ngày tạo</th>
                        <th>Người tạo</th>
                        <th>ID</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
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
                                <?php echo $item['soluongyeucau'] ?>
                            </td>
                            <td>
                                <?php echo $item['soluonghoanthanh'] ?>
                            </td>
                            <td>
                                <?php echo $item['soluongconlai'] ?>
                            </td>
                            <td>
                                <?php echo $item['ngaybatdau'] ?>
                            </td>
                            <td>
                                <?php echo $item['ngayhoanthanh'] ?>
                            </td>
                            <td>
                                <?php echo $item['trangthaihoanthanh'] ?>
                            </td>
                            <td>
                                <?php echo $item['datecreated'] ?>
                            </td>
                            <td>
                                <?php echo $item['usercreated'] ?>
                            </td>
                            <td>
                                <?php echo $item['id'] ?>
                            </td>
                            <td>
                                <a class="edit" href="javascript:;">
                                    Sửa
                                </a>
                            </td>
                            <td>
                                <a class="delete" href="javascript:;">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>