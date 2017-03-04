<?php

namespace EggWars;

class Main extends PluginBase implements Listener{
  public $a;
  public function onEnable(){
    @mkdir($this->getDataFolder());
    @mkdir($this->getDataFolder() . "Arenas");
    @mkdir($this->getDataFolder() . "Backups");
    self::registerEvents();
    self::$a = $this;
      
  }
  
  public function registerEvents(){
    Server::getInstance()->registerEvents(new ArenaListener($this), $this);
    Server::getInstance()->getScheduler()->scheduleRepeatingTask(new GameTask($this), 20);
    Server::getInstance()->getScheduler()->scheduleRepeatingTask(new SignTask($this), 20);
    Server::getInstance()->getCommandMap()->register("EggWars", new EggWarsCommand());
  }
  
  public static function getInstance(){
        return self::$a;
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
  
  public function createBackUp($arena){
      $ac = new Config($this->getDataFolder()."Arenas/$arena.yml", Config::YAML);
    $old = $this->getDataPatch() . "worlds/$arena");
    $new = $this->getDataFolder() . "Backups/");
    copy($old, $new);
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
  
  public function loadArenas($arena){
     $ac = new Config($this->getDataFolder()."Arenas/$arena.yml", Config::YAML);
    foreach($arena as $arenas){
      $this->getServer()->loadLevel($arenas);
    }
  }
    
    public function breakableBlocks(){
      $blocks = array(
        "Sandstone" => 24,
        "Obsidian" => 49,
        "Glass" => 20
        );
      return $blocks;
    }
    
    public function createVillager($x, $y, $z, $yaw, $pitch, Level $level,  Player $p){
        $nbt = new CompoundTag;
        $nbt->Pos = new ListTag("Pos", [
            new DoubleTag("", $x),
            new DoubleTag("", $y),
            new DoubleTag("", $z)
        ]);
        $nbt->Rotation = new ListTag("Rotation", [
            new DoubleTag("", $yaw),
            new DoubleTag("", $pitch)
        ]);
        $nbt->Motion = new ListTag("Motion", [
            new DoubleTag("", 0),
            new DoubleTag("", 0)
        ]);
        $nbt->Health = new ShortTag("Health", 10);
        $nbt->CustomNameVisible = new ByteTag("CustomNameVisible", 1);
        $level->loadChunk($x >> 4, $z >> 4);
        $villager = Entity::createEntity("Villager", $p->getLevel(), $nbt, $p);
        $villager->setNameTag("§eMarket");
        $villager->spawnToAll();
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
    
    public function getPlayers($arena){
      $ac = new Config($this->getDataFolder()."Arenas/$arena.yml", Config::YAML);
      return $ac->get("players");
    }

  
  public function arenaExists($arena)
  {
      $ac = new Config($this->getDataFolder() . "Arenas/$arena.yml", Config::YAML);
      if (file_exists($this->getDataFolder() . "Backups/$arena")) {
          if (file_exists($this->getDataFolder() . "Arenas/$arena")) {
              return true;
          } else {
              return false;
          }
      }
  }
}
