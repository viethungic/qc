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
<title>Metronic | Page Layouts - Horizontal Mega Menu 1</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="bundles/qc/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="bundles/qc/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="bundles/qc/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="bundles/qc/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="bundles/qc/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="bundles/qc/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="bundles/qc/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="bundles/qc/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="bundles/qc/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<!-- Head END -->

<!-- Body BEGIN -->

<body>

<!-- Facebook Like Button Plugin -->

<!--

<div id="fb-root"></div>

<script>

(function (d, s, id) {

    var js, fjs = d.getElementsByTagName(s)[0];

    if (d.getElementById(id)) return;

    js = d.createElement(s);

    js.id = id;

    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";

    fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));



</script>

<!-- End Facebook Like Button Plugin -->

<?php

    /** Header */

    $request = $app->getRequest();

    echo $view['actions']->render(

		new ControllerReference(

			'NHKQcBundle:Header:index', array ('request' => $request)

		)

	); 

    ///** Slider */
//
//    if($request->get('_route') == 'izap_sell_phone_homepage'){
//
//        echo $view['actions']->render(
//
//    		new ControllerReference(
//
//    			'NHKQcBundle:Slider:index', array ('request' => $request)
//
//    		)
//
//    	);
//
//    }

    

    /** Main */
        echo '<!-- END HEADER -->
<div class="clearfix">
</div>';
        echo '<div class="container">';

        //if($request->get('_route') != 'izap_sell_phone_homepage'){
//
//            /** Bread Crumb 
//
//            echo $view['actions']->render(
//
//        		new ControllerReference(
//
//        			'NHKQcBundle:BreadCrumb:index', array ('request' => $request)
//
//        		)
//
//        	);*/
//
//        }

            $view['slots']->output('_content');

        echo '</div>';
   

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
  <script src="bundles/qc/assets/plugins/excanvas.min.js"></script>
  <script src="bundles/qc/assets/plugins/respond.min.js"></script>  
  <![endif]-->
<script src="bundles/qc/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="bundles/qc/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="bundles/qc/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="bundles/qc/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="bundles/qc/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="bundles/qc/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="bundles/qc/assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="bundles/qc/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="bundles/qc/assets/scripts/core/app.js"></script>
<script>
    jQuery(document).ready(function() {    
       App.init();
    });
  </script>
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>