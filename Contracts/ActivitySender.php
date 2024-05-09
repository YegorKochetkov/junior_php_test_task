<?php

interface ActivitySender {
	public function send(string $activity): void;
}

?>