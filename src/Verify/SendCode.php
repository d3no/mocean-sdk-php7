<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 12/17/2018
 * Time: 5:02 PM
 */

namespace Mocean\Verify;


use Mocean\Client\Exception\Exception;
use Mocean\Model\ArrayAccessTrait;
use Mocean\Model\ModelInterface;
use Mocean\Model\ObjectAccessTrait;
use Mocean\Model\ResponseTrait;

class SendCode implements ModelInterface
{
    use ObjectAccessTrait, ResponseTrait, ArrayAccessTrait;

    protected $requestData = array();

    /**
     * SendCode constructor.
     * @param $to
     * @param $brand
     * @param array $extra
     */
    public function __construct($to, $brand, $extra = array())
    {
        $this->requestData['mocean-to'] = $to;
        $this->requestData['mocean-brand'] = $brand;
        $this->requestData = array_merge($this->requestData, $extra);
    }

    /**
     * @param $responseData
     * @return SendCode
     * @throws Exception
     */
    public static function createFromResponse($responseData)
    {
        $sendCode = new self(null, null);
        $sendCode->setRawResponseData($responseData)
            ->processResponse();

        if ($sendCode['status'] !== 0 && $sendCode['status'] !== '0') {
            throw new Exception($sendCode['err_msg']);
        }

        return $sendCode;
    }

    public function setTo($to)
    {
        $this->requestData['mocean-to'] = $to;
        return $this;
    }

    public function setBrand($brand)
    {
        $this->requestData['mocean-brand'] = $brand;
        return $this;
    }

    public function setFrom($from)
    {
        $this->requestData['mocean-from'] = $from;
        return $this;
    }

    public function setCodeLength($codeLength)
    {
        $this->requestData['mocean-code-length'] = $codeLength;
        return $this;
    }

    public function setPinValidity($pinValidity)
    {
        $this->requestData['mocean-pin-validity'] = $pinValidity;
        return $this;
    }

    public function setNextEventWait($nextEventWait)
    {
        $this->requestData['mocean-next-event-wait'] = $nextEventWait;
        return $this;
    }

    public function setResponseFormat($responseFormat)
    {
        $this->requestData['mocean-resp-format'] = $responseFormat;
        return $this;
    }

    public function getRequestData()
    {
        return $this->requestData;
    }
}