<?php

namespace Payone\Tests\Integration\Mock;

/**
 * Class SdkRestApi
 */
class SdkRestApi
{
    public static $payload;

    /**
     * @param $key
     * @param string $default
     *
     * @return mixed|string
     */
    public static function getParam($key, $default = '')
    {
        if (is_object(self::$payload)) {
            if (!property_exists(self::$payload, $key)) {
                return $default;
            }

            return self::$payload->{$key};
        }

        return isset(self::$payload[$key]) ? self::$payload[$key] : $default;
    }

    /**
     * @param \stdClass $payload
     */
    public static function setPayload($payload)
    {
        self::$payload = $payload;
    }

    /**
     * Getter for Payload
     *
     * @return mixed
     */
    public static function getPayload()
    {
        return self::$payload;
    }
}
