<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 3/13/18
 * Time: 12:09 AM
 */

namespace CraftedSystems\InfoSky;

use Unirest\Request;
use Unirest\Request\Body;

class InfoSkySMS
{
    /**
     * Base URL.
     *
     * @var string
     */
    const BASE_URL = 'http://isms.infosky.co.ke/sms2/api/v1/send-sms';

    /**
     * Get Balance endpoint.
     *
     * @var string
     */
    const GET_BALANCE_ENDPOINT = 'sms/balance';

    /**
     * settings .
     *
     * @var array.
     */
    protected $settings;

    /**
     * MicroMobileSMS constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        $this->settings = (object)$settings;

        if (
            empty($this->settings->acc_no) ||
            empty($this->settings->api_key) ||
            empty($this->settings->sender_id)
        ) {
            throw new \Exception('Please ensure that all InfoSky configuration variables have been set.');
        }
    }

    /**
     * @param $recipient
     * @param $message
     * @return mixed
     * @throws \Exception
     */
    public function send($recipient, $message)
    {
        if (!is_string($message)) {

            throw new \Exception('The Message Should be a string');
        }

        if (!is_string($recipient)) {
            throw new \Exception('The Phone number should be a string');
        }


        $headers = [
            'Content-Type' => 'application/json',
        ];

        $body = array(
            'acc_no' => $this->settings->acc_no,
            'api_key' => $this->settings->api_key,
            'sender_id' => $this->settings->sender_id,
            'message' => $message,
            'msisdn' => $recipient,
            'dlr_url' => $this->settings->call_back_url,
            'linkID' => ''
        );

        $response = Request::post(self::BASE_URL, $headers, Body::json($body));

        return $response->body[0];

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getDeliveryReports(\Illuminate\Http\Request $request)
    {
        return json_decode($request->getContent());
    }

    public function getBalance()
    {
        return 0;
    }

}