<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 07/02/16
 * Time: 12:45
 */

namespace Http\Cache\Store;


use Http\Response;

class HttpLocalStore implements HttpStoreInterface {

    protected $cacheDir;

    public function __construct($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    protected function getFilenameByUrl($url)
    {
        return $this->cacheDir.DIRECTORY_SEPARATOR.md5($url);
    }

    /**
     * @param $url
     * @return Response
     */
    public function lookup($url)
    {
        $filename = $this->getFilenameByUrl($url);

        if(file_exists($filename))
        {
            return unserialize(file_get_contents($filename));
        }
        else
        {
            return null;
        }
    }

    public function write($url, Response $response)
    {
        $filename = $this->getFilenameByUrl($url);

        file_put_contents($filename, serialize($response));
    }

    public function purge($url)
    {
        // TODO: Implement purge() method.
    }
}