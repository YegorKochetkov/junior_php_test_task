<?php
require_once 'Models\FileSender.php';
require_once 'Models\ConsoleSender.php';

class MainController {
	public function run(int $participantsNumber, string $activityType, string $senderType): void {
		$boredApi = new BoredApiService($participantsNumber, $activityType);

		switch ($senderType) {
			case FILE_SENDER:
				$sender = new FileSender();
				break;
			case CONSOLE_SENDER:
				$sender = new ConsoleSender();
				break;
			default:
				throw new Exception("Invalid sender specified");
		}

		try {
			$activity = $boredApi->get();
			$sender->send($activity);
		} catch (Exception $exception) {
			echo "Error: " . $exception->getMessage() . "\n";
		}
	}
}

?>
