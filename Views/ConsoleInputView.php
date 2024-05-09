<?php

class ConsoleInputView {
	public static function getInput(string $question): string {
		echo $question;
		return trim(readline());
	}
}

?>
