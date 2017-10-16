<?php

/**
 * Class TimeString
 * Extracts time with microseconds from input string like "00:00:15.01"
 */
class TimeString
{

	private $_micro = 0;
	private $_msec = 0;
	private $_sec = 0;
	private $_min = 0;
	private $_hours = 0;
	const BASE = 10;

	/**
	 * TimeString constructor.
	 *
	 * @param        $ts          string
	 * @param string $tDelim      string
	 * @param string $tMcSecDelim string
	 */
	public function __construct($ts, $tDelim = ':', $tMcSecDelim = '.')
	{
		$expDt1 = explode($tDelim, $ts);
		$micro  = explode($tMcSecDelim, array_pop($expDt1));
		array_push($expDt1, array_shift($micro));
		$micro        = count($micro) ? end($micro) : 0;
		$this->_micro = intval($micro, self::BASE);
		$this->_msec  = intval(array_pop($expDt1), self::BASE);
		$this->_sec   = intval(array_pop($expDt1), self::BASE);
		$this->_min   = intval(array_pop($expDt1), self::BASE);
		$this->_hours = intval(array_pop($expDt1), self::BASE);

		return $this;
	}

	/**
	 * Calculates time in microseconds
	 * @return int
	 */
	public function getMicrotime()
	{
		$microInMsec = 1000;
		$microInSec  = $microInMsec * 1000;
		$microInMin  = $microInSec * 60;
		$microInHour = $microInMin * 60;

		return $this->_micro +
			$this->_msec * $microInMsec +
			$this->_sec * $microInSec +
			$this->_min * $microInMin +
			$this->_hours * $microInHour;
	}


	/**
	 * Calculates time diff in microseconds between this object and $myTime
	 *
	 * @param TimeString $myTime
	 *
	 * @return int
	 */
	public function getDiffInMsec(self $myTime)
	{
		return $this->getMicrotime() - $myTime->getMicrotime();
	}

}