<?php


namespace Mastercode724\ParsianIPG\Exceptions;


use Throwable;

/**
 * Class NuSoapException
 * @package Mastercode724\ParsianIPG\Exceptions
 */
class NuSoapException extends \Exception
{


    /**
     * @var string
     */
    protected $message = "خطا در فراخوانی سرویس بانک";

    /**
     * NuSoapException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


}