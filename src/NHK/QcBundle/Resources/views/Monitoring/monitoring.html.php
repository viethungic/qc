<!-- Extends Layouts -->
<?php $view->extend('NHKQcBundle:Layout:layout.html.php') ?>
<!-- Title Page -->
<?php $view['slots']->start('title') ?>
<?php echo BASE_TITLE; ?> | Monitoring
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

        function editRow(oTable, nRow, totalItemPerLine) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = aData[0];
            for (var i = 1; i <= totalItemPerLine; i++) {
                jqTds[i].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[i] + '">';
            }
            jqTds[i].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[i+1].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow, totalItemPerLine, row ) {
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(aData[0], nRow, 0, false);
            for (var i = 1; i <= totalItemPerLine; i++) {
                oTable.fnUpdate(jqInputs[i-1].value, nRow, i, false);
            }
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, i, false);
            oTable.fnUpdate('<a class="delete" href=""></a>', nRow, i+1, false);
            oTable.fnDraw();

            var items = $('#setup-monitoring').serializeArray();
            for (var i = 1; i <= totalItemPerLine; i++) {
                items.push({name:i, value:jqInputs[i-1].value});
            }
            items.push({name:"column", value:aData[0]});
            items.push({name:"row", value:row});

            var el = $("#setup-monitoring");
            App.blockUI({target: el, iconOnly: true});
            $.ajax({
                type: "POST",
                url: "<?php echo $view['router']->generate('nhk_qc_monitoring_edit') ?>",
                data: items,
                success: function(data) {
                    if (data == 'OK') {
                        alert('Editing success!');
                    } else if (data == 'Exist') {
                        alert('Machine exists at other position!');
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
            oTable.fnUpdate(jqInputs[8].value, nRow, 8, false);
            oTable.fnUpdate(jqInputs[9].value, nRow, 9, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 10, false);
            oTable.fnDraw();
        }

        <?php for ($i = 1; $i <= ceil(count($items)/$itemsPerLine); $i++) { ?>
        <?php if ($i == ceil(count($items)/$itemsPerLine)) $totalItemPerLine = count($items) - ($i-1)*$itemsPerLine; else $totalItemPerLine = $itemsPerLine; ?>

        var table<?php echo $i ?> = $('#monitoring_table_<?php echo $i ?>');

        var oTable<?php echo $i ?> = table<?php echo $i ?>.dataTable({
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
                'orderable': false,
                
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "bSort" : false,
            "order": [
                //[0, "asc"]
            ] // set first column as a default sort by asc
        });

        table<?php echo $i ?>.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable<?php echo $i ?>.fnDeleteRow(nEditing);
                nNew = false;
            } else {
                restoreRow(oTable<?php echo $i ?>, nEditing);
                nEditing = null;
            }
        });

        table<?php echo $i ?>.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable<?php echo $i ?>, nEditing);
                editRow(oTable<?php echo $i ?>, nRow, <?php echo $totalItemPerLine ?>);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable<?php echo $i ?>, nEditing, <?php echo $totalItemPerLine ?>, <?php echo $i ?>);
                nEditing = null;
                //alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable<?php echo $i ?>, nRow, <?php echo $totalItemPerLine ?>);
                nEditing = nRow;
            }
        });

        <?php } ?>

        var tableWrapper = $("#monitoring_table_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropndow

        var nEditing = null;
        var nNew = false;
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
        $(".col-sm-12").css("display","none");
    });
</script>
<?php $view['slots']->stop() ?>

<div class="row" id="setup-monitoring">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i><!--THONG SO SAN PHAM-->
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
            <div class="modal fade" id="small" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header blue">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Máy #</h4>
						</div>
						<div class="modal-body">
                            <table class="table table-hover">
								<thead>
								<tr>
									<th> Khuôn</th>
									<th>Nhân công</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>2525</td>
                                    <td>125</td>
								</tr>
                                </tbody>
                            </table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
            <div class="portlet-body">
                <?php $n=$j=$k=$h=0; for ($i = 1; $i <= ceil(count($items)/$itemsPerLine); $i++) { ?>
                <table class="table table-striped table-hover table-bordered" id="monitoring_table_<?php echo $i?>">
                    <thead>
                    <tr style="background-color: #ffb848;">
                        <th>
                            <!--                Sua-->
                        </th>
                        <?php while ($n < count($items)) {?>
                        <th>
                            <a class="btn " data-toggle="modal" href="#small">
								 <?php echo "No. ".$n?>
                                 <i class="fa fa-bell-o"></i>
            					<span class="badge">
            						 5
            					</span>
							</a>
                            
                        </th>
                        <?php $n++; if($n%$itemsPerLine == 0) break;}?>
                        <th>
                            <!--                Sua-->
                        </th>
                        <th>
                            <!--                Sua-->
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                M
                            </td>
                            <?php while ($j < count($items)) {?>
                            <td>
                                <?php echo $items[$j]['machineserialno'] ?>
                                
                            </td>
                            <?php $j++; if($j%$itemsPerLine == 0) break;}?>
                            <td>
                                <a class="edit" href="javascript:;">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a class="delete" href="javascript:;">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                MSK
                            </td>
                            <?php while ($k < count($items)) {?>
                            <td>
                                <?php echo $items[$k]['shapserialno'] ?>
                                <div id="<?php echo $items[$k]['shapserialno'] ?>">
                                
                                </div>
                            </td>
                            <?php $k++; if($k%$itemsPerLine == 0) break;}?>
                            <td>
                                <a class="edit" href="javascript:;">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a class="delete" href="javascript:;">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                MSCN
                            </td>
                            <?php while ($h < count($items)) {?>
                            <td>
                                <?php echo $items[$h]['workerno'] ?>
                            </td>
                            <?php $h++; if($h%$itemsPerLine == 0) break;}?>
                            <td>
                                <a class="edit" href="javascript:;">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a class="delete" href="javascript:;">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>