<?php use Symfony\Component\HttpKernel\Controller\ControllerReference;?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en">

<!--<![endif]-->

<!-- Head BEGIN -->

<head>
<meta charset="utf-8"/>
<title><?php $view['slots']->output('title','| Home Page'); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo BASE_URL?>/bundles/qc/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL?>/bundles/qc/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL?>/bundles/qc/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo BASE_URL?>/bundles/qc/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL?>/bundles/qc/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL?>/bundles/qc/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL?>/bundles/qc/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL?>/bundles/qc/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo BASE_URL?>/bundles/qc/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<!-- PAGE LEVEL STYLES -->
<?php $view['slots']->output('css',false) ?>
<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<!-- BASE URL -->

<script type="text/javascript">
	var BASE_URL = '<?php echo BASE_URL; ?>';
	var WEB_SOURCE = BASE_URL+'/bundles/qc';
</script>
</head>

<!-- Head END -->

<!-- Body BEGIN -->

<body class="page-header-fixed page-full-width">
<?php

    /** Header */

    $request = $app->getRequest();

    echo $view['actions']->render(

		new ControllerReference(

			'NHKQcBundle:Header:index', array ('request' => $request)

		)

	); 

    /** Main */
        echo '<!-- END HEADER -->
                <div class="clearfix">
                </div>';
     ?>
  
<div class="page-container">
	<!-- BEGIN EMPTY PAGE SIDEBAR -->
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
			<li>
				<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
				<form class="sidebar-search" action="extra_search.html" method="POST">
					<div class="form-container">
						<div class="input-box">
							<a href="javascript:;" class="remove">
							</a>
							<input type="text" placeholder="Search..."/>
							<input type="button" class="submit" value=" "/>
						</div>
					</div>
				</form>
				<!-- END RESPONSIVE QUICK SEARCH FORM -->
			</li>
			<li class="active">
				<a href="index.html">
					 Dashboard
					<span class="selected">
					</span>
				</a>
			</li>
			<li>
				<a href="#">
					 Mega
					<span class="arrow">
					</span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="#">
							 Layouts
							<span class="arrow">
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="#">
									 Promo Page
								</a>
							</li>
							<li>
								<a href="#">
									 Email Templates
								</a>
							</li>
							<li>
								<a href="#">
									 Sidebar Cloaded Page
								</a>
							</li>
							<li>
								<a href="#">
									 Blank Page
								</a>
							</li>
							<li>
								<a href="#">
									 Boxed Page
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							 UI Features
							<span class="arrow">
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="#">
									 General Components
								</a>
							</li>
							<li>
								<a href="#">
									 Buttons & Icons
								</a>
							</li>
							<li>
								<a href="#">
									 Extended Modals
								</a>
							</li>
							<li>
								<a href="#">
									 Datepaginator
								</a>
							</li>
							<li>
								<a href="#">
									 Tree View
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							 Form Stuff
							<span class="arrow">
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="#">
									 Form Controls
								</a>
							</li>
							<li>
								<a href="#">
									 Form Components
								</a>
							</li>
							<li>
								<a href="#">
									 Form Validation
								</a>
							</li>
							<li>
								<a href="#">
									 Multiple File Upload
								</a>
							</li>
							<li>
								<a href="#">
									 Dropzone File Upload
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">
					 Full Mega
					<span class="arrow">
					</span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="#">
							 Layouts
							<span class="arrow">
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="#">
									 Promo Page
								</a>
							</li>
							<li>
								<a href="#">
									 Email Templates
								</a>
							</li>
							<li>
								<a href="#">
									 Sidebar Cloaded Page
								</a>
							</li>
							<li>
								<a href="#">
									 Blank Page
								</a>
							</li>
							<li>
								<a href="#">
									 Boxed Page
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							 UI Features
							<span class="arrow">
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="#">
									 General Components
								</a>
							</li>
							<li>
								<a href="#">
									 Buttons & Icons
								</a>
							</li>
							<li>
								<a href="#">
									 Extended Modals
								</a>
							</li>
							<li>
								<a href="#">
									 Datepaginator
								</a>
							</li>
							<li>
								<a href="#">
									 Tree View
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							 Form Stuff
							<span class="arrow">
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="#">
									 Form Controls
								</a>
							</li>
							<li>
								<a href="#">
									 Form Components
								</a>
							</li>
							<li>
								<a href="#">
									 Form Validation
								</a>
							</li>
							<li>
								<a href="#">
									 Multiple File Upload
								</a>
							</li>
							<li>
								<a href="#">
									 Dropzone File Upload
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							 Accordions
							<span class="arrow">
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<div id="accordion2" class="panel-group mega-menu-responsive-content">
									<div class="panel panel-success">
										<div class="panel-heading">
											<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" class="collapsed">
												 Mega Menu Info #1
											</a>
											</h4>
										</div>
										<div id="collapseOne2" class="panel-collapse in">
											<div class="panel-body">
												 Metronic Mega Menu Works for fixed and responsive layout and has the facility to include (almost) any Bootstrap elements.
											</div>
										</div>
									</div>
									<div class="panel panel-danger">
										<div class="panel-heading">
											<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo2" class="collapsed">
												 Mega Menu Info #2
											</a>
											</h4>
										</div>
										<div id="collapseTwo2" class="panel-collapse collapse">
											<div class="panel-body">
												 Metronic Mega Menu Works for fixed and responsive layout and has the facility to include (almost) any Bootstrap elements.
											</div>
										</div>
									</div>
									<div class="panel panel-info">
										<div class="panel-heading">
											<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion2" href="#collapseThree2">
												 Mega Menu Info #3
											</a>
											</h4>
										</div>
										<div id="collapseThree2" class="panel-collapse collapse">
											<div class="panel-body">
												 Metronic Mega Menu Works for fixed and responsive layout and has the facility to include (almost) any Bootstrap elements.
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<a>
					 Classic
					<span class="arrow">
					</span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="#">
							 Section 1
						</a>
					</li>
					<li>
						<a href="#">
							 Section 2
						</a>
					</li>
					<li>
						<a href="#">
							 Section 3
						</a>
					</li>
					<li>
						<a href="#">
							 Section 4
						</a>
					</li>
					<li>
						<a href="#">
							 Section 5
						</a>
					</li>
					<li>
						<a href="javascript:;">
							 More options
							<span class="arrow">
							</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="#">
									 Second level link
								</a>
							</li>
							<li class="sub-menu">
								<a href="javascript:;">
									 More options
									<span class="arrow">
									</span>
								</a>
								<ul class="sub-menu">
									<li>
										<a href="index.html">
											 Third level link
										</a>
									</li>
									<li>
										<a href="index.html">
											 Third level link
										</a>
									</li>
									<li>
										<a href="index.html">
											 Third level link
										</a>
									</li>
									<li>
										<a href="index.html">
											 Third level link
										</a>
									</li>
									<li>
										<a href="index.html">
											 Third level link
										</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="index.html">
									 Second level link
								</a>
							</li>
							<li>
								<a href="index.html">
									 Second level link
								</a>
							</li>
							<li>
								<a href="index.html">
									 Second level link
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<a href="">
					 Link
				</a>
			</li>
		</ul>
	</div>
	<!-- END EMPTY PAGE SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
							 THEME COLOR
						</span>
						<ul>
							<li class="color-black current color-default" data-style="default">
							</li>
							<li class="color-blue" data-style="blue">
							</li>
							<li class="color-brown" data-style="brown">
							</li>
							<li class="color-purple" data-style="purple">
							</li>
							<li class="color-grey" data-style="grey">
							</li>
							<li class="color-white color-light" data-style="light">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
							 Layout
						</span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Header
						</span>
						<select class="header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar
						</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar Position
						</span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Footer
						</span>
						<select class="footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Horizontal Mega Menu 1 <small>horizontal mega menu layout</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
							<span>
								Actions
							</span>
							<i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a href="#">
										Action
									</a>
								</li>
								<li>
									<a href="#">
										Another action
									</a>
								</li>
								<li>
									<a href="#">
										Something else here
									</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">
										Separated link
									</a>
								</li>
							</ul>
						</li>
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">
								Page Layouts
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">
								Horizontal Mega Menu 1
							</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->   
     <?php
     $view['slots']->output('_content');
     ?>
     	</div>
	</div>
	<!-- END CONTENT -->
</div>
     <?php

    /** Footer */

    echo $view['actions']->render(

		new ControllerReference(

			'NHKQcBundle:Footer:index', array ('request' => $request)

		)

	);

?> 
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
  <script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/excanvas.min.js"></script>
  <script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/respond.min.js"></script>  
  <![endif]-->
<script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL?>/bundles/qc/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<?php $view['slots']->output('js',false) ?>
<script src="<?php echo BASE_URL?>/bundles/qc/assets/scripts/core/app.js"></script>
<script>
    jQuery(document).ready(function() {    
       App.init();
    });
  </script>
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>