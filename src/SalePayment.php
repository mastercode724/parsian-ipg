<?php


namespace Mastercode724\ParsianIPG;


use Mastercode724\ParsianIPG\Entities\SalePaymentResult;
use Mastercode724\ParsianIPG\Entities\SalePaymentRequest;
use Mastercode724\ParsianIPG\Exceptions\SalePaymentInValidException;


/**
 * Class SalePayment
 * @package Mastercode724\ParsianIPG
 */
class SalePayment extends ParsianRequest
{

    /**
     * @var SalePaymentResult|null
     */
    private $salePaymentResult;


    /**
     * SalePayment constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->salePaymentResult=null;
    }


    /**
     * @param SalePaymentRequest $salePaymentRequest
     * @return SalePaymentResult
     * @throws \Exception
     */
    protected function sendPayRequest(SalePaymentRequest $salePaymentRequest){

        $parameters = [
            'LoginAccount' => $salePaymentRequest->getPin(),
            'Amount' => $salePaymentRequest->getAmount(),
            'OrderId' => $salePaymentRequest->getOrderId(),
            'CallBackUrl' => $salePaymentRequest->getCallbackUrl(),
            'AdditionalData'=> $salePaymentRequest->getAdditionalData(),
            'Originator'=> $salePaymentRequest->getOriginator()
        ]; 

        $result = $this->sendRequest($this->sale_url,'SalePaymentRequest',$parameters);

        if(isset($result['SalePaymentRequestResult']['Token']))
            $Token = $result['SalePaymentRequestResult']['Token'];
        else $Token=null;
        $Status = $result['SalePaymentRequestResult']['Status'];
        $Message = $result['SalePaymentRequestResult']['Message'];

        $salePaymentResult=new SalePaymentResult();
        $salePaymentResult->setStatus($Status);
        $salePaymentResult->setToken($Token)  ;
        $salePaymentResult->setMessage($Message)  ;
        return $salePaymentResult;
    }


    /**
     * @param $pin
     * @param $orderId
     * @param $amount
     * @param string $callbackUrl
     * @param string $additionalData
     * @param string $originator
     * @return SalePaymentResult|null
     */
    public function payment($pin ,$orderId, $amount,string $callbackUrl,string $additionalData="",string $originator="") {

        try {
            $salePaymentRequest = new SalePaymentRequest();
            $salePaymentRequest->setAmount($amount);
            $salePaymentRequest->setOrderId($orderId);
            $salePaymentRequest->setPin($pin);
            $salePaymentRequest->setCallbackUrl($callbackUrl);
            $salePaymentRequest->setAdditionalData($additionalData);
            $salePaymentRequest->setOriginator($originator);

            $this->logger->writeInfo( $salePaymentRequest);

            if(($amount>=1000) && (!empty($callbackUrl))) {

                $result = $this->sendPayRequest($salePaymentRequest);
                $this->salePaymentResult = $result;
                $this->logger->writeInfo($this->salePaymentResult);

            }else{
                throw new SalePaymentInValidException();
            }

        } catch (\Exception $e) {
            $this->salePaymentResult = new SalePaymentResult();
            $this->salePaymentResult->setMessage("code :".$e->getCode()." message:".$e->getMessage());
            $this->logger->writeError( $this->salePaymentResult);
        }
        return $this->salePaymentResult;
    }

}
