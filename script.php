<?php
define('FILE_SENDER', 'file');
define('CONSOLE_SENDER', 'console');
define(
	'ACTIVITIES',
	["education", "recreational", "social", "diy", "charity", "cooking", "relaxation", "music", "busywork"]
);

require_once 'Models/FileSender.php';
require_once 'Services/BoredApiService.php';
require_once 'Controllers/MainController.php';
require_once 'Views/ConsoleInputView.php';

$participantsNumber = ConsoleInputView::getInput("Enter a number of participants (0-8): ");
while (!is_numeric($participantsNumber) || $participantsNumber < 0 || $participantsNumber > 8) {
	echo "Invalid number of participants: $participantsNumber. It should be a number between 0 and 8." . PHP_EOL;
	echo "Please try again!" . PHP_EOL;
	$participantsNumber = ConsoleInputView::getInput("Enter a number of participants (0-8): ");
}
echo "Number of participants is $participantsNumber" . PHP_EOL;

$activityType = strtolower(ConsoleInputView::getInput("Enter an activity. Available activities:\n" . implode(", ", ACTIVITIES) . ": "));
while (!in_array($activityType, ACTIVITIES)) {
	echo "Invalid activity: $activityType." . PHP_EOL;
	echo "Please try again!" . PHP_EOL;
	$activityType = strtolower(ConsoleInputView::getInput("Enter an activity. Available activities:\n" . implode(", ", ACTIVITIES) . ": "));
}
echo "You've chosen the next activity - $activityType" . PHP_EOL;

$senderType = strtolower(ConsoleInputView::getInput("Choose where to output the received data: file, console: "));
while ($senderType !== FILE_SENDER && $senderType !== CONSOLE_SENDER) {
	echo "Invalid output target: $senderType" . PHP_EOL;
	echo "Please try again!" . PHP_EOL;
	$senderType = strtolower(ConsoleInputView::getInput("Choose where to output the received data: file, console: "));
}
echo "You've chosen the next output - $senderType" . PHP_EOL;

$mainController = new MainController();
$mainController->run($participantsNumber, $activityType, $senderType);

?>
