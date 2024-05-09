<?php
require_once 'Contracts/ActivitySender.php';

class ConsoleSender implements ActivitySender {
	public function send(string $activity): void {
		print_r($activity);
	}
}

?>
