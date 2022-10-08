<?php


namespace Mastercode724\ParsianIPG;

use Mastercode724\ParsianIPG\Exceptions\NuSoapException;
use nusoap_client;


/**
 * Class ParsianRequest
 * @package Mastercode724\ParsianIPG
 */
class ParsianRequest
{


    /**
     * Url of parsian gateway web service
     *
     * @var string $server_url Url for initializing payment request
     *
     */
    public   $sale_url = 'https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl';

    /**
     * Url of parsian gateway web service
     *
     * @var string $confirm_url Url for confirming transaction
     *
     */
    public   $confirm_url = 'https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?wsdl';

    /**
     * Address of gate for redirect
     *
     * @var string
     */
    public static   $gate_url = 'https://pec.shaparak.ir/NewIPG/?Token=';

    /**
     * Url of parsian gateway web service
     *
     * @var string $reverse_url Url for reverse transaction
     *
     */
    public   $reverse_url = 'https://pec.shaparak.ir/NewIPGServices/Reverse/ReversalService.asmx?wsdl';


    /**
     *
     * @var string
     */
    protected   $Encoding    = "UTF-8";


    /**
     * @var ParsianLogger
     */
    public $logger;


    /**
     * ParsianRequest constructor.
     */
    public function __construct()
    {
        $this->logger = new ParsianLogger();
    }

    /**
     * @param string $address
     */
    public function createLogger(string $address=''){
        $this->logger->create($address);
    }


    /**
     * @param string $url
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws NuSoapException
     */
    protected function sendRequest( string $url,string $method,array $parameters=[]){
        $client = new nusoap_client($url, 'wsdl');
        $client->soap_defencoding = $this->Encoding;
        $client->decode_utf8 = FALSE;
        $err = $client->getError();
        if ($err) {
            throw new NuSoapException(  $err);
        }
        $result = $client->call($method, ['requestData' => $parameters]);
        $err = $client->getError();
        if ($err) {
            throw new NuSoapException(  $err);
        } else {
            return $result;
        }
    }
}