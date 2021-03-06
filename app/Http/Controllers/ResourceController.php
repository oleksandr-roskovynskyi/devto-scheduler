<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use Auth;
use App\Events\NewResourceEvent;

class ResourceController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth');

	}

	public function add(Request $request)
	{

		$resource = Resource::create([
			'title' => $request->title
		]);

		event(new NewResourceEvent($resource->toArray()));

	}

	public function index()
	{

		$outputData = array();

		$resources = Resource::all();

		$resources->each(function($r) use(&$outputData) {

			$outputData[] = array(
				'id' => $r->id,
				'title' => $r->title
			);

		});

		return response()->json($outputData);

	}

}