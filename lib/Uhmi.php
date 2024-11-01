<?php
/**
 * Copyright (c) 2018 Uhmi
 *
 * @author     	Uhmi <dev@uhmi.io>
 * @copyright  	2018 Uhmi
 * @version    	1.0
 * @link       	https://uhmi.io
 */

class Uhmi
{
	/**
	 * The host.
	 */
	const HOST = 'https://uhmi.io';

	/**
	 * Version of the API.
	 */
	const API_VERSION = 'v1';

	/**
	 * Prefix of API Endpoint.
	 */
	const API_PREFIX = 'api';

	/**
	 * Endpoint of the Content API.
	 */
	const CONTENT_ENDPOINT = 'content';

	/**
	 * Endpoint of the Donations API.
	 */
	const DONATIONS_ENDPOINT = 'donations';

	/**
	 * Endpoint of the Payments API.
	 */
	const PAYMENTS_ENDPOINT = 'payments';

	/**
	 * Endpoint of the Transactions API.
	 */
	const TRANSACTIONS_ENDPOINT = 'transactions';

	/**
     * @var string $apiKey
     */
	protected $apiKey;

	/**
     * @var string $contentEndpoint
     */
	protected $contentEndpoint;

	/**
     * @var string $donationsEndpoint
     */
	protected $donationsEndpoint;

	/**
     * @var string $paymentsEndpoint
     */
	protected $paymentsEndpoint;

	/**
     * @var string $transactionsEndpoint
     */
	protected $transactionsEndpoint;

	/**
	 * @var resource $ch
	 */
	protected $ch;

	/**
	 * Construct the Uhmi class.
	 */
	public function __construct()
	{
		$apiEndpoint = self::HOST . '/' . self::API_PREFIX . '/' . self::API_VERSION . '/';

		$this->contentEndpoint 		= $apiEndpoint . self::CONTENT_ENDPOINT;
		$this->donationsEndpoint 	= $apiEndpoint . self::DONATIONS_ENDPOINT;
		$this->paymentsEndpoint 	= $apiEndpoint . self::PAYMENTS_ENDPOINT;
		$this->transactionsEndpoint = $apiEndpoint . self::TRANSACTIONS_ENDPOINT;
	}

	/**
	 * Set the API key.
	 *
	 * @param   string  $apiKey
	 * @return  void
	 */
	public function setApiKey($apiKey = null)
	{
		$this->apiKey = $apiKey;
	}

	/**
	 * Create content.
	 *
	 * @param   array  $data
	 * @return  array
	 */
	public function createContent($data = null)
	{
		return $this->create($data, $this->contentEndpoint);
	}

	/**
	 * Create a donation.
	 *
	 * @param   array  $data
	 * @return  array
	 */
	public function createDonation($data = null)
	{
		return $this->create($data, $this->donationsEndpoint);
	}

	/**
	 * Create a payment.
	 *
	 * @param   array  $data
	 * @return  array
	 */
	public function createPayment($data = null)
	{
		return $this->create($data, $this->paymentsEndpoint);
	}

	/**
	 * Create a payment.
	 *
	 * @param   array   $data
	 * @param   string  $endpoint
	 * @return  array
	 */
	protected function create($data = null, $endpoint = null)
	{
		if ( ! $this->hasApiKey()) {
			return $this->setApiKeyError();
		}

		if ( ! $this->isEndpointValid($endpoint)) {
			return $this->setError('The endpoint is invalid or has not been set.', 400);
		}

		if ( ! $this->isDataValid($data)) {
			return $this->setError('The data parameter is invalid and must be an array.', 400);
		}

		$headers = array(
			'Content-Type: application/json; charset=utf-8',
		);

		$options = array(
			CURLOPT_POST 		=> true,				// do HTTP POST
			CURLOPT_POSTFIELDS 	=> json_encode($data)	// set POST data
		);

		return $this->curl($endpoint, $headers, $options);
	}

	/**
	 * Has the payment been created successfully?
	 *
	 * @param   array  $payment
	 * @return  bool
	 */
	public function hasCreatedSuccessfully($payment)
	{
		return ! isset($payment['error']);
	}

	/**
	 * Update content.
	 *
	 * @param   string  $paymentId
	 * @param   array   $data
	 * @return  array
	 */
	public function updateContent($paymentId = null, $data = null)
	{
		return $this->update($paymentId, $data, $this->contentEndpoint);
	}

	/**
	 * Update a donation.
	 *
	 * @param   string  $paymentId
	 * @param   array   $data
	 * @return  array
	 */
	public function updateDonation($paymentId = null, $data = null)
	{
		return $this->update($paymentId, $data, $this->donationsEndpoint);
	}

	/**
	 * Update a payment.
	 *
	 * @param   string  $paymentId
	 * @param   array   $data
	 * @return  array
	 */
	public function updatePayment($paymentId = null, $data = null)
	{
		return $this->update($paymentId, $data, $this->paymentsEndpoint);
	}

	/**
	 * Update a payment.
	 *
	 * @param   string  $paymentId
	 * @param   array 	$data
	 * @param   string  $endpoint
	 * @return  array
	 */
	protected function update($paymentId = null, $data = null, $endpoint = null)
	{
		if ( ! $this->hasApiKey()) {
			return $this->setApiKeyError();
		}

		if ( ! $this->hasPaymentId($paymentId)) {
			return $this->setError('The Payment ID is invalid or has not been set.', 400);
		}

		if ( ! $this->isEndpointValid($endpoint)) {
			return $this->setError('The endpoint is invalid or has not been set.', 400);
		}

		if ( ! $this->isDataValid($data)) {
			return $this->setError('The data parameter is invalid and must be an array.', 400);
		}

		$headers = array(
			'Content-Type: application/json; charset=utf-8'
		);

		$options = array(
			CURLOPT_CUSTOMREQUEST 	=> 'PATCH',
			CURLOPT_POSTFIELDS 		=> json_encode($data)	// set POST data
		);

		return $this->curl("$endpoint/$paymentId", $headers, $options);
	}

	/**
	 * Has the payment been updated successfully?
	 *
	 * @param   array  $payment
	 * @return  bool
	 */
	public function hasUpdatedSuccessfully($payment)
	{
		return ! isset($payment['error']);
	}

	/**
	 * Delete content.
	 *
	 * @param   string  $paymentId
	 * @return  array
	 */
	public function deleteContent($paymentId = null)
	{
		return $this->delete($paymentId, $this->contentEndpoint);
	}

	/**
	 * Delete a donation.
	 *
	 * @param   string  $paymentId
	 * @return  array
	 */
	public function deleteDonation($paymentId = null)
	{
		return $this->delete($paymentId, $this->donationsEndpoint);
	}

	/**
	 * Delete a payment.
	 *
	 * @param   string  $paymentId
	 * @return  array
	 */
	public function deletePayment($paymentId = null)
	{
		return $this->delete($paymentId, $this->paymentsEndpoint);
	}

	/**
	 * Delete a payment.
	 *
	 * @param   string  $paymentId
	 * @param   string  $endpoint
	 * @return  array
	 */
	protected function delete($paymentId = null, $endpoint = null)
	{
		if ( ! $this->hasApiKey()) {
			return $this->setApiKeyError();
		}

		if ( ! $this->hasPaymentId($paymentId)) {
			return $this->setError('The Payment ID is invalid or has not been set.', 400);
		}

		if ( ! $this->isEndpointValid($endpoint)) {
			return $this->setError('The endpoint is invalid or has not been set.', 400);
		}

		$headers = array(
			'Content-Type: application/json; charset=utf-8'
		);

		$options = array(
			CURLOPT_CUSTOMREQUEST => 'DELETE'
		);

		return $this->curl("$endpoint/$paymentId", $headers, $options);
	}

	/**
	 * Get content.
	 *
	 * @param   string  $paymentId
	 * @return  array
	 */
	public function getContent($paymentId = null)
	{
		return $this->get($paymentId, $this->contentEndpoint);
	}

	/**
	 * Get a donation.
	 *
	 * @param   string  $paymentId
	 * @return  array
	 */
	public function getDonation($paymentId = null)
	{
		return $this->get($paymentId, $this->donationsEndpoint);
	}

	/**
	 * Get a payment.
	 *
	 * @param   string  $paymentId
	 * @return  array
	 */
	public function getPayment($paymentId = null)
	{
		return $this->get($paymentId, $this->paymentsEndpoint);
	}

	/**
	 * Get a payment.
	 *
	 * @param   string  $paymentId
	 * @param   string  $endpoint
	 * @return  array
	 */
	protected function get($paymentId = null, $endpoint = null)
	{
		if ( ! $this->hasApiKey()) {
			return $this->setApiKeyError();
		}

		if ( ! $this->hasPaymentId($paymentId)) {
			return $this->setError('The Payment ID is invalid or has not been set.', 400);
		}

		if ( ! $this->isEndpointValid($endpoint)) {
			return $this->setError('The endpoint is invalid or has not been set.', 400);
		}

		return $this->curl("$endpoint/$paymentId");
	}

	/**
	 * Get a Transaction.
	 *
	 * @param   string  $transactionId
	 * @return  array
	 */
	public function getTransaction($transactionId = null)
	{
		if ( ! $this->hasApiKey()) {
			return $this->setApiKeyError();
		}

		if ( ! $this->hasTransactionId($transactionId)) {
			return $this->setError('The Transaction ID is invalid.', 400);
		}

		return $this->curl($this->transactionsEndpoint . '/' . $transactionId);
	}

	/**
	 * Has the user paid?
	 *
	 * @param   array  $transaction
	 * @return  bool
	 */
	public function hasPaid($transaction)
	{
		return (isset($transaction['status']) && ($transaction['status'] == 'open' || $transaction['status'] == 'paid'));
	}

	/**
	 * The cURL request.
	 *
	 * @param   string  $url
	 * @param   array   $headers
	 * @param   array   $options
	 * @return  array
	 */
	protected function curl($url, array $headers = array(), array $options = array())
	{
		$this->ch = curl_init($url);

		$headers = array_merge(array(
			'Authorization: Bearer ' . $this->apiKey,
		), $headers);

		$options = $options + array(
			CURLOPT_HEADER 			=> true, 		// include the header in the output
			CURLOPT_HTTPHEADER 		=> $headers, 	// set headers
			CURLOPT_RETURNTRANSFER 	=> true, 		// return as a string
			CURLOPT_VERBOSE 		=> true, 		// output verbose information
			CURLOPT_SSL_VERIFYHOST 	=> 2, 			// verifies SSL certificate's host
			CURLOPT_SSL_VERIFYPEER 	=> true, 		// verifies SSL certificate
			//CURLOPT_SSL_VERIFYPEER	=> false	// !! ONLY FOR DEV
		);

        curl_setopt_array($this->ch, $options);		// set cURL options

		$result = curl_exec($this->ch);				// execute cURL

        // cURL error check
		if (curl_errno($this->ch)) {
			return $this->setError('Unable to communicate with Uhmi. Please, try again.', 500);
        }

		$headerSize = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
		$headerCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
		$header 	= substr($result, 0, $headerSize);
		$body 		= substr($result, $headerSize);
		$body		= json_decode($body, true);

		if ($headerCode >= 500) {
			return $this->setError('Something went wrong on our end. Please, try again.', $headerCode);
		}

		if (($headerCode != 200 && $headerCode != 201) && ! isset($body['error'])) {
			return $this->setError('An unspecified error occurred. Please, try again. If this problem continues to occur, please contact us.', $headerCode);
		}

		return $body;
	}

	/**
	 * Has the Api key been set?
	 *
	 * @return  bool
	 */
	protected function hasApiKey()
	{
		return ($this->apiKey && ! empty($this->apiKey));
	}

	/**
	 * Has a Payment ID?
	 *
	 * @param   array|string  $payment
	 * @return  bool
	 */
	protected function hasPaymentId($payment)
	{
		if (is_array($payment)) {
			return (isset($payment['payment_id']) && ! empty($payment['payment_id']));
		}

		return ($payment && ! empty($payment));
	}

	/**
	 * Has a Transaction ID?
	 *
	 * @param   array|string  $transaction
	 * @return  bool
	 */
	protected function hasTransactionId($transaction)
	{
		if (is_array($transaction)) {
			return (isset($transaction['transaction_id']) && ! empty($transaction['transaction_id']));
		}

		return ($transaction && ! empty($transaction));
	}

	/**
	 * Is the endpoint valid?
	 *
	 * @param   string  $endpoint
	 * @return  bool
	 */
	protected function isEndpointValid($endpoint)
	{
		return ! is_null($endpoint);
	}

	/**
	 * Is the data valid?
	 *
	 * @param   array  $data
	 * @return  bool
	 */
	protected function isDataValid($data)
	{
		return is_array($data);
	}

	/**
	 * Set error with message.
	 *
	 * @param   string  $message
	 * @param   int   	$code
	 * @return  array
	 */
	protected function setError($message, $code = 0)
	{
		return array(
			'error' => array(
				'code'	  => $code,
				'message' => $message,
			)
		);
	}

	/**
	 * Set API key specific error.
	 *
	 * @return  array
	 */
	protected function setApiKeyError()
	{
		return $this->setError('You have not set a private API key or the API key is invalid. Please use setApiKey() to set the API key.', 401);
	}

	/**
	 * Has an error?
	 *
	 * @param   array  $result
	 * @return  bool
	 */
	protected function hasError($result)
	{
		return isset($result['error']);
	}

	/**
	 * Close any cURL handles, if we have them.
	 */
	public function __destruct()
	{
		if (is_resource($this->ch)) {
			curl_close($this->ch);
		}
	}
}
