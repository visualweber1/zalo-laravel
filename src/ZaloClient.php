<?php

namespace Visualweber\Zalo;

use Zalo\Zalo;

class ZaloClient
{

    /** @var self */
    protected static $instance;

    protected $appId;
    protected $appSecret;
    protected $oaId;
    protected $oaSecret;
    protected $url_callback;

    protected $zalo;

    public function __construct($appId,$appSecret,$oaId,$oaSecret,$option = [])
    {


        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->oaId = $oaId;
        $this->oaSecret = $oaSecret;
        $this->url_callback = $option['url_callback'];

        $this->zalo = new Zalo($this->getInstance()->getConfig());
    }

    /**
     * Get a singleton instance of the class
     *
     * @return self
     * @codeCoverageIgnore
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get zalo sdk config
     * @return []
     */
    public function getConfig() {
        return [
            'app_id' => static::appId,
            'app_secret' => static::appSecret,
            'oa_id' => static::oaId,
            'oa_secret' => static::oaSecret
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

}
