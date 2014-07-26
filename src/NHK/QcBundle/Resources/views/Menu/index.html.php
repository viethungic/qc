<div class="collapse navbar-collapse mega-menu">
	<ul class="nav navbar-nav">
        <?php foreach($platforms as $platform):?>
		<li class="dropdown">
            <a href="<?php echo $view['router']->generate('izap_sell_phone_homepage_device',array('platform'=>$platform->getId()))?>">
                Sale Your <?php echo $platform->getPlatformName();?> <i class="fa fa-angle-down"></i>
            </a>
		</li>
        <?php endforeach;?>
		<li><a onclick="checkMobile();" id="installapp" class="" style=":hover{color: white !important; background: #5BC0DE !important;}" href="itms-services://?action=download-manifest&url=https://phi-ncctest.greystonemobile.com/IVERIFY_Test.plist">Install App</a></li>
		<!-- BEGIN TOP SEARCH -->
		<li class="menu-search">
		<span class="sep"></span>
		<i class="fa fa-search search-btn"></i>
		<div class="search-box">
			<form action="#">
				<div class="input-group">
					<input type="text" placeholder="Search" class="form-control">
					<span class="input-group-btn">
					<button class="btn btn-primary" type="submit">Search</button>
					</span>
				</div>
			</form>
		</div>
		</li>
		<!-- END TOP SEARCH -->
	</ul>
</div>