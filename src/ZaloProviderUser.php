<?php
namespace Visualweber\Zalo;

class ZaloProviderUser
{
	protected $email = null;
	protected $id;
	protected $name;
	public $avatar_original;

	public $token;

	public function __construct($providerUser)
	{
		$this->id = isset($providerUser["token"]["id"]) ? $providerUser["token"]["id"] : null;
		$this->name = isset($providerUser["token"]["name"]) ? $providerUser["token"]["name"] : null;
		$this->avatar_original = isset($providerUser["token"]["picture"]["data"]["url"]) ? $providerUser["token"]["picture"]["data"]["url"] : null; 
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->name;
	}
}