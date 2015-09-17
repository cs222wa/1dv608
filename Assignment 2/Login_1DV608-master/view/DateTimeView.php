<?php
namespace view;

class DateTimeView {

	public function show() {

		$timeString = new \DateTime();

		return '<p>' . $timeString->format('l, \t\h\e jS') . ' of '. $timeString->format('F Y,') .' The time is '. $timeString->format('H:i:s') .' </p>';
	}
}
