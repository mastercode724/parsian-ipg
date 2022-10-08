<?php


namespace Mastercode724\ParsianIPG\Entities;


use Mastercode724\ParsianIPG\Utils;

/**
 * Class SalePaymentResult
 * @package Mastercode724\ParsianIPG\Entities
 */
class SalePaymentResult extends BaseResult
{

    /**
     * SalePaymentResult constructor.
     * @param array $result
     */
    public function __construct(array $result=[])
    {
        parent::__construct($result);
    }


    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
        $str="";
        $str=$str." >>  SalePayment Result >> " ;
        $str=$str." >>  Token :: ".$this->getToken();
        $str=$str." >>  Status :: ".$this->getStatus();
        $str=$str." >>  Message :: ".$this->getMessage();
        return $str;
    }

}