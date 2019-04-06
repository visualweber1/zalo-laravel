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
  
 3. Config Zalo App
 
    php artisan vendor:publish then choose Visualweber\Zalo\ZaloServiceProvider then enter
    
    You can show file zalo.php in config folder
