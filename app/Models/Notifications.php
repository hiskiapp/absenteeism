<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class Notifications extends Model
{
    public static $tableName = "notifications";

    public static $connection = "mysql";

    
	private $id;
	private $icon;
	private $color;
	private $title;
	private $description;
	private $url;
	private $is_read;
	private $created_at;
	private $updated_at;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public static function findAllByIcon($value) {
		return static::simpleQuery()->where('icon',$value)->get();
	}

	public static function findByIcon($value) {
		return static::findBy('icon',$value);
	}

	public function getIcon() {
		return $this->icon;
	}

	public function setIcon($icon) {
		$this->icon = $icon;
	}

	public static function findAllByColor($value) {
		return static::simpleQuery()->where('color',$value)->get();
	}

	public static function findByColor($value) {
		return static::findBy('color',$value);
	}

	public function getColor() {
		return $this->color;
	}

	public function setColor($color) {
		$this->color = $color;
	}

	public static function findAllByTitle($value) {
		return static::simpleQuery()->where('title',$value)->get();
	}

	public static function findByTitle($value) {
		return static::findBy('title',$value);
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
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

	public static function findAllByUrl($value) {
		return static::simpleQuery()->where('url',$value)->get();
	}

	public static function findByUrl($value) {
		return static::findBy('url',$value);
	}

	public function getUrl() {
		return $this->url;
	}

	public function setUrl($url) {
		$this->url = $url;
	}

	public static function findAllByIsRead($value) {
		return static::simpleQuery()->where('is_read',$value)->get();
	}

	public static function findByIsRead($value) {
		return static::findBy('is_read',$value);
	}

	public function getIsRead() {
		return $this->is_read;
	}

	public function setIsRead($is_read) {
		$this->is_read = $is_read;
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