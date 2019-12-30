<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class LogBackend extends Model
{
    public static $tableName = "log_backend";

    public static $connection = "mysql";

    
	private $id;
	private $action;
	private $page;
	private $description;
	private $created_at;
	private $updated_at;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public static function findAllByAction($value) {
		return static::simpleQuery()->where('action',$value)->get();
	}

	public static function findByAction($value) {
		return static::findBy('action',$value);
	}

	public function getAction() {
		return $this->action;
	}

	public function setAction($action) {
		$this->action = $action;
	}

	public static function findAllByPage($value) {
		return static::simpleQuery()->where('page',$value)->get();
	}

	public static function findByPage($value) {
		return static::findBy('page',$value);
	}

	public function getPage() {
		return $this->page;
	}

	public function setPage($page) {
		$this->page = $page;
	}

	public static function findAllByDescription($value) {
		return static::simpleQuery()->where('description',$value)->get();
	}

	public static function findByDescription($value) {
		return static::findBy('description',$value);
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
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

	public static function findAllByUpdatedAt($value) {
		return static::simpleQuery()->where('updated_at',$value)->get();
	}

	public static function findByUpdatedAt($value) {
		return static::findBy('updated_at',$value);
	}

	public function getUpdatedAt() {
		return $this->updated_at;
	}

	public function setUpdatedAt($updated_at) {
		$this->updated_at = $updated_at;
	}


}