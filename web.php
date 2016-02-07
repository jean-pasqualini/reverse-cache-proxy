<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 07/02/16
 * Time: 12:08
 */

spl_autoload_register(function($class)
{
    $ds = DIRECTORY_SEPARATOR;

    $filename = __DIR__ . $ds . str_replace('\\', $ds, $class) . '.php';

    if(file_exists($filename))
    {
        require_once $filename;
    }
    else
    {
        throw new Exception('la classe ' . $class . 'n\'existe pas');
    }
});

$config = parse_ini_file(__DIR__.DIRECTORY_SEPARATOR.'config.ini');

use Http\Kernel\HttpProxyKernel;

$kernel = new HttpProxyKernel($config['proxy_url']);

$kernel = new \Http\Cache\HttpCache($kernel, new \Http\Cache\Store\HttpLocalStore(
    str_replace('__ROOT__', __DIR__, $config['cache_dir'])
));

$response = $kernel->handle($_SERVER["PATH_INFO"]);

$response->send();
