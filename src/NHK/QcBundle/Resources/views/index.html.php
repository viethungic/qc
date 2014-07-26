<!-- Extends Layouts -->
<?php $view->extend('IzapSellPhoneBundle:Layout:layout.html.php') ?>
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
	<!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
<div class="row margin-bottom-40" style="margin-top: 20px">
	<!-- BEGIN SALE PRODUCT -->
	<div class="col-md-12 sale-product">
		<h2>Trade in your device for cash</h2>
        <h3 style="font-size: 14px;">Select your device and get an offer in just a few steps. It takes just a few minutes to trade in your device.</h3>
        <div class="fb-like" data-href="https://www.facebook.com/viethungcomputer?ref_type=bookmark" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
		<div class="bxslider-wrapper">
			<ul class="bxslider" data-slides-phone="2" data-slides-tablet="2" data-slides-desktop="4" data-slide-margin="15">

				<?php foreach($platformEntities as $platform):?>
                <li>
                <a href="<?php echo $view['router']->generate('izap_sell_phone_homepage_device',array('platform'=>$platform->getId()))?>">
				<div class="product-item">

						<div class="pi-img-wrapper">
							<img src="<?php echo BASE_URL.'/'.$platform->getImageIntro();?>" class=" img-responsive" alt="iOS Devices">

							<div>
								<!--<a href="<?php echo BASE_URL.'/'.$platform->getImageIntro();?>" class="platform btn btn-default fancybox-button"><?php echo $platform->getPlatformName();?></a>-->

							</div>
						</div>
                        <div class="platform btn btn-default" style="width: 100%;color: white;">Get Started</div>
						<div class="pi-price" style="width:100%;text-align: center;">
							SALE <?php echo $platform->getPlatformName();?>
						</div>
					<!--<a href="<?php echo $view['router']->generate('izap_sell_phone_homepage_device',array('platform'=>$platform->getId()))?>" class="btn btn-default add2cart">SELL <i class="<?php echo $platform->getIconIntro()?>"></i></a>-->


				</div>
                </a>
				</li>
                <?php endforeach;?>
			</ul>
		</div>
	</div>
	<!-- END SALE PRODUCT -->
</div>		