<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    protected $status = 0;
	protected $info = '';
	protected $data = [];
	protected $format = 'json';
	
	 public function __construct()
    {
		
    }
	
	public function view($path, $data, $format = '')
	{
		if(empty($format)) 
			$format = $this->format;
		if($format == 'json') {
			return json_encode([
				'status' => $this->status,
				'info' => $this->info,
				'data' => $data,
			]);
		} else {
			return view($path, $data);
		}
	}
}
