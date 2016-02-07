<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 07/02/16
 * Time: 12:14
 */

namespace Http\Kernel;

use Http\Response;

/**
 * Class HttpProxyKernel
 * @package Http\Kernel
 */
class HttpProxyKernel implements HttpKernelInterface {

    protected $proxyUrl;

    public function __construct($proxyUrl)
    {
        $this->proxyUrl = $proxyUrl;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function handle($url)
    {
        $content = file_get_contents($this->proxyUrl.$url);

        if($content) {
            return new Response($content, $http_response_header);
        } else {
            return new Response('gateway 404 error');
        }
    }
}