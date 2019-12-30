<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class Payroll extends Model
{
    public static $tableName = "payroll";

    public static $connection = "mysql";

    
	private $id;
	private $month;
	private $teachers_id;
	private $nominal;
	private $created_at;
	private $updated_at;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public static function findAllByMonth($value) {
		return static::simpleQuery()->where('month',$value)->get();
	}

	public static function findByMonth($value) {
		return static::findBy('month',$value);
	}

	public function getMonth() {
		return $this->month;
	}

	public function setMonth($month) {
		$this->month = $month;
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

	public static function findAllByNominal($value) {
		return static::simpleQuery()->where('nominal',$value)->get();
	}

	public static function findByNominal($value) {
		return static::findBy('nominal',$value);
	}

	public function getNominal() {
		return $this->nominal;
	}

	public function setNominal($nominal) {
		$this->nominal = $nominal;
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