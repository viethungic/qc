<!-- Extends Layouts -->
<?php $view->extend('NHKQcBundle:Layout:layout.html.php') ?>
<!-- Title Page -->
<?php $view['slots']->start('title') ?>
<?php echo BASE_TITLE; ?> | Set up data
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
                jqTds[1].innerHTML = aData[1];
                jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
                jqTds[3].innerHTML = aData[3];
                jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
                jqTds[5].innerHTML = aData[5];
                jqTds[6].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[6] + '">';
                jqTds[7].innerHTML = aData[7];
                jqTds[8].innerHTML = '<a class="edit" href="">Save</a>';
                jqTds[9].innerHTML = '<a class="cancel" href="">Cancel</a>';
            }

            function saveRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(aData[0], nRow, 0, false);
                oTable.fnUpdate(aData[1], nRow, 1, false);
                oTable.fnUpdate(jqInputs[0].value, nRow, 2, false);
                oTable.fnUpdate(aData[3], nRow, 3, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 4, false);
                oTable.fnUpdate(aData[5], nRow, 5, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 6, false);
                oTable.fnUpdate(aData[7], nRow, 7, false);
                oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 8, false);
                oTable.fnUpdate('<a class="delete" href="">Xóa</a>', nRow, 9, false);
                oTable.fnDraw();

                var el = $("#setup-release");
                App.blockUI({target: el, iconOnly: true});
                $.ajax({
                    type: "POST",
                    url: "<?php echo $view['router']->generate('nhk_qc_result_edit') ?>",
                    data: {
                        gionhan:jqInputs[0].value,
                        giobaocao:jqInputs[1].value,
                        ketqua:jqInputs[2].value,
                        id:aData[7],
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
                oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 8, false);
                oTable.fnDraw();
            }

            var table = $('#shape_release');

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

            var tableWrapper = $("#shape_release_wrapper");

            tableWrapper.find(".dataTables_length select").select2({
                showSearchInput: false //hide search box with special css class
            }); // initialize select2 dropdown

            var nEditing = null;
            var nNew = false;

            table.on('click', '.cancel', function (e) {
                e.preventDefault();
                $('.cancel-col').css('display','none');

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
                $('.cancel-col').css('display','');

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
                    $('.cancel-col').css('display','none');
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
var TableEditable2 = function () {

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
            jqTds[16].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[17].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 16, false);
            oTable.fnUpdate('<a class="delete" href=""></a>', nRow, 17, false);
            oTable.fnDraw();

            var el = $("#setup-sx");
            App.blockUI({target: el, iconOnly: true});
            $.ajax({
                type: "POST",
                url: "<?php echo $view['router']->generate('nhk_qc_result_edit_qc') ?>",
                data: {
                    sttcaykeo:jqInputs[0].value,
                    id:aData[15],
                },
                success: function(data) {
                    //                        $("#confirm-order-data").html(data);
                    alert('Editing success!');
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
            oTable.fnUpdate('<a class="edit" href="">Sửa</a>', nRow, 16, false);
            oTable.fnDraw();
        }

        var table = $('#sx_table');

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

        var tableWrapper = $("#sx_table_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            $('.cancel-col').css('display','none');

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
            $('.cancel-col').css('display','');

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
                $('.cancel-col').css('display','none');
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
        TableEditable2.init();
    });
</script>
<?php $view['slots']->stop() ?>

<div class="row" id="setup-release">
<div class="col-md-12">
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-edit" STYLE="FONT-SIZE: 18PX"> KẾT QUẢ LÒ ĐẦU LÊN KHUÔN</i>
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
        </div>
        <table class="table table-hover table-bordered" id="shape_release">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã số Máy</th>
                <th>Mã số SP</th>
                <th>Mã số CN</th>
                <th>Giờ nhận</th>
                <th>Giờ báo cáo</th>
                <th>Kết quả</th>
                <th>ID</th>
                <th>Sửa</th>
                <th style="display: none" class="cancel-col">
                </th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; foreach($items as $item): 
                if(($i%2)==0) $trCls = 'active'; else $trCls = 'success'; ?>
            <tr class="<?php echo $trCls;?>">
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
                <td>
                    <?php echo $item['gionhan'] ?>
                </td>
                <td>
                    <?php echo $item['giobaocao'] ?>
                </td>
                <td>
                    <?php echo $item['ketqua'] ?>
                </td>
                <td>
                    <?php echo $item['id'] ?>
                </td>
                <td>
                    <a class="edit" href="javascript:;">
                        Sửa
                    </a>
                </td>
                <td style="display: none" class="cancel-col">
                    <a class="delete" href="javascript:;">
    
                    </a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<div class="row" id="setup-sx">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit" STYLE="FONT-SIZE: 18PX"> KẾT QUẢ SẢN XUẤT</i>
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
                </div>
                <table class="table table-striped table-hover table-bordered" id="sx_table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>STT Cây keo</th>
                        <th>Mã số SP</th>
                        <th>Mã số Máy</th>
                        <th>Mã số CN</th>
                        <th>Chánh phẩm</th>
                        <th>Phế phẩm 1</th>
                        <th>Phế phẩm 2</th>
                        <th>Phế phẩm 3</th>
                        <th>Phế phẩm 4</th>
                        <th>Phế phẩm 5</th>
                        <th>Phế phẩm 6</th>
                        <th>Phế phẩm 7</th>
                        <th>Phế phẩm 8</th>
                        <th>Tỷ lệ phế phẩm</th>
                        <th>ID</th>
                        <th>Sửa</th>
                        <th style="display: none" class="cancel-col">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($items as $item):  if(($i%2)==0) $trCls = 'warning'; else $trCls = 'danger'; ?>
                        <tr class="<?php echo $trCls ?>">
                            <td>
                                <?php echo $item['id'] ?>
                            </td>
                            <td>
                                <?php echo $item['sttcaykeo'] ?>
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
                            <td>
                                <?php echo $item['tongchanhpham'] ?>
                            </td>
                            <td>
                                <?php echo $item['phepham1'] ?>
                            </td>
                            <td>
                                <?php echo $item['phepham2'] ?>
                            </td>
                            <td>
                                <?php echo $item['phepham3'] ?>
                            </td>
                            <td>
                                <?php echo $item['phepham4'] ?>
                            </td>
                            <td>
                                <?php echo $item['phepham5'] ?>
                            </td>
                            <td>
                                <?php echo $item['phepham6'] ?>
                            </td>
                            <td>
                                <?php echo $item['phepham7'] ?>
                            </td>
                            <td>
                                <?php echo $item['phepham8'] ?>
                            </td>
                            <td>
                                <?php echo $item['tilephepham'] ?>
                            </td>
                            <td>
                                <?php echo $item['id'] ?>
                            </td>
                            <td>
                                <a class="edit" href="javascript:;">
                                    Sửa
                                </a>
                            </td>
                            <td style="display: none" class="cancel-col">
                                <a class="delete" href="javascript:;">
                                </a>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>