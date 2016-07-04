# UAShip
![Build Status](https://img.shields.io/wercker/ci/wercker/docs.svg)

Urban Airship library for Laravel 5

## Usage

##### Import
##
```php
use Mapalagama\UAShip\UAShip
```

#### Initilization
##
Initialize **UAShip** class with your *App Key* and *App Master Secret*
```php
$uaShip = new UAShip("**app_key_here**", "**app_master_secret**");
```

#### Alert
##
Add alert using **addAlert** method in **UAShip** class
```php
$uaShip->addAlert("This is alert");
```

#### Channels
##
Add channels using **addChannel** method. parameters,
1. Channel Type
    - ```UAShip::IOS``` for IOS Channels
    - ```UAShip::ANDROID``` for Android channels
2. Channel id

```php
$uaShip->addChannel(UAShip::IOS, "**Channel_id_here**");
$uaShip->addChannel(UAShip::ANDROID, "**Channel_id_here**");
```

#### Extra
##
Add extra data using **addExtra** method. parameters,
1. Extra - *Generic class or stdClass required. This parameter will encode to a json before sending*

```php
$extra = new stdClass();
$extra->question = "what is your name ?";

$uaShip->addExtra($e);
```
#### Send Message
##
Send notification using **send** method.
```php
$result = $uaShip->send();
```
**SUCCESS MESSAGE ```$result```**
```json
{
  "ok": true,
  "operation_id": "**operation_id**",
  "push_ids": [
    "**push_id**"
  ],
  "message_ids": [],
  "content_urls": []
}
```

**ERROR MESSAGE ```$result```** 

*error* field contains the reason
```json
{
  "ok": false,
  "error": "Unauthorized", 
  "error_code": 40101
}
```



## Full code
##
```php
   //initialization
    $uaShip = new UAShip("**APP_KEY**", "**APP_MASTER_SECRET**");
    
    //add alert message
    $uaShip->addAlert("This is alert");

    //add channels
    $uaShip->addChannel(UAShip::IOS, "**CHANNEL_ID**");
    $uaShip->addChannel(UAShip::ANDROID, "**CHANNEL_ID**");

    //add extra
    $extra = new stdClass();
    $extra->question = "what is your name ?";
    $uaShip->addExtra($extra);

    //send
    echo $uaShip->send();
    
```


## Whats's in Next Version
- push using device token
- push using tags and device types
- scheduling
- more...

## License

UAShip is released under the [MIT License](LICENSE).










