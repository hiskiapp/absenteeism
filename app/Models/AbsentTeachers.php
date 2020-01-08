<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class AbsentTeachers extends Model
{
    public static $tableName = "absent_teachers";

    public static $connection = "mysql";

    
	private $id;
	private $date;
	private $time_in;
	private $teachers_id;
	private $type;
	private $is_out;
	private $photo;
	private $created_at;
	private $updated_at;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public static function findAllByDate($value) {
		return static::simpleQuery()->where('date',$value)->get();
	}

	public static function findByDate($value) {
		return static::findBy('date',$value);
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	public static function findAllByTimeIn($value) {
		return static::simpleQuery()->where('time_in',$value)->get();
	}

	public static function findByTimeIn($value) {
		return static::findBy('time_in',$value);
	}

	public function getTimeIn() {
		return $this->time_in;
	}

	public function setTimeIn($time_in) {
		$this->time_in = $time_in;
	}

	public static function findAllByTeachersId($value) {
		return static::simpleQuery()->where('teachers_id',$value)->get();
	}

	/**
	* @return Teachers
	*/
	public function getTeachersId() {
		return Teachers::findById($this->teachers_id);
	}

	public function setTeachersId($teachers_id) {
		$this->teachers_id = $teachers_id;
	}

	public static function findAllByType($value) {
		return static::simpleQuery()->where('type',$value)->get();
	}

	public static function findByType($value) {
		return static::findBy('type',$value);
	}

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public static function findAllByIsOut($value) {
		return static::simpleQuery()->where('is_out',$value)->get();
	}

	public static function findByIsOut($value) {
		return static::findBy('is_out',$value);
	}

	public function getIsOut() {
		return $this->is_out;
	}

	public function setIsOut($is_out) {
		$this->is_out = $is_out;
	}

	public static function findAllByPhoto($value) {
		return static::simpleQuery()->where('photo',$value)->get();
	}

	public static function findByPhoto($value) {
		return static::findBy('photo',$value);
	}

	public function getPhoto() {
		return $this->photo;
	}

	public function setPhoto($photo) {
		$this->photo = $photo;
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