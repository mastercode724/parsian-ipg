<?php


namespace Mastercode724\ParsianIPG\Entities;


use Mastercode724\ParsianIPG\Utils;

/**
 * Class ConfirmPaymentResult
 * @package Mastercode724\ParsianIPG\Entities
 */
class ConfirmPaymentResult extends BaseResult
{


    /**
     * @var mixed
     */
    public $RRN;

    /**
     * @var mixed
     */
    public $CardNumberMasked;


    /**
     * ConfirmPaymentResult constructor.
     * @param array $result
     */
    public function __construct(array $result=[])
    {
        parent::__construct($result);
        $result = Utils::arrayToLower($result);
        $this->RRN = Utils::value($result, 'RRN');
        $this->CardNumberMasked = Utils::value($result, 'CardNumberMasked');
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
     * @return mixed
     */
    public function getCardNumberMasked()
    {
        return $this->CardNumberMasked;
    }

    /**
     * @param mixed $CardNumberMasked
     */
    public function setCardNumberMasked($CardNumberMasked)
    {
        $this->CardNumberMasked = $CardNumberMasked;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
        $str="";
        $str=$str." >>  ConfirmPayment Result >> " ;
        $str=$str." >>  Token :: ".$this->getToken();
        $str=$str." >>  Status :: ".$this->getStatus();
        if($this->getRRN()!=null) $str=$str." >>  RRN :: ".$this->getRRN();
        if($this->getCardNumberMasked()!=null) $str=$str." >>  CardNumberMasked :: ".$this->getCardNumberMasked();
        $str=$str." >>  Message :: ".$this->getMessage();
        return $str;
    }


}