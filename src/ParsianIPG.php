<?php


namespace Mastercode724\ParsianIPG;

use Mastercode724\ParsianIPG\Entities\ConfirmPaymentResult;
use Mastercode724\ParsianIPG\Entities\ReversalResult;
use Mastercode724\ParsianIPG\Entities\SalePaymentResult;
use Mastercode724\ParsianIPG\Exceptions\RedirectException;

/**
 * Class ParsianIPG
 * @package Mastercode724\ParsianIPG
 */
class ParsianIPG
{

    /**
     * @var string
     */
    public $pin;


    /**
     * ParsianIPG constructor.
     * @param string $pin
     */
    public function __construct(string $pin="")
    {
        $this->pin=$pin;
    }



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
     * @param $orderId
     * @param $amount
     * @param string $callbackUrl
     * @param string $additionalData
     * @param string $originator
     * @param bool $isLog
     * @param string $addressLogger
     * @return SalePaymentResult|null
     */
    public function salePayment($orderId, $amount,string $callbackUrl,
                                string $additionalData="",string $originator="",
                                bool $isLog=false,string $addressLogger="")
    {
        $salePayment=new SalePayment();
        if($isLog){
            $salePayment->createLogger($addressLogger);
        }
        $salePaymentResult=$salePayment->payment($this->getPin(),$orderId,$amount,$callbackUrl,$additionalData,$originator);
        return $salePaymentResult;
    }


    /**
     * @param $salePaymentResult
     * @return bool
     */
    public function isReadyToRedirect($salePaymentResult) {
        $ready=false;
        if( $salePaymentResult instanceof SalePaymentResult){
            $status=$salePaymentResult->getStatus();
            $Token =  $salePaymentResult->getToken();
            if((!is_null($status))&&(!is_null($Token))) {
                if (($status == 0) && ($Token > 0)) {
                    $ready = true;
                }
            }
        }
        return $ready;
    }

    /**
     * @param $salePaymentResult
     * @throws RedirectException
     */
    public function redirect($salePaymentResult) {
        if( $this->isReadyToRedirect($salePaymentResult)){
            header('LOCATION: '.ParsianRequest::$gate_url . $salePaymentResult->getToken());
            exit;
        }
        throw new RedirectException();
    }

    /**
     * @param bool $isLog
     * @param string $addressLogger
     * @return Entities\ConfirmPaymentResult|null
     */
    public function confirmPayment(bool $isLog=false,string $addressLogger="")
    {
        $confirmPayment=new ConfirmPayment();
        if($isLog){
            $confirmPayment->createLogger($addressLogger);
        }
        $confirmPaymentResult=$confirmPayment->confirm($this->getPin());
        return $confirmPaymentResult;
    }

    /**
     * @param $confirmPaymentResult
     * @return bool
     */
    public function isReadyConfirm($confirmPaymentResult) {
        $ready=false;
        if( $confirmPaymentResult instanceof ConfirmPaymentResult){
            if(($confirmPaymentResult->getStatus() == 0)){
                $ready=true;
            }
        }
        return $ready;
    }

    /**
     * @param int $token
     * @param bool $isLog
     * @param string $addressLogger
     * @return Entities\ReversalResult|null
     */
    public function reversal(int $token,bool $isLog=false,string $addressLogger="")
    {
        $reverse=new Reverse();
        if($isLog){
            $reverse->createLogger($addressLogger);
        }
        $reversalResult=$reverse->reverse($this->getPin(),$token);
        return $reversalResult;
    }

    /**
     * @param $reversalResult
     * @return bool
     */
    public function isReadyReversal($reversalResult) {
        $ready=false;
        if( $reversalResult instanceof ReversalResult){
            if(($reversalResult->getStatus() == 0 || $reversalResult->getStatus() == '0')){
                $ready=true;
            }
        }
        return $ready;
    }
}
