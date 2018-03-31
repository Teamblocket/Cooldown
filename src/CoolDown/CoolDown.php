<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 3/30/18
 * Time: 10:46 PM
 */

namespace CoolDown;

/**
 * Class CoolDown
 * @package CoolDown
 */
class CoolDown {

	/** @var string  */
	private $owner;

	/** @var int  */
	private $postedTime;

	/**
	 * CoolDown constructor.
	 * @param string $owner
	 * @param int $postedTime
	 */
	public function __construct(string $owner, int $postedTime) {
		$this->owner = $owner;
		$this->postedTime = $postedTime;
	}

	/**
	 * @return string
	 */
	public function getOwner() : string{
		return $this->owner;
	}

	/**
	 * @return int
	 */
	public function getPostedTime() : int{
		return $this->postedTime;
	}

	/**
	 * Checks if player is still in cooldown with x seconds
	 * Returns true if still in cooldown, false if not
	 *
	 * @param int $seconds
	 * @return bool
	 */
	public function inCooldown(int $seconds){
		return $this->postedTime + $seconds > time();
	}
}
