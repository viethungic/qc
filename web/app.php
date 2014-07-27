<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// Use APC for autoloading to improve performance.
// Change 'sf2' to a unique prefix in order to prevent cache key conflicts
// with other applications also using APC.
/*
$apcLoader = new ApcClassLoader('sf2', $loader);
$loader->unregister();
$apcLoader->register(true);
*/

require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

$kernel = new AppKernel('prod', true);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
/** Define some variables */

$baseUrl = $request->getScheme() . '://' .$request->getHttpHost() . $request->getBasePath();
$baseDir = __DIR__;
//define('BASE_URL',$baseUrl."/web");
define('BASE_URL',$baseUrl);
define('BASE_DIR',$baseDir);
define('BASE_TITLE','SELL PHONE, TABLET ONLINE');

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
