<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Message;

class MessageController extends Controller
{
    public function send($phone,$msg)
	{
		// $msg 	= request()->message;
		// $phone 	= request()->phone;

		$client = new Client(); //GuzzleHttp\Client

		$res = $client->request('POST', 'https://api.wassenger.com/v1/messages', [
		    'body' => '{"phone":"+'.$phone.'","message":"'.$msg.'"}',
		    'headers' => [
		    		'token' => '11ae87fe6fcf4ec19e72e98897a495fabc43b29ea0a1f17b912bbd12b592e0b3bf799cd68e173074',
		    		'content-type' => 'application/json'
		        ]
		]);

		return $res;
	}

	public function create()
	{
		Message::create( request()->all() );
	}


	public function test()
	{
		$duration = (6 * 60);
		$periods[1] = strtotime("07:59 PM");
		$excecute_period = null;
		$date = date("Y-m-d", time());
		$msgs = [];
		$responses = [];

		foreach ($periods as $id => $period_start) {
			if (time() > ($period_start-$duration) && time() < ($period_start+$duration)) $excecute_period = $id;
		}

		if (!is_null($excecute_period)) {

			$shifts = \App\Shift::where('table',1)->where('date', $date)->where('period',$excecute_period)->get();
			
			foreach ($shifts as $shift) {
				if (!is_null($shift->employee)) {
					$msgs[] = [
						"phone" => $shift->employee->phone,
						"msg" => "مرحبا  *".$shift->employee->name."*  👋                  ورديتك تبدأ في الساعة  : 🕒 *".date("h:i a",$periods[$excecute_period])."*                نرجو الإستعداد 👍"
					];
					foreach ($msgs as $msg) {
						$responses[] = $this->send($msg["phone"],$msg["msg"]);
					}
				}
			}

		}

		return array($msgs, $responses);
	}
}
