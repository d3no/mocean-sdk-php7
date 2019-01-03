<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 12/17/2018
 * Time: 11:43 AM
 */

namespace Mocean\Account;


use Mocean\Client\Exception\Exception;
use Mocean\Model\ArrayAccessTrait;
use Mocean\Model\ModelInterface;
use Mocean\Model\ObjectAccessTrait;
use Mocean\Model\ResponseTrait;

class Price implements ModelInterface
{
    use ObjectAccessTrait, ResponseTrait, ArrayAccessTrait;

    protected $requestData = array();

    /**
     * Price constructor.
     * @param array $extra
     */
    public function __construct($extra = array())
    {
        $this->requestData = array_merge($this->requestData, $extra);
    }

    /**
     * @param $responseData
     * @return Price
     * @throws Exception
     */
    public static function createFromResponse($responseData)
    {
        $price = new self();
        $price->setRawResponseData($responseData)
            ->processResponse();

        if ($price['status'] !== 0 && $price['status'] !== '0') {
            throw new Exception($price['err_msg']);
        }

        return $price;
    }

    public function setResponseFormat($responseFormat)
    {
        $this->requestData['mocean-resp-format'] = $responseFormat;
        return $this;
    }

    public function setMcc($mcc)
    {
        $this->requestData['mocean-mcc'] = $mcc;
        return $this;
    }

    public function setMnc($mnc)
    {
        $this->requestData['mocean-mnc'] = $mnc;
        return $this;
    }

    public function setDelimiter($delimiter)
    {
        $this->requestData['mocean-delimiter'] = $delimiter;
        return $this;
    }

    public function getRequestData()
    {
        return $this->requestData;
    }
}