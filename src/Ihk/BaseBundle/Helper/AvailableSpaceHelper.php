<?php

namespace Ihk\BaseBundle\Helper;


class AvailableSpaceHelper
{
	private $lowerThreshold;
	private $directory;

	public function __construct($threshold, $directory)
	{
		$this->lowerThreshold = $threshold;
		$this->directory      = $directory;
	}

	public function getDiskFreeSpace()
	{
		return disk_free_space($this->directory);
	}

	public function isThereEnoughSpace()
	{
		if ($this->getDiskFreeSpace() > $this->lowerThreshold) {
			return true;
		} else {
			return false;
		}
	}
} 