<?php
/**
 * Copyright (c) 2018 Uhmi
 *
 * @author     	Uhmi <dev@uhmi.io>
 * @copyright  	2018 Uhmi
 * @version    	1.0
 * @link       	https://uhmi.io
 */

class Uhmi_Verify extends Uhmi
{
	/**
	 * Endpoint of the Verify API.
	 */
	const VERIFY_ENDPOINT = 'verify';

	/**
	 * Endpoint of the API keys.
	 */
	const API_KEYS_ENDPOINT = 'keys';

	/**
	 * Endpoint of the domain.
	 */
	const DOMAIN_ENDPOINT = 'domain';

	/**
     * @var string $apiKeysEndpoint
     */
	protected $apiKeysEndpoint;

	/**
     * @var string $domainEndpoint
     */
	protected $domainEndpoint;

	/**
     * @var string $apiKeys
     */
	protected $apiKeys;

	/**
     * @var string $domain
     */
	protected $domain;

	/**
	 * Construct the Uhmi class.
	 */
	public function __construct()
	{
		$apiEndpoint = self::HOST . '/' . self::API_PREFIX . '/' . self::API_VERSION . '/' . self::VERIFY_ENDPOINT . '/';

		$this->apiKeysEndpoint = $apiEndpoint . self::API_KEYS_ENDPOINT;
		$this->domainEndpoint  = $apiEndpoint . self::DOMAIN_ENDPOINT;
	}

	/**
	 * Verify API keys.
	 *
	 * @param   array  $apiKeys
	 * @return  void
	 */
	public function verifyApiKeys($apiKeys = null)
	{
		$this->apiKeys = $apiKeys;

		if ( ! $this->isApiKeysValid()) {
			return $this->setError('The parameter is invalid and must be an array with "public_key" and "private_key" keys.', 401);
		}

		if ( ! $this->hasApiKey()) {
			$this->setApiKey($apiKeys['private_key']);
		}

        $data = array(
        	'public_key' => $apiKeys['public_key']
        );

        $headers = array(
            'Content-Type: application/json; charset=utf-8'
        );

        $options = array(
            CURLOPT_POST       => true,					// do HTTP POST
            CURLOPT_POSTFIELDS => json_encode($data)	// set POST data
        );

		return $this->curl($this->apiKeysEndpoint, $headers, $options);
	}

	/**
	 * Verify domain.
	 *
	 * @param   string  $domain
	 * @return  void
	 */
	public function verifyDomain($domain = null)
	{
		if ( ! $this->hasApiKey()) {
			return $this->setError('You have not set an API Key or the API Key is invalid. Please use setApiKey() to set the API Key.', 401);
		}

		$this->domain = $domain;

		if ( ! $this->isDomainValid()) {
			return $this->setError('The domain parameter is invalid and must be an string.', 400);
		}

        $data = array(
        	'domain' => $domain
        );

        $headers = array(
            'Content-Type: application/json; charset=utf-8'
        );

        $options = array(
            CURLOPT_POST       => true,					// do HTTP POST
            CURLOPT_POSTFIELDS => json_encode($data)	// set POST data
        );

		return $this->curl($this->domainEndpoint, $headers, $options);
	}

	/**
	 * Is $this->apiKeys valid?
	 *
	 * @return bool
	 */
	protected function isApiKeysValid()
	{
		return (isset($this->apiKeys['public_key']) && isset($this->apiKeys['private_key']));
	}

	/**
	 * Is $domain valid?
	 *
	 * @return bool
	 */
	protected function isDomainValid()
	{
		return ( ! is_null($this->domain) && ! empty($this->domain));
	}
}
