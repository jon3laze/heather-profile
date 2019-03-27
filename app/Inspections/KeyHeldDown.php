<?php

namespace App\Inspections;

use Exception;

/**
 * Class description.
 *
 * @author    Jon Ouellette
 */
class KeyHeldDown
{
    public function detect($body)
    {
        if (preg_match('/(.)\\1{4,}/', $body)) {
            throw new Exception('Your comment contains spam.');
        }
    }
}
