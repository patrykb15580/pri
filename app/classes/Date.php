<?php
/**
* 
*/
class Date
{
	
	static public function dateFormat($date)
	{
		$day = date('d', strtotime($date));

		if ($day < 10) {
			$day = number_format($day, 0);
		}

		$month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($date))];
		$year = date('Y', strtotime($date));

		return $day.' '.$month.' '.$year;
	}
}