<?php


namespace Mastercode724\ParsianIPG\Entities;


/**
 * Class ReversalResult
 * @package Mastercode724\ParsianIPG\Entities
 */
class ReversalResult extends BaseResult
{

    /**
     * ReversalResult constructor.
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
        $str=$str." >>  Reversal  Result >> " ;
        $str=$str." >>  Token :: ".$this->getToken();
        $str=$str." >>  Status :: ".$this->getStatus();
        $str=$str." >>  Message :: ".$this->getMessage();
        return $str;
    }
}