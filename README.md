# zalo-laravel
Zalo For laravel
1. How to install

    composer require visualweber1/zalo-laravel
    
2.Add to config/app.php

    Service Providers...
    'providers'=>[
      Visualweber\Zalo\ZaloServiceProvider::class,
    ]
    
    aliases....
    
    'aliases'=>[
      'Zalo' => Visualweber\Zalo\ZaloFacade::class,
    ]
