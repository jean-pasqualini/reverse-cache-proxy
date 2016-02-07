<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 07/02/16
 * Time: 12:43
 */

namespace Http\Cache;


use Http\Cache\Store\HttpStoreInterface;
use Http\Kernel\HttpKernelInterface;
use Http\Response;

class HttpCache implements HttpKernelInterface {

    protected $kernel;

    protected $store;

    public function __construct(HttpKernelInterface $kernel, HttpStoreInterface $store)
    {
        $this->kernel = $kernel;

        $this->store = $store;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function handle($url)
    {
        $responseCached = $this->store->lookup($url);

        if ($responseCached) {
            $responseCached->addHeader('X-Cache : HIT');

            return $responseCached;
        }
        else
        {
            $response = $this->kernel->handle($url);

            $this->store->write($url, $response);

            $response->addHeader('X-Cache : MISS');

            return $response;
        }
    }
}