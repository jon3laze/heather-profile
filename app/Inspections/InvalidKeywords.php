<?php

namespace App\Inspections;

use Exception;

/**
 * Class description.
 *
 * @author    Jon Ouellette
 */
class InvalidKeywords
{
    protected $keywords = [
        'yahoo customer support'
    ];

    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Your comment contains spam.');
            }
        }
    }
}
