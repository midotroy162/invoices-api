<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoiceFilter extends ApiFilter{
    protected $safeParms = [
            "id"=> ['eq'],
            "customerId"=> ['eq','lt','lte','gt','gte'],
            "amount"=> ['eq','lt','lte','gt','gte'],
            "status"=> ['eq','ne'],
            "billedDate"=>['eq','lt','lte','gt','gte'],
            "paidDate"=>['eq','lt','lte','gt','gte'],
    ];
    protected $columnMap = [
        'customerId'=>'customer_id',
        "billedDate"=>'billed_date',
        "paidDate"=>'paid_date',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne'=> '!=',
    ];
    // public function transform(Request $request){
    //     $eloQuery=[];
    //     foreach($this->safeParms as $parm => $operators ){
    //         $query = $request->query($parm);
    //         if(!isset($query)){
    //                 continue;
    //         }
    //         $column= $this->columnMap[$parm] ?? $parm;
    //         foreach ($operators as $operator){
    //             if(isset($query[$operator])){
    //                 $eloQuery[]=[$column,$this->operatorMap[$operator],$query[$operator]];
    //             }
    //         }
    //     }
    //     return $eloQuery;
    // }
}