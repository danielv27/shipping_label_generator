<?php

namespace App\Traits;

trait ScopeTrait
{
    public function determineScope(string $senderCountry, string $recipientCountry): string
    {
        $domesticCountry = 'NL';
        if ($senderCountry === $domesticCountry &&
            $recipientCountry === $domesticCountry) {
            return 'domestic';
        }
    
        return 'international';
    }
}
