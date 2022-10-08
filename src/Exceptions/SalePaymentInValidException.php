<?php


namespace Mastercode724\ParsianIPG\Exceptions;

/**
 * Class SalePaymentInValidException
 * @package Mastercode724\ParsianIPG\Exceptions
 */
class SalePaymentInValidException extends \Exception
{


    /**
     * @var string
     */
    protected $message = "مقادیر ورودی sale payment معتبر نمی باشد.";
}