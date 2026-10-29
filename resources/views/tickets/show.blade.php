@extends('tickets.layout')

@section('content')
    <p><a href="{{ route('tickets.index') }}">&larr; Back to tickets</a></p>

    <div class="card">
        <div class="row">
            <h2 style="margin:0">{{ $ticket->subject }}</h2>
            @if ($ticket->ai_status === 'done')
                <div>
                    <span class="badge">{{ str_replace('_', ' ', $ticket->category) }}</span>
                    <span class="badge p-{{ $ticket->priority }}">{{ $ticket->priority }}</span>
                </div>
            @endif
        </div>
        <div class="muted">From {{ $ticket->customer_name }} · {{ $ticket->created_at->format('d M Y, H:i') }}</div>
        <hr style="border:0;border-top:1px solid var(--line);margin:14px 0">
        <pre>{{ $ticket->message }}</pre>
    </div>

    @if ($ticket->ai_status === 'done')
        <div class="card">
            <strong>AI summary</strong>
            <p>{{ $ticket->summary }}</p>

            <strong>Suggested reply</strong>
            <div class="reply"><pre>{{ $ticket->suggested_reply }}</pre></div>
        </div>
    @elseif ($ticket->ai_status === 'failed')
        <div class="card">
            <div class="err">AI analysis failed. Check your API key and storage/logs/laravel.log, then try again.</div>
        </div>
    @endif

    <form method="POST" action="{{ route('tickets.reanalyze', $ticket) }}">
        @csrf
        <button class="secondary" type="submit">Re-run AI analysis</button>
    </form>
@endsection
