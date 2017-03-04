<?php

namespace EggWars;

class ArenaListener implements Listener{
  
  public $ew;
  
   public function __construct(Main $ew){
     $ew = $this->ew;
    }
 
  public function createSign(SignChangeEvent $e)
  {
      $p = $e->getPlayer();
      $arena = $e->getLine(1);
      if ($p->isOp()) {
          if ($e->getLine(0) == "eggwars") {
              if (!empty($e->getLine(1))) {
                  if (!$this->ew->arenaExists($e->getLine(1))) {
                      $e->setLine(0, $this->ew->signprefix);
                      $e->setLine(1, "§a$arena");
                      $e->setLine(2, "§3Lobby");
                      $e->setLine(3, "§e0/0");
                  } elseif ($e->getLine(0) == "spawner") {
                      if (!empty($e->getLine(1))) {
                          switch ($e->getLine(1)) {
                              case "iron";
                                  $e->setLine(0, "§7Iron");
                                  $e->setLine(1, "§aTime: 0");
                                  $e->setLine(2, "§d0 Iron");
                                  $e->setLine(3, "§6---");
                                  break;
                              case "gold";
                                  $e->setLine(0, "§eGold");
                                  $e->setLine(1, "§aTime: 0");
                                  $e->setLine(2, "§d10 Gold");
                                  $e->setLine(3, "§6---");
                                  break;
                              case "diamond";
                                  $e->setLine(0, "§bDiamond");
                                  $e->setLine(1, "§aTime: 0");
                                  $e->setLine(2, "§b10 Diamond");
                                  $e->setLine(3, "§6---");
                          }
                      }
                  }
              }
          }
      }
  }

   /* public function onDamage(EntityDamageEvent $e)
    {
        $entity = $e->getEntity();
        $cause = $e->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent) {
            if($entity instanceof Villager){
                if($entity->getNameTag("§eMarket"){
                $damager = $cause->getDamager();
                $this->ew->addMarket($damager);
                $e->setCancelled()´hrthrgjnetfečrhgzzhgbšrgšrFUCK!!!!!!!!!!!!!
            }*/








               
        
               
           public function onInteract(PlayerInteractEvent $e)
           {
               $tile = $e->getTile();

               $p = $e->getPlayer();
               if ($tile instanceof Sign) {
                   $text = $tile->getText();
                   $ac = new Config($this->getDataFolder() . "Arenas/$text[1].yml", Config::YAML);
                   if ($text[0] == $this->ew->signprefix) {
                       if ($text[1] == $ac) {
                           if ($text[2] == "§3Lobby") {
                               $p->sendMessage("Able to join arena");
                               $ac->set($p->getName(), true);
                               $ac->save();
                           } else {
                               $p->sendMessage("Arena is not in lobby");
                           }
                       } else {
                           $p->sendMessage("Arena dont exist stop using fake signs");
                       }
                   } elseif ($text[0] == "§7Iron") {
                       if ($text[0] == Color::GREEN) {
                           //TODO CHECK FOR UPDATES
                       } elseif ($text[0] == "§cGold") {
                           if ($text[0] == Color::GREEN) {
                               //TODO CHECK FOR UPDATES
                           } elseif ($text[0] == "§bDiamond") {
                               if ($text[0] == Color::GREEN) {
                                   //TODO CHECK FOR UPDATES
                               }
                           }
                       }
                   }
               }
           }

                   
                   public function onBreak(BlockBreakEvent $e)
                   {
                       $p = $e->getPlayer();
                       $arena = $p->getLevel();
                       $ac = new Config($this->getDataFolder() . "Arenas/$arena.yml", Config::YAML);
                       if ($ac->get("gamers") == $p->getName()) {
                           if ($e->getBlock()->getId() == $this->ew->breakableBlocks()) {
                               $e->setCancelled(false);
                           } else {
                               $e->setCancelled(true);
                           }
                       } elseif ($p->getLevel()->getName() == $ac->get("LobbyWorld")) {
                           $e->setCancelled();
                           $p->sendMessage("Vim ze uz chces nekomu znicit vejce ale budes muset pockat:D");
                       }
            }
}
