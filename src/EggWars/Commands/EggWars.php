<?php

namespace EggWars;

class EggWarsCommand extends Command{

    public function __construct(){
        parent::__construct("ew", "EggWars command");
    }

    public function execute(CommandSender $p, $label, array $args)
    {
        $main = EggWars::getInstance();
        if ($p instanceof Player and $g->isOp()) {
            if (!empty($args[0])) {
                if ($args[0] == "help") {
                    $p->sendMessage("/Ew setup");
                } elseif ($args[0] == "create") {
                    if (!empty($args[1])) {
                               if(!$main->arenaExists($args[1]));
                            } else {
                                $p->sendMessage("arena exist");
                            }
                        } else {
                            $p->sendMessage("Chybi args1');
                        }
                } elseif ($args[0] == "setlobby") {
                    if (!empty($args[1])) {
                        if($main->arenaExists()){
                            $ac = new Config($main->getDataFolder() . "Arenalas/$args[1].yml", Config::YAML);
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
                        $g->sendMessage(Je to /setlobby <arena> !!!!!!!!!");
                    }
               } elseif ($args[0] == "addshop") {
                    $this->createVillager($p->x, $p->y, $p->z, $p->yaw, $p->pitch, $p->getLevel(), $p);
            } else {
                $g->sendMessage("§6Not permission");
            }
        }
    }

