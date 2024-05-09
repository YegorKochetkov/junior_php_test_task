<?php
require_once 'Models/FileSender.php';
require_once 'Services/BoredApiService.php';
require_once 'Controllers/MainController.php';
require_once 'Views/ConsoleInputView.php';

define('FILE_SENDER', 'file');
define('CONSOLE_SENDER', 'console');
define(
	'ACTIVITIES',
	["education", "recreational", "social", "diy", "charity", "cooking", "relaxation", "music", "busywork"]
);

$questions = [
	"getParticipantsNumber" => "Enter a number of participants (0-8): ",
	"getActivityType" => "Enter an activity. Available activities:\n" . implode(", ", ACTIVITIES) . ": ",
	"getSenderType" => "Choose where to output the received data (file, console): "
];

$participantsNumber = ConsoleInputView::getInput($questions['getParticipantsNumber']);

while (!is_numeric($participantsNumber) || $participantsNumber < 0 || $participantsNumber > 8) {
	echo "Invalid number of participants: $participantsNumber. It should be a number between 0 and 8." . PHP_EOL;
	echo "Please try again!" . PHP_EOL;
	$participantsNumber = ConsoleInputView::getInput($questions['getParticipantsNumber']);
}
echo "Number of participants is $participantsNumber" . PHP_EOL;

$activityType = strtolower(ConsoleInputView::getInput($questions['getActivityType']));

while (!in_array($activityType, ACTIVITIES)) {
	echo "Invalid activity: $activityType." . PHP_EOL;
	echo "Please try again!" . PHP_EOL;
	$activityType = strtolower(ConsoleInputView::getInput($questions['getActivityType']));
}
echo "You've chosen the next activity - $activityType" . PHP_EOL;

$senderType = strtolower(ConsoleInputView::getInput($questions['getSenderType']));

while ($senderType !== FILE_SENDER && $senderType !== CONSOLE_SENDER) {
	echo "Invalid output target: $senderType" . PHP_EOL;
	echo "Please try again!" . PHP_EOL;
	$senderType = strtolower(ConsoleInputView::getInput($questions['getSenderType']));
}
echo "You've chosen the next output - $senderType" . PHP_EOL;

$mainController = new MainController();
$mainController->run($participantsNumber, $activityType, $senderType);

?>
