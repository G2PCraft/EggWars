<?php

namespace EggWars;

use EggWars\EggWars;
use pocetmine\command\Command;
use pocetmine\command\CommandSender;
use pocketmine\Player;

class EggWarsCommand extends Command{

    public function __construct(){
        parent::__construct("ew", "EggWars command");
    }

    public function execute(CommandSender $p, $label, array $args)
    {
        $main = EggWars::getInstance();
        $this->main = $main
        if ($p instanceof Player and $g->isOp()) {
            if (!empty($args[0])) {
                if ($args[0] == "help") {
                    $p->sendMessage("/Ew setup");
                } elseif ($args[0] == "create") {
                    if (!empty($args[1])) {
                               if(!$main->arenaExists($args[1]));
                        $this->main->createBackup($args[1]);
                        $p->sendMessage("§aCreating new arena...");
                        $ac = new Config($main->getDataFolder() . "Arenas/$args[1].yml", Config::YAML);
                        #RED
                        $ac->set("red-spawn-x", 0);
                        $ac->set("red-spawn-y", 0);
                        $ac->set("red-spawn-z", 0);
                        $ac->set("red-egg-x", 0);
                         $ac->set("red-egg-y", 0);
                         $ac->set("red-egg-z", 0);
                        #GREEN
                        $ac->set("green-spawn-x", 0);
                        $ac->set("green-spawn-y", 0);
                        $ac->set("green-spawn-z", 0);
                        $ac->set("green-egg-x", 0);
                         $ac->set("green-egg-y", 0);
                         $ac->set("green-egg-z", 0);
                        #YELLOW
                        $ac->set("yellow-spawn-x", 0);
                        $ac->set("yellow-spawn-y", 0);
                        $ac->set("yellow-spawn-z", 0);
                        $ac->set("yellow-egg-x", 0);
                         $ac->set("yellow-egg-y", 0);
                         $ac->set("yellow-egg-z", 0);
                        #BLUE
                        $ac->set("blue-spawn-x", 0);
                        $ac->set("blue-spawn-y", 0);
                        $ac->set("blue-spawn-z", 0);
                        $ac->set("blue-egg-x", 0);
                         $ac->set("blue-egg-y", 0);
                         $ac->set("blue-egg-z", 0);
                        $ac->save();
                        $p->sendMessage("§eArena is created now set all positions in arena config");
                       
                            } else {
                                $p->sendMessage("arena exist");
                            }
                        } else {
                            $p->sendMessage("Chybi args1');
                        }
                } elseif ($args[0] == "setlobby") {
                    if (!empty($args[1])) {
                        if($main->arenaExists()){
                            $ac = new Config($main->getDataFolder() . "Arenas/$args[1].yml", Config::YAML);
                            $ac->set("LobbyX", $p->getX());
                            $ac->set("LobbyY", $p->getY());
                             $ac->set("LobbyZ", $p->getX());
                              $ac->set("LobbyYaw", $p->getYaw());
                              $ac->set("LobbyPitch", $p->getPitch());
                            $ac->set("LobbyWorld", $p->getLevel()->getFolderName());
                            $ac->save();
                        } else {
                            $g->sendMessage("Arena not found!!!!");
                        }
                    } else {
                        $g->sendMessage("Je to /setlobby <arena> !!!!!!!!!");
                    }
               } elseif ($args[0] == "addshop") {
                    $this->createVillager($p->x, $p->y, $p->z, $p->yaw, $p->pitch, $p->getLevel(), $p);
            } else {
                $g->sendMessage("§6Not permission");
            }
        }
    }

