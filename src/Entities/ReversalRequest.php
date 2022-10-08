<?php


namespace Mastercode724\ParsianIPG\Entities;


/**
 * Class ReversalRequest
 * @package Mastercode724\ParsianIPG\Entities
 */
class ReversalRequest
{

    /**
     * @var string
     */
    public $pin;

    /**
     * @var int
     */
    public $token;

    /**
     * @return string
     */
    public function getPin(): string
    {
        return $this->pin;
    }

    /**
     * @param string $pin
     */
    public function setPin(string $pin)
    {
        $this->pin = $pin;
    }

    /**
     * @return int
     */
    public function getToken(): int
    {
        return $this->token;
    }

    /**
     * @param int $token
     */
    public function setToken(int $token)
    {
        $this->token = $token;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
        $str="";
        $str=$str." >>  Reversal  Request >> " ;
        $str=$str." >>  Token :: ".$this->getToken();
        return $str;
    }

}