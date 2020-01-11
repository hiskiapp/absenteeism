<?php
namespace App\Repositories;

use DB;
use App\Models\Settings;

class SettingsRepository extends Settings
{
    // TODO : Make you own query methods
	public static function initial(){
		$settings = Settings::simpleQuery()->first();
		if (!$settings) {
			$insert[] = [
				'slug' => 'title',
				'title' => 'Title',
				'content' => 'SMK Wikrama 1 Jepara'
			];
			$insert[] = [
				'slug' => 'time_in',
				'title' => 'Jam Masuk',
				'content' => '07:00'
			];
			$insert[] = [
				'slug' => 'time_out',
				'title' => 'Jam Keluar',
				'content' => '16:00'
			];
			$insert[] = [
				'slug' => 'set_alpa',
				'title' => 'Set Alpa',
				'content' => '10:00'
			];
			$insert[] = [
				'slug' => 'set_bolos',
				'title' => 'Set Bolos',
				'content' => '17:00'
			];

			Settings::simpleQuery()->insert($insert);
		}

		return true;
	}
}