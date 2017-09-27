<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingAPIController extends Controller
{

	protected $settingRepository;

	public function __construct(SettingRepository $settingRepo)
	{
		$this->settingRepository = $settingRepo;
	}

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'key' => 'required',
    	]);

    	$settings = $this->settingRepository->updateOrCreate([
    		'key' => $request->key,
    	], [
    		'key' => $request->key,
    		'value' => $request->value
    	]);
    }
}
