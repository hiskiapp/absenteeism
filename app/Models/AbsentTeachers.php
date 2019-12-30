<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class AbsentTeachers extends Model
{
    public static $tableName = "absent_teachers";

    public static $connection = "mysql";

    
	private $id;
	private $teachers_id;
	private $reason;
	private $date;
	private $created_at;
	private $updated_at;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
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

	public static function findAllByReason($value) {
		return static::simpleQuery()->where('reason',$value)->get();
	}

	public static function findByReason($value) {
		return static::findBy('reason',$value);
	}

	public function getReason() {
		return $this->reason;
	}

	public function setReason($reason) {
		$this->reason = $reason;
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