<?php


namespace Mastercode724\ParsianIPG\Entities;


/**
 * Class ConfirmPaymentRequest
 * @package Mastercode724\ParsianIPG\Entities
 */
class ConfirmPaymentRequest
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
     * @var int
     */
    public $status;

    /**
     * @var mixed
     */
    public $RRN;

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
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getRRN()
    {
        return $this->RRN;
    }

    /**
     * @param mixed $RRN
     */
    public function setRRN($RRN)
    {
        $this->RRN = $RRN;
    }




    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
        $str="";
        $str=$str." >>  ConfirmPayment Request >> " ;
        $str=$str." >>  Token :: ".$this->getToken();
        $str=$str." >>  Status :: ".$this->getStatus();
        $str=$str." >>  RRN :: ".$this->getRRN();
        return $str;
    }
}