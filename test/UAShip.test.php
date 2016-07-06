<?php

class UAShipTest extends \PHPUnit_Framework_TestCase{

    public function testMessage(){

        $e = new stdClass();
        $e->question = "what is your name ? ";

        $uaShip = new \Mapalagama\UAShip\UAShip("sfdsds", "dsdsd");
        //add message
        $uaShip->addAlert("This is alert..!");

        //add channels
        $uaShip->addChannel(\Mapalagama\UAShip\UAShip::IOS,["a", "b", "c"]);
        $uaShip->addChannel(\Mapalagama\UAShip\UAShip::ANDROID, ["d", "e", "f"] );
        //add extra
        $uaShip->addExtra($e);
        //send
        echo $uaShip->send();

    }
}
