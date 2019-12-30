<?php
namespace App\Models;

use DB;
use Crocodicstudio\Cbmodel\Core\Model;

class FailedJobs extends Model
{
    public static $tableName = "failed_jobs";

    public static $connection = "mysql";

    
	private $id;
	private $connection;
	private $queue;
	private $payload;
	private $exception;
	private $failed_at;


    
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public static function findAllByConnection($value) {
		return static::simpleQuery()->where('connection',$value)->get();
	}

	public static function findByConnection($value) {
		return static::findBy('connection',$value);
	}

	public function getConnection() {
		return $this->connection;
	}

	public function setConnection($connection) {
		$this->connection = $connection;
	}

	public static function findAllByQueue($value) {
		return static::simpleQuery()->where('queue',$value)->get();
	}

	public static function findByQueue($value) {
		return static::findBy('queue',$value);
	}

	public function getQueue() {
		return $this->queue;
	}

	public function setQueue($queue) {
		$this->queue = $queue;
	}

	public static function findAllByPayload($value) {
		return static::simpleQuery()->where('payload',$value)->get();
	}

	public static function findByPayload($value) {
		return static::findBy('payload',$value);
	}

	public function getPayload() {
		return $this->payload;
	}

	public function setPayload($payload) {
		$this->payload = $payload;
	}

	public static function findAllByException($value) {
		return static::simpleQuery()->where('exception',$value)->get();
	}

	public static function findByException($value) {
		return static::findBy('exception',$value);
	}

	public function getException() {
		return $this->exception;
	}

	public function setException($exception) {
		$this->exception = $exception;
	}

	public static function findAllByFailedAt($value) {
		return static::simpleQuery()->where('failed_at',$value)->get();
	}

	public static function findByFailedAt($value) {
		return static::findBy('failed_at',$value);
	}

	public function getFailedAt() {
		return $this->failed_at;
	}

	public function setFailedAt($failed_at) {
		$this->failed_at = $failed_at;
	}


}