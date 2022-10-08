<?php


namespace Mastercode724\ParsianIPG\Entities;

use Mastercode724\ParsianIPG\Utils;

/**
 * Class BaseResult
 * @package Mastercode724\ParsianIPG\Entities
 */
abstract class BaseResult
{

    /**
     * @var mixed
     */
    public $Status;

    /**
     * @var mixed
     */
    public $Token;

    /**
     * @var mixed
     */
    public $Message;


    /**
     * SalePaymentResult constructor.
     * @param array $result
     */
    public function __construct(array $result)
    {
        $result = Utils::arrayToLower($result);
        $this->Status = Utils::value($result, 'Status');
        $this->Token = Utils::value($result, 'Token' );
        $this->Message = Utils::value($result, 'Message');
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->Token;
    }

    /**
     * @param mixed $Token
     */
    public function setToken($Token)
    {
        $this->Token = $Token;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->Message;
    }

    /**
     * @param mixed $Message
     */
    public function setMessage($Message)
    {
        $this->Message = $Message;
    }




}