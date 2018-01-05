# Cooldown
A Cooldown API for all you noobs!

# Don't know how to use the API? HERE YOU GO!

First were going get the plugin
```
$plugin = $this->getServer()->getPluginManager()->getPlugin("CooldownAPI");
```

Once you have the plugin you can now run these functions in your own plugin!
```
// Adding a cooldown to a player!
/** @var \pocketmine\Player */
$player;
$cooldown = 'AcoolDownName'; // This will be the cooldowns name , so this will be the name you use to return this cooldown!

$plugin->setPlayerCooldown($player, $cooldown); // Sets $player a cooldown with the name $cooldown , the timestamp is automatically done by the plugin!

$plugin->getPlayerCooldown($player, $cooldown); // Returns the time() the cooldown $cooldown was created!

$plugin->removePlayerCooldown($player, $cooldown); // Deletes the cooldown $cooldown from player $player!

/** @var int */
$seconds = 5;
$plugin->inCooldown($player, $cooldown, $seconds); // checks if the plyer cooldown is still in the 5 seconds!
```

Any issues contact me via Twitter(@Ang3lD3vs) or on my Discord(Angel#1062)!

