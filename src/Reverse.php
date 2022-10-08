<?php


namespace Mastercode724\ParsianIPG;


use Mastercode724\ParsianIPG\Entities\ReversalRequest;
use Mastercode724\ParsianIPG\Entities\ReversalResult;
use Mastercode724\ParsianIPG\Exceptions\ReversalInValidException;

/**
 * Class Reverse
 * @package Mastercode724\ParsianIPG
 */
class Reverse  extends ParsianRequest
{

    /**
     * @var ReversalResult|null
     */
    private $reversalResult;

    /**
     * Reverse constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->reversalResult=null;
    }


    /**
     * @param ReversalRequest $reversalRequest
     * @return ReversalResult
     * @throws Exceptions\NuSoapException
     */
    protected function reverseRequest( ReversalRequest $reversalRequest){


        $parameters = [
            'LoginAccount' =>  $reversalRequest->getPin(),
            'Token' => $reversalRequest->getToken()
        ];
        $result = $this->sendRequest($this->reverse_url,'ReversalRequest',$parameters);

        $status = null;
        if(isset($result['ReversalRequestResult']['Status'])){
            $status = $result['ReversalRequestResult']['Status'];
        }

        if($status!= '0'){
            //throw new ParsianErrorException( $status);
            if(isset($result['ReversalRequestResult']['Token']))
                $token = $result['ReversalRequestResult']['Token']  ;
            else
                $token = null;
            if(isset($result['ReversalRequestResult']['Message']))
                $Message = $result['ReversalRequestResult']['Message'] ;
            else
                $Message = null;

            $reversalResult=new ReversalResult([]);
            $reversalResult->setStatus($status);
            $reversalResult->setToken($token);
            $reversalResult->setMessage($Message);
            return $reversalResult;
        }else {
            // update database
            $reversalResult=new ReversalResult([]);
            $reversalResult->setStatus($status);
            $reversalResult->setToken($result['ReversalRequestResult']['Token']);
            $reversalResult->setMessage($result['ReversalRequestResult']['Message']);
            return $reversalResult;
        }
    }


    /**
     * @param $pin
     * @param int $token
     * @return ReversalResult|null
     */
    public   function  reverse($pin,int $token)
    {
        try {
            if ($token > 0) {
                $reversalRequest = new ReversalRequest();
                $reversalRequest->setPin($pin);
                $reversalRequest->setToken($token);

                $this->logger->writeInfo($reversalRequest);
                $this->reversalResult = null;

                $this->reversalResult = $this->reverseRequest($reversalRequest);
                $this->logger->writeInfo($this->reversalResult);

            }else{
                throw new ReversalInValidException();
            }
        } catch (\Exception $e) {
            $this->reversalResult = new ReversalResult();
            $this->reversalResult->setToken($token);
            $this->reversalResult->setMessage("code :".$e->getCode()." message:".$e->getMessage());
            $this->logger->writeError(  $this->reversalResult);
        }

        return  $this->reversalResult;
    }
}