<?php

class UAShipTest extends \PHPUnit_Framework_TestCase{

    public function testMessage(){

        $e = new stdClass();
        $e->question = "what is your name ? ";

        $uaShip = new Mapalagama\UAShip\UAShip("", "");
        //add message
        $uaShip->addAlert("This is alert..!");

        //add channels
        $uaShip->addChannel(Mapalagama\UAShip\UAShip::IOS, "");
        $uaShip->addChannel(Mapalagama\UAShip\UAShip::IOS, "");
        //add extra
        $uaShip->addExtra($e);
        //send
        echo $uaShip->send();

    }
}
