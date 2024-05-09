<?php
require_once 'Contracts\ApiService.php';

class BoredApiService implements ApiService {
	private const API_ENDPOINT = 'http://www.boredapi.com/api/activity';
	private string $url;

	public function __construct(int $participants, string $type) {
		$this->url = self::API_ENDPOINT . '?participants=' . $participants . '&type=' . $type;
	}

	public function get(): string {
		$response = file_get_contents($this->url);

		if ($response === false) {
			throw new Exception("Something went wrong. Can't fetch response from " . self::API_ENDPOINT);
		}

		$data = json_decode($response, true);
		return $data['activity'] ?? $data['error'];
	}
}

?>
