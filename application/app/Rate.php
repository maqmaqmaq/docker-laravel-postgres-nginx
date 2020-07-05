<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Watson\Validating\ValidatingTrait;

class Rate extends Model
{
    use ValidatingTrait;

    public $timestamps = false;

    protected $fillable = ['currency','code','mid','request_id'];

    protected $rules = [
        'currency' => 'required|max:30',
        'code' => 'required|max:3',
        'mid' => 'required|numeric',
        'request_id' => 'required|integer'
    ];

    public function requests()
    {
        return $this->belongsTo('App\Request');
    }

    public function getOldRates(?string $code = NULL,?string $orderBy = NULL,?string $date = NULL)
    {
        $rates = DB::table('rates')
                           ->select('currency','code','mid','effective_date')
                           ->leftJoin('requests', 'requests.id', '=', 'rates.request_id');

        if (!is_null($code))
        {
            $rates = $rates->where('rates.code','=',$code);
        }

        if (!is_null($date))
        {
            $rates = $rates->where('requests.effective_date','=',$date);
        }

        if (!is_null($orderBy))
        {
            $allowed_columns = ['currency','code','mid','no','effective_date'];
            if (in_array($orderBy,$allowed_columns))
            {
                $rates = $rates->orderBy($orderBy,"DESC");
            }
        }

        return $rates->get();
    }

    public function getNewestRates()
    {
        $request = DB::table('requests')->select('id')->orderBy('effective_date','DESC')->first();
        if (!is_null($request))
        return $this->select('currency','code','mid')
                    ->where('request_id',$request->id)
                    ->get();
    }

    public function saveData(?array $data,?int $request_id):void
    {
        $data['request_id'] = $request_id;
        Rate::create($data);
    }
}
