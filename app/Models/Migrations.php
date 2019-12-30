<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class Migrations extends Model
{
    public static $tableName = "migrations";

    public static $connection = "mysql";

    
	private $id;
	private $migration;
	private $batch;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public static function findAllByMigration($value) {
		return static::simpleQuery()->where('migration',$value)->get();
	}

	public static function findByMigration($value) {
		return static::findBy('migration',$value);
	}

	public function getMigration() {
		return $this->migration;
	}

	public function setMigration($migration) {
		$this->migration = $migration;
	}

	public static function findAllByBatch($value) {
		return static::simpleQuery()->where('batch',$value)->get();
	}

	public static function findByBatch($value) {
		return static::findBy('batch',$value);
	}

	public function getBatch() {
		return $this->batch;
	}

	public function setBatch($batch) {
		$this->batch = $batch;
	}


}