<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 07/02/16
 * Time: 12:44
 */

namespace Http\Cache\Store;


use Http\Response;

interface HttpStoreInterface {

    /**
     * @param $url
     * @return Response
     */
    public function lookup($url);

    public function write($url, Response $response);

    public function purge($url);
}