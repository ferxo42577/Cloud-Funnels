<?php

/**
 * Request.php
 * php version 7.2.0
 *
 * @category Trait
 * @package  Xendit\ApiOperations
 * @author   Ellen <ellen@xendit.co>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://api.xendit.co
 */

namespace Xendit\ApiOperations;
require dirname(__DIR__)."/ApiRequestor.php";
require dirname(__DIR__)."/Exceptions/InvalidArgumentException.php";

use Xendit\Exceptions\InvalidArgumentException;

/**
 * Trait Request
 *
 * @category Trait
 * @package  Xendit\ApiOperations
 * @author   Ellen <ellen@xendit.co>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://api.xendit.co
 */
trait Request
{
    /**
     * Parameters validation
     *
     * @param array $params         user's parameters
     * @param array $requiredParams required parameters
     *
     * @return void
     */
    protected static function validateParams($params = [], $requiredParams = [])
    {
        $currParams = array_diff_key(array_flip($requiredParams), $params);
        if ($params && !is_array($params)) {
            $message = "You must pass an array as params.";
            throw new InvalidArgumentException($message);
        }
        if (count($currParams) > 0) {
            $message = "You must pass required parameters on your params. "
            . "Check https://xendit.github.io/apireference/ for more information.";
            throw new InvalidArgumentException($message);
        }
    }

    /**
     * Send request to Api Requestor
     *
     * @param $method string
     * @param $url    string ext url to the API
     * @param $params array parameters
     *
     * @return array
     * @throws \Xendit\Exceptions\ApiException
     */
    protected static function _request($method,
        $url,
        $params = []
    ) {
        $headers = [];

        if (array_key_exists('for-user-id', $params)) {
            $headers['for-user-id'] = $params['for-user-id'];
        }

        if (array_key_exists('X-IDEMPOTENCY-KEY', $params)) {
            $headers['X-IDEMPOTENCY-KEY'] = $params['X-IDEMPOTENCY-KEY'];
        }

        $requestor = new \Xendit\ApiRequestor();
        return $requestor->request($method, $url, $params, $headers);
    }
}
