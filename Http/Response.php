<?php
/**
 * Created by PhpStorm.
 * User: darkilliant
 * Date: 07/02/16
 * Time: 12:15
 */

namespace Http;

/**
 * Class Response
 * @package Http
 */
class Response {

    /**
     * @var string $content
     */
    protected $content;

    protected $headers;

    /**
     * @param $content
     */
    public function __construct($content, array $headers = array())
    {
        $this->headers = $headers;

        $this->content = $content;
    }

    public function addHeader($header)
    {
        $this->headers[] = $header;
    }

    /**
     * Affiche la réponse dans la sortie standard
     */
    public function send()
    {
        foreach($this->headers as $header)
        {
            header($header);
        }

        echo $this->content;
    }
}