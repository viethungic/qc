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
                jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<a class="edit" href="">Save</a>';
                jqTds[5].innerHTML = '<a class="cancel" href="">Cancel</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
                oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 5, false);
                oTable.fnDraw();

                var el = $("#setup-machine");
                App.blockUI({target: el, iconOnly: true});
                $.ajax({
                    type: "POST",
                    url: "<?php echo $view['router']->generate('nhk_qc_set_up_add') ?>",
                    data: {
                        shapserialno:jqInputs[0].value,
                    },
                    success: function(data) {
//                        $("#confirm-order-data").html(data);
                        alert('success');
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
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
                oTable.fnDraw();
            }

            var table = $('#user_table');

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

            var tableWrapper = $("#user_table_wrapper");

            tableWrapper.find(".dataTables_length select").select2({
                showSearchInput: false //hide search box with special css class
            }); // initialize select2 dropdown

            var nEditing = null;
            var nNew = false;

            $('#user_table_new').click(function (e) {
                e.preventDefault();

                if (nNew && nEditing) {
                    if (confirm("Previose row not saved. Do you want to save it ?")) {
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

                var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
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

                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
                alert("Deleted! Do not forget to do some ajax to sync with backend :)");
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

<div class="row" id="setup-machine">
<div class="col-md-12">
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
    <div class="caption">
        <i class="fa fa-edit"></i>THONG SO SAN PHAM
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
            <button id="user_table_new" class="btn green">
                Add New <i class="fa fa-plus"></i>
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
    <table class="table table-striped table-hover table-bordered" id="user_table">
        <thead>
        <tr>
            <th>
                Ma So SP
            </th>
            <th>
                Cong Thuc
            </th>
            <th>
                So Bo
            </th>
            <th>
                So CAV
            </th>
            <th>
                Cuong Do Lao Dong
            </th>
            <th>
                Trong Luong Phoi
            </th>
            <th>
                KH giao keo
            </th>
            <th>
                DVT
            </th>
            <th>
                Ti Le CP
            </th>
            <th>
                Sua
            </th>
            <th>
                Xoa
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($shapes as $shape): ?>
        <tr>
            <td>
                <?php echo $shape['shapserialno'] ?>
            </td>
            <td>
                <?php echo $shape['congthuc'] ?>
            </td>
            <td>
                <?php echo $shape['sobo'] ?>
            </td>
            <td class="center">
                <?php echo $shape['socav'] ?>
            </td>
            <td>
                <?php echo $shape['cuongdolaodong'] ?>
            </td>
            <td>
                <?php echo $shape['trongluongphoi'] ?>
            </td>
            <td>
                <?php echo $shape['kehoachgiaokeo'] ?>
            </td>
            <td class="center">
                <?php echo $shape['donvitinh'] ?>
            </td>
            <td class="center">
                <?php echo $shape['tilechophep'] ?>
            </td>
            <td>
                <a class="edit" href="javascript:;">
                    Edit
                </a>
            </td>
            <td>
                <a class="delete" href="javascript:;">
                    Delete
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
<div class="row" id="setup-machine">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i>THONG SO QC
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
                        <button id="user_table_new" class="btn green">
                            Add New <i class="fa fa-plus"></i>
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
                <table class="table table-striped table-hover table-bordered" id="user_table">
                    <thead>
                    <tr>
                        <th>
                            Ma So SP
                        </th>
                        <th>
                            Cong Thuc
                        </th>
                        <th>
                            So Bo
                        </th>
                        <th>
                            So CAV
                        </th>
                        <th>
                            Cuong Do Lao Dong
                        </th>
                        <th>
                            Trong Luong Phoi
                        </th>
                        <th>
                            KH giao keo
                        </th>
                        <th>
                            DVT
                        </th>
                        <th>
                            Ti Le CP
                        </th>
                        <th>
                            Sua
                        </th>
                        <th>
                            Xoa
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($shapes as $shape): ?>
                        <tr>
                            <td>
                                <?php echo $shape['shapserialno'] ?>
                            </td>
                            <td>
                                <?php echo $shape['congthuc'] ?>
                            </td>
                            <td>
                                <?php echo $shape['sobo'] ?>
                            </td>
                            <td class="center">
                                <?php echo $shape['socav'] ?>
                            </td>
                            <td>
                                <?php echo $shape['cuongdolaodong'] ?>
                            </td>
                            <td>
                                <?php echo $shape['trongluongphoi'] ?>
                            </td>
                            <td>
                                <?php echo $shape['kehoachgiaokeo'] ?>
                            </td>
                            <td class="center">
                                <?php echo $shape['donvitinh'] ?>
                            </td>
                            <td class="center">
                                <?php echo $shape['tilechophep'] ?>
                            </td>
                            <td>
                                <a class="edit" href="javascript:;">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a class="delete" href="javascript:;">
                                    Delete
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