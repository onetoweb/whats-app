<?php

namespace Onetoweb\WhatsApp;

use DateTime;
use Stringable;

/**
 * Token.
 */
class Token implements Stringable
{
    /**
     * @param string $value
     * @param DateTime $expires
     */
    public function __construct(
        
        #[\SensitiveParameter]
        private string $value,
        private DateTime $expires
    ) {
        
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
    
    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
    
    /**
     * @return DateTime
     */
    public function getExpires(): DateTime
    {
        return $this->expires;
    }
    
    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return (new DateTime()) > $this->expires;
    }
}
