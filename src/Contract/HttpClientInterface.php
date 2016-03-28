<?php namespace Devsi\PhpVoat\Contract;

/**
 * A contract for Http Client methods
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
interface HttpClientInterface
{
    /**
     * @param string $uri
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($uri = null, array $options = []);
}