<?php


namespace Mastercode724\ParsianIPG;


use Mastercode724\ParsianIPG\Entities\ConfirmPaymentRequest;
use Mastercode724\ParsianIPG\Entities\ConfirmPaymentResult;
use Mastercode724\ParsianIPG\Exceptions\ConfirmPaymentInValidException;

/**
 * Class ConfirmPayment
 * @package Mastercode724\ParsianIPG
 */
class ConfirmPayment  extends ParsianRequest
{

    /**
     * @var ConfirmPaymentResult|null
     */
    private $confirmPaymentResult;

    /**
     * ConfirmPayment constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->confirmPaymentResult=null;
    }

    /**
     * @param ConfirmPaymentRequest $confirmPaymentRequest
     * @return ConfirmPaymentResult
     * @throws Exceptions\NuSoapException
     */
    protected function confirmRequest( ConfirmPaymentRequest $confirmPaymentRequest){

        $parameters = [
            'LoginAccount' =>  $confirmPaymentRequest->getPin(),
            'Token' => $confirmPaymentRequest->getToken()
        ];

        $result = $this->sendRequest($this->confirm_url,'ConfirmPayment',$parameters);

        $confirmPaymentResult=new ConfirmPaymentResult([]);
        $confirmPaymentResult->setStatus($result['ConfirmPaymentResult']['Status'] );
        $confirmPaymentResult->setToken($result['ConfirmPaymentResult']['Token']);
        $confirmPaymentResult->setMessage($result['ConfirmPaymentResult']['Message'] );
        $confirmPaymentResult->setRRN($result['ConfirmPaymentResult']['RRN']);
        $confirmPaymentResult->setCardNumberMasked($result['ConfirmPaymentResult']['CardNumberMasked']);
        return  $confirmPaymentResult;
    }


    /**
     * @param $pin
     * @return ConfirmPaymentResult|null
     */
    public   function confirm($pin)
    {
        $status = null;
        $token = null;
        $RRN = null;

        if (isset($_POST["status"])) $status = $_POST["status"];
        if (isset($_POST["Token"])) $token = $_POST["Token"];
        if (isset($_POST["RRN"])) $RRN = $_POST["RRN"];

        try {

            $confirmPaymentRequest = new ConfirmPaymentRequest();
            $confirmPaymentRequest->setPin($pin);
            $confirmPaymentRequest->setStatus($status);
            $confirmPaymentRequest->setRRN($RRN);
            $confirmPaymentRequest->setToken($token);

            $this->logger->writeInfo($confirmPaymentRequest);

            if($status==null || $token==null){
                throw new ConfirmPaymentInValidException();
            }

            if (($status == 0) && ($RRN > 0) && ($token > 0)) {

                $this->confirmPaymentResult = $this->confirmRequest($confirmPaymentRequest);
                $this->logger->writeInfo($this->confirmPaymentResult);

            }else{
                $this->confirmPaymentResult = new ConfirmPaymentResult();
                $this->confirmPaymentResult->setRRN($RRN);
                $this->confirmPaymentResult->setToken($token);
                $this->confirmPaymentResult->setStatus($status);
                $this->logger->writeError($this->confirmPaymentResult);
            }
        } catch (\Exception $e) {
            $this->confirmPaymentResult = new ConfirmPaymentResult();
            $this->confirmPaymentResult->setRRN($RRN);
            $this->confirmPaymentResult->setToken($token);
            $this->confirmPaymentResult->setStatus($status);
            $this->confirmPaymentResult->setMessage("code :".$e->getCode()." message:".$e->getMessage());
            $this->logger->writeError($this->confirmPaymentResult);
        }
        return $this->confirmPaymentResult;
    }
}