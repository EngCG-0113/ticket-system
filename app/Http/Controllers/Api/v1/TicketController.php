<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TicketResource;
use App\Http\Resources\V1\TicketCollection;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        try{
            $query = (new Ticket)->newQuery();
            $params = $request->all();

            if(isset($params['search'])){
                $search = $params['search'];
                $query->where('issue_headline', 'like',"%{$search}%")
                    ->orWhere('issue_description', 'like',"%{$search}%")
                    ->orWhere('requested_by', 'like',"%{$search}%");
            }

            $tickets = $query->paginate(10);
        }catch(\Exceptions $e){
            return response()->json(['error' => $e->getMessage()],500);
        }


        return new TicketCollection($tickets);
    }

    public function show($id)
    {
        return new TicketResource(Ticket::find($id));
    }

    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $data['requested_date'] = Carbon::parse($data['requested_date'])->toDateTimeString();

            $ticket = Ticket::create($data);
        }catch(\Exceptions $e){
            return response()->json(['error' => $e->getMessage()],500);
        }


        return response()->json($ticket);
    }

    public function update(Request $request,$id)
    {
        try{
            $ticket = Ticket::find($id);

            if($ticket){
                $ticket->status = $ticket->status == 'open' ? 'closed' : 'open';
                $ticket->save();
                return response()->json($ticket);
            }else{
                return response()->json(['error' => 'Ticket ID not found.'],500);
            }
         }catch(\Exceptions $e){
            return response()->json(['error' => $e->getMessage()],500);
        }

        return new TicketResource(Ticket::find($id));
    }

}
