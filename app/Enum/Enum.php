<?php


namespace App\Enum;

use Exception;
use ReflectionClass;

/**
 * Author: Farai Zihove
 * Mobile: +263778234258
 * Email: zihovem@gmail.com
 * Date: 17/7/2023
 * Time: 18:41
 */
class Enum
{
    final public function __construct($value = '')
    {
        $c = new ReflectionClass($this);

        if (empty($value)) {
            $this->value = array_values($c->getConstants());
            return;
        }

        if (!in_array($value, $c->getConstants())) {
            throw new Exception("Illegal enum value used: $value");
        }
        $this->value = $value;
    }

    final public function __toString()
    {
        return $this->value;
    }
}
