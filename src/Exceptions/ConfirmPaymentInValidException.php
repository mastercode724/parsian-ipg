<?php


namespace Mastercode724\ParsianIPG\Exceptions;

/**
 * Class ConfirmPaymentInValidException
 * @package Mastercode724\ParsianIPG\Exceptions
 */
class ConfirmPaymentInValidException extends \Exception
{


    /**
     * @var string
     */
    protected $message = "مقادیر ورودی confirm payment معتبر نمی باشد.";
}