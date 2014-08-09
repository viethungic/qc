<!-- BEGIN HORIZANTAL MENU -->
		<div class="hor-menu hidden-sm hidden-xs">
        
        <?php echo $menu; ?>
        
			<ul class="nav navbar-nav" style="display: none;">
				<li class="classic-menu-dropdown active">
					<a href="index.html">
						 Dashboard
						<span class="selected">
						</span>
					</a>
				</li>
				
				
				<li class="classic-menu-dropdown">
					<a data-toggle="dropdown" data-hover="dropdown" data-close-others="true" href="">
						 Classic <i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
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
						<li class="dropdown-submenu">
							<a href="javascript:;">
								 More options
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">
										 Second level link
									</a>
								</li>
								<li class="dropdown-submenu">
									<a href="javascript:;">
										 More options
									</a>
									<ul class="dropdown-menu">
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
				<li>
					<span class="hor-menu-search-form-toggler">
						 &nbsp;
					</span>
					<div class="search-form">
						<form class="form-search">
							<div class="input-group">
								<input type="text" placeholder="Search..." class="form-control">
								<div class="input-group-btn">
									<button type="button" class="btn"></button>
								</div>
							</div>
						</form>
					</div>
				</li>
			</ul>
		</div>
		<!-- END HORIZANTAL MENU -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="<?php echo BASE_URL?>/bundles/qc/assets/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->