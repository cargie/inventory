<?php

namespace App\Classes;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;


class ViewSettingsBag
{
	protected $settings;

	public function __construct()
	{
		$this->settings();
	}

	public function settings()
	{
		$this->settings = Cache::rememberForever('view-settings-variable', function () {
			return Setting::all();
		});
	}

	public function transform()
	{
		return $this->settings->map(function ($setting) {
			return [$setting->key => $setting->value];
		})->collapse();
	}

	public function toArray()
	{
		return $this->transform()->all();
	}

	public function toJson($options = 0)
	{
		return json_encode($this->toArray(), $options);
	}

	public function __toString()
	{
		return $this->toJson();
	}

	public function get($key, $default = null)
	{
		$settings = $this->toArray();

		return Arr::get($settings, $key, $default);
	}

	public function set($key, $value = null)
	{
		Setting::updateOrCreate([
			'key' => $key
		], [
			'key' => $key,
			'value' => $value
		]);
		return $this;
	}

	public function __get($key)
	{
		return $this->get($key);
	}

	public function __set($key, $value = null)
	{
		return $this->get($key, $value);
	}
}