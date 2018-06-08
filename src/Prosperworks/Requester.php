<?php

namespace App\Prosperworks;

/**
 * A class to make API calls to Prosperworks.
 */
class Requester
{
    /**
     * User API key for Prosperworks.
     *
     * In development, you can hard-code this value and the email value,
     *    and comment out the constructor,
     *    if you get sick of entering them at the command line.
     *
     * @var string
     */
    private $apiKey = null;

    /**
     * User email for Prosperworks.
     *
     * @var string
     */
    private $email = null;

    /**
     * Base URL for calls to the Prosperworks developer API.
     *
     * @var string
     */
    private $baseUrl = 'https://api.prosperworks.com/developer_api/v1/';

    /**
     * @param string $baseUrl
     * @param string $apiKey
     * @param string $email
     */
    public function __construct(string $baseUrl, string $apiKey, string $email)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey  = $this->apiKey;
        $this->email   = $this->email;
    }

    /**
     * Gets a response for the path, data, and method specified.
     *
     * @param  string $uri
     * @param  string $postFields
     * @param  string $method
     *
     * @return string
     */
    public function getResponse(string $uri, string $postFields, string $method = 'POST'): ?string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => $this->baseUrl.$uri,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_POSTFIELDS => $postFields,
          CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-PW-AccessToken: ".$this->apiKey,
            "X-PW-Application: developer_api",
            "X-PW-UserEmail: ".$this->email,
          ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }
}
