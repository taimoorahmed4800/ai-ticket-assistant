@extends('tickets.layout')

@section('content')
    <div class="card">
        <strong>New support ticket</strong>
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <label for="customer_name">Customer name</label>
            <input id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
            @error('customer_name') <div class="err">{{ $message }}</div> @enderror

            <label for="subject">Subject</label>
            <input id="subject" name="subject" value="{{ old('subject') }}" required>
            @error('subject') <div class="err">{{ $message }}</div> @enderror

            <label for="message">Message</label>
            <textarea id="message" name="message" required>{{ old('message') }}</textarea>
            @error('message') <div class="err">{{ $message }}</div> @enderror

            <button type="submit">Submit &amp; analyze with AI</button>
        </form>
    </div>

    <h3>Tickets ({{ $tickets->count() }})</h3>

    @forelse ($tickets as $ticket)
        <div class="card">
            <div class="row">
                <a href="{{ route('tickets.show', $ticket) }}"><strong>{{ $ticket->subject }}</strong></a>
                <div>
                    @if ($ticket->ai_status === 'done')
                        <span class="badge">{{ str_replace('_', ' ', $ticket->category) }}</span>
                        <span class="badge p-{{ $ticket->priority }}">{{ $ticket->priority }}</span>
                    @elseif ($ticket->ai_status === 'failed')
                        <span class="badge p-urgent">AI failed</span>
                    @else
                        <span class="badge">pending</span>
                    @endif
                </div>
            </div>
            <div class="muted">{{ $ticket->customer_name }} · {{ $ticket->created_at->diffForHumans() }}</div>
            @if ($ticket->summary)
                <p style="margin:8px 0 0">{{ $ticket->summary }}</p>
            @endif
        </div>
    @empty
        <p class="muted">No tickets yet. Create the first one above.</p>
    @endforelse
@endsection
