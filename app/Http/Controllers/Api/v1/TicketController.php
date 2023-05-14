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
        $search = $params['search'];

        if($params['search']){
            $query->where('issue_headline', 'like',"%{$search}%")
                ->orWhere('issue_description', 'like',"%{$search}%")
                ->orWhere('requested_by', 'like',"%{$search}%");
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
        $ticket = Ticket::find($id);

        if($ticket){
            $ticket->status = $ticket->status == 'open' ? 'closed' : 'open';
            $ticket->save();
            return response()->json($ticket);
        }else{
            return response()->json(['error' => 'Ticket ID not found.'],500);
        }
        return new TicketResource(Ticket::find($id));
    }

}
