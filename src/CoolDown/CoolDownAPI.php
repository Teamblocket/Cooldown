<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 3/30/18
 * Time: 10:35 PM
 */

namespace CoolDown;

use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerCreationEvent;

/**
 * Class CoolDownAPI
 * @package CoolDown
 */
class CoolDownAPI extends PluginBase implements Listener {

	/** @var Config */
	private static $cooldown;

	public function onEnable() : void{

		if(is_dir($this->getDataFolder()) == false) mkdir($this->getDataFolder());

		self::$cooldown = new Config($this->getDataFolder() . 'cooldowns.json');

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @param PlayerCreationEvent $event
	 */
	public function onCreation(PlayerCreationEvent $event) : void{

		if($event->isCancelled()) return;

		$event->setPlayerClass(CoolDownPlayer::class);
	}

	/**
	 * @param string $playerName
	 * @param string $cooldownName
	 */
	public static function setCooldown(string $playerName, string $cooldownName) : void{
		$everything = [];

		if(self::$cooldown->exists($playerName)) $everything = self::$cooldown->get($playerName);

		if(isset($everything[$cooldownName])) return;

		$everything[$cooldownName] = time();

		self::$cooldown->set($playerName, $everything);
		self::$cooldown->save();
		return;
	}

	/**
	 * @param string $playerName
	 * @param string $cooldownName
	 */
	public static function removeCooldown(string $playerName, string $cooldownName) : void{
		$everything = [];

		if(self::$cooldown->exists($playerName))  $everything = self::$cooldown->exists($playerName);

		if(isset($everything[$cooldownName]) == false) return;

		unset($everything[$cooldownName]);
		self::$cooldown->set($playerName, $everything);
		self::$cooldown->save();
		return;
	}

	/**
	 * @param string $playerName
	 * @param string $cooldownName
	 * @return CoolDown|null
	 */
	public static function getCooldown(string $playerName, string $cooldownName) : ?CoolDown{
		$everything = [];

		if(self::$cooldown->exists($playerName))  $everything = self::$cooldown->exists($playerName);

		if(isset($everything[$cooldownName]) == false) return null;

		return new CoolDown($playerName, $everything[$cooldownName]);
	}
}
