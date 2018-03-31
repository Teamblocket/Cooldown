# Cooldown
A Cooldown API for all you noobs!

# Don't know how to use the API? HERE YOU GO!

First were going get the plugin
```
$plugin = $this->getServer()->getPluginManager()->getPlugin("CoolDownAPI");
```

Once you have the plugin you can now run these functions in your own plugin!
```
// Adding a cooldown to a player!

/** @var \pocketmine\Player */
$cooldown = 'AcoolDownName'; // This is the cooldown's name
$player = 'playersName'; // The player's username which you want to add the cooldown

$plugin->setCooldown($player, $cooldown); // Adds a cooldown to $player, the cooldown's name is $cooldown

$class = $plugin->getCooldown($player, $cooldown); // Returns the CoolDown class!
// Once you have the cooldown class you can return the time the cooldown was posted by doing $class->getPostedTime()

// If you want to check if a player is in a cooldown still just do
/** @var \CoolDown\CoolDown */
$class = $plugin->getCooldown($player, $cooldown); // Of course you need to create the cooldown first!
if($class->inCooldown(10)){
    print('Still in cooldown');
 }

$plugin->removeCooldown($player, $cooldown); // Deletes the cooldown $cooldown from player $player!

//If you want it even easier , CoolDownAPI has a custom player class to set, remove and get cooldowns

// Start off with getting a player instance

$player->setCooldown('CooldownsName!');

if($player->getCooldown('CooldownsName!')->inCooldown(10)){
  $player->sendMessage('Still in cooldown');
}

$player->removeCooldown('CooldownsName!');
```

Any issues contact me via Twitter(@Ang3lD3vs) or on my Discord(Angel#1062)!

