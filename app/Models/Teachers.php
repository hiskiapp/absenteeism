<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class Teachers extends Model
{
    public static $tableName = "teachers";

    public static $connection = "mysql";

    
	private $id;
	private $code;
	private $name;
	private $subjects;
	private $position;
	private $address;
	private $is_teacher;
	private $created_at;
	private $updated_at;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public static function findAllByCode($value) {
		return static::simpleQuery()->where('code',$value)->get();
	}

	public static function findByCode($value) {
		return static::findBy('code',$value);
	}

	public function getCode() {
		return $this->code;
	}

	public function setCode($code) {
		$this->code = $code;
	}

	public static function findAllByName($value) {
		return static::simpleQuery()->where('name',$value)->get();
	}

	public static function findByName($value) {
		return static::findBy('name',$value);
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public static function findAllBySubjects($value) {
		return static::simpleQuery()->where('subjects',$value)->get();
	}

	public static function findBySubjects($value) {
		return static::findBy('subjects',$value);
	}

	public function getSubjects() {
		return $this->subjects;
	}

	public function setSubjects($subjects) {
		$this->subjects = $subjects;
	}

	public static function findAllByPosition($value) {
		return static::simpleQuery()->where('position',$value)->get();
	}

	public static function findByPosition($value) {
		return static::findBy('position',$value);
	}

	public function getPosition() {
		return $this->position;
	}

	public function setPosition($position) {
		$this->position = $position;
	}

	public static function findAllByAddress($value) {
		return static::simpleQuery()->where('address',$value)->get();
	}

	public static function findByAddress($value) {
		return static::findBy('address',$value);
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public static function findAllByIsTeacher($value) {
		return static::simpleQuery()->where('is_teacher',$value)->get();
	}

	public static function findByIsTeacher($value) {
		return static::findBy('is_teacher',$value);
	}

	public function getIsTeacher() {
		return $this->is_teacher;
	}

	public function setIsTeacher($is_teacher) {
		$this->is_teacher = $is_teacher;
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