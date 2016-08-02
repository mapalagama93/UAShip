<?php

class UAShipTest extends \PHPUnit_Framework_TestCase{

    public function testMessage(){

        $e = new stdClass();
        $e->question = "what is your name ? ";

        $uaShip = new \Mapalagama\UAShip\UAShip("-FZ3Kgv9g", "wU9-");
        //add message
        $uaShip->addAlert("This is alert..!");

        //add channels
        $uaShip->addChannel(\Mapalagama\UAShip\UAShip::IOS,["d30767fa--4513--"]);
        //add extra
        $uaShip->addExtra($e);
        //send

        $uaShip->addBadge(1);
        echo $uaShip->send();

    }
}
