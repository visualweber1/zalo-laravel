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
		$this->id = isset($providerUser["id"]) ? $providerUser["id"] : null;
		$this->name = isset($providerUser["name"]) ? $providerUser["name"] : null;
		$this->avatar_original = isset($providerUser["picture"]["data"]["url"]) ? $providerUser["picture"]["data"]["url"] : null; 
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
