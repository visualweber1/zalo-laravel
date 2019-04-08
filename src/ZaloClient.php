<?php

namespace Visualweber\Zalo;

use Zalo\Zalo;
use Zalo\ZaloEndpoint;

class ZaloClient
{

    /** @var self */
    protected static $instance;

    protected $appId;
    protected $appSecret;
    protected $oaId;
    protected $oaSecret;
    protected $url_callback;
    protected $option;

    protected $zalo;

    public function __construct($appId,$appSecret,$oaId = null,$oaSecret =null,$option = [])
    {


        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->oaId = $oaId;
        $this->oaSecret = $oaSecret;
        $this->url_callback = $option['url_callback'];
        $this->option = $option;
        $this->zalo = new Zalo($this->getConfig());
    }

    // /**
    //  * Get a singleton instance of the class
    //  *
    //  * @return self
    //  * @codeCoverageIgnore
    //  */
    // public static function getInstance() {
    // 	echo $this->appId;
    //     // if (!self::$instance) {
    //     //     self::$instance = new self($this->appId,$this->appSecret,$this->oaId,$this->oaSecret,$this->option);
    //     // }
    //     // return self::$instance;
    // }

    /**
     * Get zalo sdk config
     * @return []
     */
    public function getConfig() {
        return [
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
            'oa_id' => $this->oaId,
            'oa_secret' => $this->oaSecret
        ];
    }

    //Lấy link đăng nhập
    public function loginZalo()
    {
        $helper = $this->zalo->getRedirectLoginHelper();
        $callBackUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']."/".$this->url_callback;
        return $helper->getLoginUrl($callBackUrl); // This is login url   
    }

    public function getAccessToken()
    {
        $callBackUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']."/".$this->url_callback;
        $oauthCode = isset($_GET['code']) ? $_GET['code'] : "THIS NOT CALLBACK PAGE !!!"; // get oauthoauth code from url params
        $accessToken = $helper->getAccessToken($callBackUrl); // get access token
        if ($accessToken != null) {
            $this->accessToken = $accessToken;
            $expires = $accessToken->getExpiresAt(); // get expires time
        }
        return $accessToken;
    }

    public function getInfoUserThenLogin()
    {
        $accessToken = $this->getAccessToken();
        $params = [];
        $response = $zalo->get(ZaloEndpoint::API_GRAPH_ME, $params, $accessToken);
        return $response->getDecodedBody(); // result
    }
    
    public function getInfoUserFromAccessToken($accessToken)
    {
        $params = [];
        $response = $this->zalo->get(ZaloEndpoint::API_GRAPH_ME, $params, $accessToken);
        return $response->getDecodedBody(); // result
    }
}
