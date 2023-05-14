<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TicketResource;
use App\Http\Resources\V1\TicketCollection;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = (new Ticket)->newQuery();
        $params = $request->all();

        try{
            foreach ($params as $param => $value) {
                $query->where($params,$value);
            }
        }catch(QueryException $e){
            return response()->json(['error' => $e->getMessage()]);
        }

        $tickets = $query->paginate(10);


        return new TicketCollection($tickets);
    }

    public function show($id)
    {
        return new TicketResource(Ticket::find($id));
    }

    public function store(Request $request)
    {
        return new TicketResource(Ticket::find($id));
    }

    public function update(Request $request,$id)
    {
        return new TicketResource(Ticket::find($id));
    }
}
