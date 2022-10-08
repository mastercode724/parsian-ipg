<?php


namespace Mastercode724\ParsianIPG;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


/**
 * Class ParsianLogger
 * @package Mastercode724\ParsianIPG
 */
class ParsianLogger
{

    /**
     * @var Logger|null
     */
    private   $logger;


    /**
     * ParsianLogger constructor.
     */
    public function __construct()
    {
        $this->logger = null;
    }

    /**
     * @param string $address
     */
    public function create(string $address=''){
        $this->logger = new Logger('parsian');
        if(empty($address)) $address=__DIR__.'/logs/parsian.log';
        $this->logger->pushHandler(new StreamHandler($address, Logger::DEBUG));
    }

    /**
     * @return false|string
     */
    public function getDateLog(){
        return date('Y-m-d H:i:s') ;
    }



    /**
     * @param string $message
     */
    public function writeWarning(string $message){
        if($this->logger instanceof Logger) $this->logger->warning($this->getDateLog().$message);
    }


    /**
     * @param string $message
     */
    public function writeError(string $message){
        if($this->logger instanceof Logger) $this->logger->error($this->getDateLog().$message);
    }


    /**
     * @param string $message
     */
    public function writeInfo(string $message){
        if($this->logger instanceof Logger) $this->logger->info($this->getDateLog().$message);
    }

    /**
     * @param string $message
     */
    public function writeNotice(string $message){
        if($this->logger instanceof Logger) $this->logger->notice($this->getDateLog().$message);
    }

    /**
     * @param string $message
     */
    public function writeDebug(string $message){
        if($this->logger instanceof Logger) $this->logger->debug($this->getDateLog().$message);
    }

    /**
     * @param string $message
     */
    public function writeAlert(string $message){
        if($this->logger instanceof Logger) $this->logger->alert($this->getDateLog().$message);
    }

    /**
     * @param string $message
     */
    public function writeCritical(string $message){
        if($this->logger instanceof Logger) $this->logger->critical($this->getDateLog().$message);
    }

    /**
     * @param string $message
     */
    public function writeEmergency(string $message){
        if($this->logger instanceof Logger) $this->logger->emergency($this->getDateLog().$message);
    }

}