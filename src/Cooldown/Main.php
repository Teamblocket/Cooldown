<?php

namespace Cooldown;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;

/**
 * Class Main
 * @package Cooldown
 */
class Main extends PluginBase{

    public function onEnable(){
        $this->getServer()->getLogger()->notice("Cooldown API Has been enabled!");

        $folder = $this->getDataFolder() . 'resources/';
        if(!is_dir($folder)) mkdir($folder);

        $this->db = new \SQLite3($folder . 'cooldowns.db');
        $this->db->exec("CREATE TABLE IF NOT EXISTS cooldowns(player TEXT PRIMARY KEY, cooldown TEXT, postedtime INT);");
    }

    /**
     * Sets the cooldown to the player
     * 
     * @param Player $player
     * @param string $cooldown
     */
    public function setPlayerCooldown(Player $player, string $cooldown){
        $r = $this->db->prepare("INSERT OR REPLACE INTO cooldowns(player, cooldown, postedtime) VALUES (:player, :cooldown, :postedtime);");
        $r->bindValue(":player", $player->getLowerCaseName());
        $r->bindValue(":cooldown", $cooldown);
        $r->bindValue(":postedtime", time());
        $r->execute();
    }

    /**
     * Removes the cooldown from the player
     * 
     * @param Player $player
     * @param string $cooldown
     */
    public function removePlayerCooldown(Player $player, string $cooldown){
        $player = $player->getLowerCaseName();
        $r = $this->db->prepare("DELETE FROM cooldowns WHERE player='$player' AND cooldown='$cooldown';");
        $r->execute();
    }

    /**
     * Returns the timestamp when the player's cooldown was created
     * 
     * @param Player $player
     * @param string $cooldown
     * @return int
     */
    public function getPlayerCooldown(Player $player, string $cooldown){
        $player = $player->getLowerCaseName();
        $r = $this->db->query("SELECT postedtime FROM cooldowns WHERE player='$player' AND cooldown='$cooldown';");
        return (int) $r->fetchArray(SQLITE3_ASSOC)['postedtime'];
    }

    /**
     * Checks if player is in cooldown
     * 
     * @param Player $player
     * @param string $cooldown
     * @param int $seconds
     * @return bool
     */
    public function inCooldown(Player $player, string $cooldown, int $seconds){
        $postedtime = $this->getPlayerCooldown($player, $cooldown);
        if($postedtime !== null && time() > $postedtime + $seconds){
            return true;
        }
    }
}
