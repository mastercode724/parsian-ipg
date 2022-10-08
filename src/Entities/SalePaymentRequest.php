<?php


namespace Mastercode724\ParsianIPG\Entities;


/**
 * Class SalePaymentRequest
 * @package Mastercode724\ParsianIPG\Entities
 */
class SalePaymentRequest
{
    /**
     * @var string
     */
    public  $pin;

    /**
     * @var int|float|string
     */
    public $amount;

    /**
     * @var int|float|string
     */
    public $orderId;

    /**
     * @var string
     */
    public $callbackUrl;

    /**
     * @var string|null
     */
    public $additionalData;

    /**
     * @var string|null
     */
    public $originator;

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
     * @return float|int|string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float|int|string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float|int|string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param float|int|string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl(string $callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return string|null
     */
    public function getAdditionalData(): string
    {
        return $this->additionalData;
    }

    /**
     * @param string|null $additionalData
     */
    public function setAdditionalData(string $additionalData)
    {
        $this->additionalData = $additionalData;
    }

    /**
     * @return string|null
     */
    public function getOriginator(): string
    {
        return $this->originator;
    }

    /**
     * @param string|null $originator
     */
    public function setOriginator(string $originator)
    {
        $this->originator = $originator;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
        $str="";
        $str=$str." >>  SalePayment Request >> " ;
        $str=$str." >>  Amount :: ".$this->getAmount();
        $str=$str." >>  OrderId :: ".$this->getOrderId();
        $str=$str." >>  CallbackUrl :: ".$this->getCallbackUrl();
        return $str;
    }
}