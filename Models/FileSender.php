<?php
require_once 'Contracts/ActivitySender.php';

class FileSender implements ActivitySender {
	public function send(string $activity): void {
		$result = file_put_contents('output.txt', json_encode($activity) . "\n");

		if ($result === false) {
			throw new Exception("Cannot write to file output.txt");
		}
	}
}

?>
