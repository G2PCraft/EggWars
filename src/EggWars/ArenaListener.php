<?php

namespace EggWars;

class ArenaListener implements Listener{
  
  public $ew;
  
   public function __construct(Main $ew){
     $ew = $this->ew;
    }
 
  public function createSign(SignChangeEvent $e){
    $p = $e->getPlayer();
    $arena = $e->getLine(1);
    if($p->isOp()){
      if($e->getLine(0) == "eggwars"){
        if(!empty($e->getLine(1)){
          if(!$this->ew->arenaExists($e->getLine(1)){
            $e->setLine(0, $this->ew->signprefix);
            $e->setLine(1, "§a$arena");
            $e->setLine(2, "§e0/0");
            $e->setLine(3, "§7---");
        }elseif($e->getLine(0) == "spawner"){
            if(!empty($e->getLine(1)){
              switch($e->getLine(1)){
                  case "iron"
                    $e->setLine(0, "§7Iron");
                    $e->setLine(1, "§eTime: §e0");
                    $e->setLine(2, "§d0 Iron");
                    $e->setLine(3, "§6---");
                     }
          }
     }
}
