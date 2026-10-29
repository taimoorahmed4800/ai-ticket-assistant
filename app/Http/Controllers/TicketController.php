<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\AiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TicketController extends Controller
{
    public function __construct(private AiService $ai)
    {
    }

    public function index()
    {
        $tickets = Ticket::latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'subject'       => ['required', 'string', 'max:150'],
            'message'       => ['required', 'string', 'max:3000'],
        ]);

        $ticket = Ticket::create($data);

        $this->runAi($ticket);

        return redirect()->route('tickets.show', $ticket);
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function reanalyze(Ticket $ticket): RedirectResponse
    {
        $this->runAi($ticket);

        return redirect()->route('tickets.show', $ticket);
    }

    private function runAi(Ticket $ticket): void
    {
        try {
            $result = $this->ai->analyzeTicket($ticket->subject, $ticket->message);

            $ticket->update($result + ['ai_status' => 'done']);
        } catch (Throwable $e) {
            Log::error('AI ticket analysis failed: '.$e->getMessage());

            $ticket->update(['ai_status' => 'failed']);
        }
    }
}
