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
  
  public function addMarket(Player $o){
        $o->getLevel()->setBlock(new Vector3($o->getFloorX(), $o->getFloorY() - 4, $o->getFloorZ()), Block::get(Block::CHEST));
        $nbt = new CompoundTag("", [ 
            new ListTag("Items", []), 
            new StringTag("id", Tile::CHEST), 
            new IntTag("x", $o->getFloorX()), 
            new IntTag("y", $o->getFloorY() - 4),
            new IntTag("z", $o->getFloorZ()),
            new StringTag("CustomName", "§eMarket")
        ]);
        $nbt->Items->setTagType(NBT::TAG_Compound); 
        $tile = Tile::createTile("Chest", $o->getLevel(), $nbt, $o); 
        if($tile instanceof Chest) { 
            $config = new Config($this->getDataFolder() . "market.yml", Config::YAML); 
            $market = $config->get("Market"); 
            $tile->setName("§eMarket");
            $tile->getInventory()->clearAll(); 
            for ($i = 0; $i < count($market); $i+=2) { 
                $slot = $i / 2; 
                $tile->getInventory()->setItem($slot, Item::get($market[$i], 0, 1)); 
            } 
            $tile->getInventory()->setItem($tile->getInventory()->getSize()-1, Item::get(Item::WOOL, 14, 1)); 
            $o->addWindow($tile->getInventory()); 
        }
    }

  
  public function arenaExists($arena){
        $ac = new Config($this->getDataFolder()."Arenas/$arena.yml", Config::YAML);
            if(file_exists($this->getDataFolder()."Backups/".$ac->get("world")."/")){
                return true;
            }else{
                return false;
        }
    }
}
}
