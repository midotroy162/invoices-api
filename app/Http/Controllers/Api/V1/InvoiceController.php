<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Http\Requests\V1\BulkStoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use App\Filters\V1\InvoiceFilter;
use Illuminate\Support\Arr;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $filter=new InvoiceFilter();
        $queryItems = $filter->transform($request);//[['column','operator','value']]
        if (count($queryItems) == 0) {
            return new InvoiceCollection(Invoice::paginate(10));
        }else{
            $invoices = Invoice::where($queryItems)->paginate(10);
            return new InvoiceCollection($invoices->appends($request->query()));
        }
    }



    public function bulkStore(BulkStoreInvoiceRequest $request){
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });
        Invoice::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

}
