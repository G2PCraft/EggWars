<?php

namespace EggWars;

class Main extends PluginBase implements Listener{
  
  public function onEnable(){
    @mkdir($this->getDataFolder());
    @mkdir($this->getDataFolder() . "Arenas");
    @mkdir($this->getDataFolder() . "Backups");
    self::registerEvents();
  }
  
  public function registerEvents(){
    Server::getInstance()->registerEvents(new ArenaListener($this), $this);
    Server::getInstance()->getScheduler()->scheduleRepeatingTask(new GameTask($this), 20);
    Server::getInstance()->getScheduler()->scheduleRepeatingTask(new SignTask($this), 20);
  }
  
  public function teams(){
    $teams = array(
    "RED" => "§c",
    "GREEN" => "§a",
    "YELLOW" => "§e",
    "BLUE" => "§9"
    );
    return $teams;
  }
  
  public function teamNumber(){
  $tn = array(
  "RED" => 1,
  "GREEN" => 2,
  "YELLOW" => 3,
  "BLUE" => 4
    );
    return $tn;
  }

  
  public function arenaExists($arena){
        $ac = new Config($this->getDataFolder()."Arenas/$arena.yml", Config::YAML);
            if(file_exists($this->getDataFolder()."Backups/".$ac->get("Dunya")."/")){
                return true;
            }else{
                return false;
        }
    }
}
}
