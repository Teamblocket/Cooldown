<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 3/30/18
 * Time: 10:51 PM
 */

namespace CoolDown;


use pocketmine\Player;

/**
 * Class CoolDownPlayer
 * @package CoolDown
 */
class CoolDownPlayer extends Player {

	/**
	 * @param string $cooldownName
	 */
	public function setCooldown(string $cooldownName) : void{
		CoolDownAPI::setCooldown($this->username, $cooldownName);
		return;
	}

	/**
	 * @param string $cooldownName
	 */
	public function removeCooldown(string $cooldownName) : void{
		CoolDownAPI::removeCooldown($this->username, $cooldownName);
		return;
	}

	/**
	 * @param string $cooldownName
	 * @return CoolDown|null
	 */
	public function getCooldown(string $cooldownName) : ?CoolDown{
		return CoolDownAPI::getCooldown($this->username, $cooldownName);
	}
}
