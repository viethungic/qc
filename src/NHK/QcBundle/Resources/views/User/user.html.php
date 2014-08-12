<!-- Extends Layouts -->
<?php $view->extend('NHKQcBundle:Layout:layout.html.php') ?>
<!-- Title Page -->
<?php $view['slots']->start('title') ?>
    <?php echo BASE_TITLE; ?> | User Manager
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
var htmlRoles = '<select multiple class="form-control">';
    <?php foreach($userRoles as $ur):?>
    htmlRoles =htmlRoles+ '<option value="<?php echo $ur->getId()?>"><?php echo $ur->getName()?></option>';
    <?php endforeach;?>
    htmlRoles =htmlRoles+ '</select>';
    //console.log(htmlRoles);
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
            //console.log(aData);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = aData[2];
            jqTds[3].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[4].innerHTML = '<a class="cancel" href="">Cancel</a>';
            $('select').select2().trigger('update');
        }

        function saveRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);
            var jqSelect = $('select',nRow);
            console.log(jqSelect[0]);
            var userRoles = new Array();
            var i=0;
            for (x=0;x<jqSelect[0].length;x++)
             {
                if(jqSelect[0][x].selected)
                {
                    userRoles[i] =jqSelect[0][x].value;
                    i++;
                }
             }
            
            console.log(userRoles);
            if(aData[5]=='add'){
                $.ajax({
                    type: "POST",
                    url: '<?php echo $view['router']->generate('nhk_qc_user_add',array(),true);?>',
                    data: { 
                        username:jqInputs[0].value , 
                        roles:JSON.stringify(userRoles) 
                    },
                    //dataType: "html",
                    success: function (res) {
                        App.stopPageLoading();
                        
                        //App.initAjax(); // initialize core stuff
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        
                        App.stopPageLoading();
                    }
                });
            }
            
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate('<select multiple="" class="form-control">'+jqSelect[0].innerHTML+'</select>', nRow, 2, false);
            
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 4, false);
            oTable.fnDraw();
            $('select').select2().trigger('update');
            
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

            var aiNew = oTable.fnAddData(['', '', htmlRoles, '', '','add']);
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
                //alert("Updated! Do not forget to do some ajax to sync with backend :)");
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



<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
                                <i class="fa fa-edit" STYLE="FONT-SIZE: 18PX"> QUẢN LÝ NGƯỜI DÙNG</i>
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
							<table class="table table-striped table-hover table-bordered" id="user_table">
							<thead>
							<tr>
								<th>
									 Tên đăng nhập
								</th>
								<th>
									 Họ tên
								</th>
								<th>
									 Email
								</th>
								<th>
									 Vai trò
								</th>
								<th>
									 Sửa
								</th>
								<th>
									 Xóa
								</th>
							</tr>
							</thead>
							<tbody>
                            <?php foreach($userList as $ul):
                                $ulRoles = $ul->getRoles();
                                $ulRoleArray = array();
                                foreach($ulRoles as $r){
                                    $ulRoleArray[count($ulRoleArray)] = $r->getId();
                                }
                                
                            ?>
							<tr>
								<td>
									 <?php echo $ul->getUsername();?>
								</td>
								<td>
                                    Nguyễn Văn T
								</td>
								<td>
                                    <?php echo $ul->getEmail();?>
								</td>

								<td class="center">
									 <select class="select2me form-control" multiple="">
                                     <?php 
                                     foreach($userRoles as $ur):
                                        if(in_array($ur->getId(),$ulRoleArray)):
                                     ?>
                                        <option selected="" value="<?php echo $ur->getId()?>"><?php echo $ur->getName(); ?></option>
                                     <?php 
                                        else:
                                     ?>
                                        <option value="<?php echo $ur->getId()?>"><?php echo $ur->getName(); ?></option>
                                    
                                     <?php 
                                        endif;
                                     endforeach;?>
                                     </select>
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
                            <?php endforeach;?>
						
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>