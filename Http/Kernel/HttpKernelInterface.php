<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 07/02/16
 * Time: 12:13
 */

namespace Http\Kernel;

/**
 * Interface HttpKernelInterface
 * @package Http\Kernel
 */
interface HttpKernelInterface {

    /**
     * @param $url
     * @return mixed
     */
    public function handle($url);
}