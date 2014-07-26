<!-- Extends Layouts -->
<?php $view->extend('NHKQcBundle:Layout:layout.html.php') ?>
<!-- Title Page -->
<?php $view['slots']->start('title') ?>
    <?php echo BASE_TITLE; ?> | Home
<?php $view['slots']->stop() ?>

<!-- JS -->
<?php $view['slots']->start('js') ?>

<?php $view['slots']->stop() ?>

<!-- CSS -->
<?php $view['slots']->start('css') ?>
<style>

</style>
<?php $view['slots']->stop() ?>
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
			<!-- BEGIN PAGE CONTENT-->
			<div class="row margin-bottom-20">
				<div class="col-md-12">
					<p>
						 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
					</p>
					<p>
						 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
					</p>
					<p>
						 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Simple Table
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
							<table class="table table-hover">
							<thead>
							<tr>
								<th>
									 #
								</th>
								<th>
									 First Name
								</th>
								<th>
									 Last Name
								</th>
								<th class="hidden-480">
									 Username
								</th>
								<th>
									 Status
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									 1
								</td>
								<td>
									 Mark
								</td>
								<td>
									 Otto
								</td>
								<td class="hidden-480">
									 makr124
								</td>
								<td>
									<span class="label label-success">
										 Approved
									</span>
								</td>
							</tr>
							<tr>
								<td>
									 2
								</td>
								<td>
									 Jacob
								</td>
								<td>
									 Nilson
								</td>
								<td class="hidden-480">
									 jac123
								</td>
								<td>
									<span class="label label-info">
										 Pending
									</span>
								</td>
							</tr>
							<tr>
								<td>
									 3
								</td>
								<td>
									 Larry
								</td>
								<td>
									 Cooper
								</td>
								<td class="hidden-480">
									 lar
								</td>
								<td>
									<span class="label label-warning">
										 Suspended
									</span>
								</td>
							</tr>
							<tr>
								<td>
									 3
								</td>
								<td>
									 Sandy
								</td>
								<td>
									 Lim
								</td>
								<td class="hidden-480">
									 sanlim
								</td>
								<td>
									<span class="label label-danger">
										 Blocked
									</span>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
				<div class="col-md-6">
					<!-- BEGIN BORDERED TABLE PORTLET-->
					<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-coffee"></i>Bordered Table
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
							<table class="table table-bordered table-hover">
							<thead>
							<tr>
								<th>
									 #
								</th>
								<th>
									 First Name
								</th>
								<th>
									 Last Name
								</th>
								<th class="hidden-480">
									 Username
								</th>
								<th>
									 Status
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									 1
								</td>
								<td>
									 Mark
								</td>
								<td>
									 Otto
								</td>
								<td class="hidden-480">
									 makr124
								</td>
								<td>
									<span class="label label-success">
										 Approved
									</span>
								</td>
							</tr>
							<tr>
								<td>
									 2
								</td>
								<td>
									 Jacob
								</td>
								<td>
									 Nilson
								</td>
								<td class="hidden-480">
									 jac123
								</td>
								<td>
									<span class="label label-info">
										 Pending
									</span>
								</td>
							</tr>
							<tr>
								<td>
									 3
								</td>
								<td>
									 Larry
								</td>
								<td>
									 Cooper
								</td>
								<td class="hidden-480">
									 lar
								</td>
								<td>
									<span class="label label-warning">
										 Suspended
									</span>
								</td>
							</tr>
							<tr>
								<td>
									 3
								</td>
								<td>
									 Sandy
								</td>
								<td>
									 Lim
								</td>
								<td class="hidden-480">
									 sanlim
								</td>
								<td>
									<span class="label label-danger">
										 Blocked
									</span>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END BORDERED TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->