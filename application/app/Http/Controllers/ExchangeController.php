<?php

namespace App\Http\Controllers;

use App\Request;
use App\Rate;
use App\Api;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class ExchangeController extends Controller
{
    private $request;
    private $rate;
    private $api;

    public function __construct(Request $request,Rate $rate,Api $api)
    {
        $this->request = $request;
        $this->rate = $rate;
        $this->api = $api;
    }

    public function saveData()
    {
        $data = $this->api->getData(config('api.host'))->json();

        $message = 'Udało się pobrać dane ';

        if (!$this->request->checkRecordExists($data[0]['no']))
        {
            try {
                DB::transaction(function () use ($data) {
                    $request_id = $this->request->saveData($data[0]);
                    foreach ($data[0]['rates'] as $rate_data) {
                        $this->rate->saveData($rate_data,$request_id);
                    }
                });
                $message .= 'Udało się zapisać obecny request.';
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                $message .= 'Nie udało się zapisać obecnego requesta.';
            }
        }

        return Response::json($message);
        //return view('exchange.save_courses');
    }

    public function courses()
    {
        return Response::json($this->rate->getNewestRates());
        //return view('exchange.courses', ['rates' => $this->rate->getNewestRates()]);
    }

    public function oldCourses(?string $code = NULL,?string $orderBy = NULL,?string $date = NULL)
    {
        return Response::json($this->rate->getOldRates($code,$orderBy,$date));
        //return view('exchange.old_courses', ['rates' => $this->rate->getOldRates($code,$orderBy,$date)]);
    }
}
