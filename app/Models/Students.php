<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class Students extends Model
{
    public static $tableName = "students";

    public static $connection = "mysql";

    
	private $id;
	private $nis;
	private $name;
	private $gender;
	private $rombels_id;
	private $rayons_id;
	private $birth_city;
	private $birth_date;
	private $religion;
	private $address;
	private $name_of_guardian;
	private $created_at;
	private $updated_at;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public static function findAllByNis($value) {
		return static::simpleQuery()->where('nis',$value)->get();
	}

	public static function findByNis($value) {
		return static::findBy('nis',$value);
	}

	public function getNis() {
		return $this->nis;
	}

	public function setNis($nis) {
		$this->nis = $nis;
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

	public static function findAllByGender($value) {
		return static::simpleQuery()->where('gender',$value)->get();
	}

	public static function findByGender($value) {
		return static::findBy('gender',$value);
	}

	public function getGender() {
		return $this->gender;
	}

	public function setGender($gender) {
		$this->gender = $gender;
	}

	public static function findAllByRombelsId($value) {
		return static::simpleQuery()->where('rombels_id',$value)->get();
	}

	/**
	* @return Rombels
	*/
	public function getRombelsId() {
		return Rombels::findById($this->rombels_id);
	}

	public function setRombelsId($rombels_id) {
		$this->rombels_id = $rombels_id;
	}

	public static function findAllByRayonsId($value) {
		return static::simpleQuery()->where('rayons_id',$value)->get();
	}

	/**
	* @return Rayons
	*/
	public function getRayonsId() {
		return Rayons::findById($this->rayons_id);
	}

	public function setRayonsId($rayons_id) {
		$this->rayons_id = $rayons_id;
	}

	public static function findAllByBirthCity($value) {
		return static::simpleQuery()->where('birth_city',$value)->get();
	}

	public static function findByBirthCity($value) {
		return static::findBy('birth_city',$value);
	}

	public function getBirthCity() {
		return $this->birth_city;
	}

	public function setBirthCity($birth_city) {
		$this->birth_city = $birth_city;
	}

	public static function findAllByBirthDate($value) {
		return static::simpleQuery()->where('birth_date',$value)->get();
	}

	public static function findByBirthDate($value) {
		return static::findBy('birth_date',$value);
	}

	public function getBirthDate() {
		return $this->birth_date;
	}

	public function setBirthDate($birth_date) {
		$this->birth_date = $birth_date;
	}

	public static function findAllByReligion($value) {
		return static::simpleQuery()->where('religion',$value)->get();
	}

	public static function findByReligion($value) {
		return static::findBy('religion',$value);
	}

	public function getReligion() {
		return $this->religion;
	}

	public function setReligion($religion) {
		$this->religion = $religion;
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

	public static function findAllByNameOfGuardian($value) {
		return static::simpleQuery()->where('name_of_guardian',$value)->get();
	}

	public static function findByNameOfGuardian($value) {
		return static::findBy('name_of_guardian',$value);
	}

	public function getNameOfGuardian() {
		return $this->name_of_guardian;
	}

	public function setNameOfGuardian($name_of_guardian) {
		$this->name_of_guardian = $name_of_guardian;
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