<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class PasswordResets extends Model
{
    public static $tableName = "password_resets";

    public static $connection = "mysql";

    
	private $email;
	private $token;
	private $created_at;


    
	public static function findAllByEmail($value) {
		return static::simpleQuery()->where('email',$value)->get();
	}

	public static function findByEmail($value) {
		return static::findBy('email',$value);
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public static function findAllByToken($value) {
		return static::simpleQuery()->where('token',$value)->get();
	}

	public static function findByToken($value) {
		return static::findBy('token',$value);
	}

	public function getToken() {
		return $this->token;
	}

	public function setToken($token) {
		$this->token = $token;
	}

	public static function findAllByCreatedAt($value) {
		return static::simpleQuery()->where('created_at',$value)->get();
	}

	public static function findByCreatedAt($value) {
		return static::findBy('created_at',$value);
	}

	public function getCreatedAt() {
		return $this->created_at;
	}

	public function setCreatedAt($created_at) {
		$this->created_at = $created_at;
	}


}