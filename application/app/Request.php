<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Watson\Validating\ValidatingTrait;

class Request extends Model
{
    use ValidatingTrait;

    public $timestamps = false;

    protected $fillable = ['table_name','no','effective_date'];

    protected $rules = [
        'table_name' => 'required|max:1',
        'no' => 'required|max:30',
        'effective_date' => 'required|date'
    ];

    public function rates()
    {
        return $this->hasMany('App\Rate');
    }

    public function checkRecordExists(?string $request_number)
    {
        return DB::select('select id FROM requests WHERE no = :no', ['no' => $request_number]);
    }

    public function saveData(?array $data):int
    {
        $data['table_name'] = $data['table'];
        $data['effective_date'] = $data['effectiveDate'];
        $request = Request::create($data);

        return $request->id;
    }
}
