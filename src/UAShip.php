<?php
/**
 * Created by PhpStorm.
 * User: treineticsixmac
 * Date: 7/4/16
 * Time: 3:02 PM
 */

namespace Mapalagama\UAShip;

//{
//    "audience": {
//    "AND": [
//                {"ios_channel": "61805103-d25c-4a15-9077-d36d247a2976"},
//                {"ios_channel": "23830584-fe52-46e2-8234-3bfe0cc8eb28"}
//             ]
//          },
//          "notification": {
//    "alert" : "A broadcast message we" ,
//              "ios": {
//        "extra": {
//            "url": "http://example.com",
//                "story_id": "1234",
//                "moar": {"key": "value"}
//         }
//        }
//          },
//          "device_types": "all"
//
//}
class UAShip
{

    //message types
    const IOS = "ios_channel";
    const ANDROID = "android_channel";

    //store username and password
    private $app_key;
    private $master_key;

    //inner data
    private $audience = array();
    private $alert = null;
    private $extra = null;
    private $message = null;
    private $badge = null;

    public function __construct($appKey, $masterKey)
    {
        $this->app_key = $appKey;
        $this->master_key = $masterKey;
        $this->message = new \stdClass();
    }

    public function addExtra($json)
    {
        $this->extra = $json;
    }

    public function addChannel($type, $channel)
    {
        $this->audience[] = [$type, $channel];
    }

    public function addAlert($alert)
    {
        $this->alert = $alert;
    }

    public function addBadge($count = 1)
    {
        $this->badge = "+" . $count;
    }


    public function send()
    {
        $_j = $this->buildJson();
        return $this->curl($_j);
    }

    private function buildJson()
    {
        //devices
        $_audience = new \stdClass();
        $_AND = array();
        foreach ($this->audience as $device) {
            $eachDevice = new \stdClass();
            $eachDevice->{$device[0]} = $device[1];
            $_AND[] = $eachDevice;
        }
        $_audience->OR = $_AND;

        //notifications
        $notification = new \stdClass();
        $notification->alert = $this->alert;

        //ios
        $ios = new \stdClass();
        $ios->extra = $this->extra;
        if ($this->badge != null) {
            $ios->badge = $this->badge;
        }
        $notification->ios = $ios;

        //android
        $android = new \stdClass();
        $android->extra = $this->extra;

        $notification->android = $android;

        $this->message->audience = $_audience;
        $this->message->notification = $notification;
        $this->message->device_types = ["ios", "android"];
        var_dump(json_encode($this->message));
        return json_encode($this->message);

    }


    private function curl($body)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://go.urbanairship.com/api/push/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/vnd.urbanairship+json; version=3',
            'Authorization: Basic ' . base64_encode($this->app_key . ":" . $this->master_key)
        ));
        $result = curl_exec($ch);

        return $result;
    }
}