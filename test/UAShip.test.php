<?php

class UAShipTest extends \PHPUnit_Framework_TestCase{

    public function testMessage(){

        $e = new stdClass();
        $e->question = "what is your name ? ";

        $uaShip = new \Mapalagama\UAShip\UAShip("Tl1S4qwPSkmXN-FZ3Kgv9g", "wU9-KmAQRPOBqDVt8Mp6aQ");
        //add message
        $uaShip->addAlert("This is alert..!");

        //add channels
        $uaShip->addChannel(\Mapalagama\UAShip\UAShip::IOS,["bbb9ef52-5216-4259-84eb-9b3eccaf700d"]);
        //add extra
        $uaShip->addExtra($e);
        //send

        $uaShip->addBadge(1);
        echo $uaShip->send();

    }
}
