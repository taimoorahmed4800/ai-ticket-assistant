# AI Ticket Assistant (Laravel + free AI API)

A small Laravel project. A user submits a support ticket and the app calls an
AI model to automatically return:

- category (billing, technical, account, feature_request, other)
- priority (low, medium, high, urgent)
- one-line summary
- a suggested reply to the customer

It works with ANY OpenAI-compatible API, so you can use a completely free
provider. No extra Composer package needed (uses Laravel's `Http` client).

## 1. Setup

   composer create-project laravel/laravel ai-ticket-assistant
   cd ai-ticket-assistant

Copy the folders from this zip (`app`, `database`, `resources`, `routes`) into
the project. Replace `routes/web.php` when asked.

Add this inside the returned array in `config/services.php`:

   'ai' => [
       'base_url' => env('AI_BASE_URL'),
       'key'      => env('AI_API_KEY'),
       'model'    => env('AI_MODEL'),
   ],

## 2. Pick ONE free provider and put its values in `.env`

### Option A: Google Gemini (free tier, no credit card)
Get a key at https://aistudio.google.com/apikey

   AI_BASE_URL=https://generativelanguage.googleapis.com/v1beta/openai
   AI_API_KEY=your-gemini-key
   AI_MODEL=gemini-3.8-flash

Free model names change over time. If you get a "model not found" error, open
Google AI Studio and copy a current Flash model name.

### Option B: Groq (free tier, fast; may ask for phone verification)
Get a key at https://console.groq.com/keys

   AI_BASE_URL=https://api.groq.com/openai/v1
   AI_API_KEY=your-groq-key
   AI_MODEL=openai/gpt-oss-120b

### Option C: OpenRouter (free models ending in :free, small daily limit)
Get a key at https://openrouter.ai/keys

   AI_BASE_URL=https://openrouter.ai/api/v1
   AI_API_KEY=your-openrouter-key
   AI_MODEL=meta-llama/llama-3.3-70b-instruct:free

### Option D: Ollama (100% free, runs on your own PC, no key, no internet)
Install from https://ollama.com, then run: ollama pull llama3.2

   AI_BASE_URL=http://localhost:11434/v1
   AI_API_KEY=
   AI_MODEL=llama3.2

(Needs a decent PC. Smaller models may sometimes return bad JSON; the app then
marks the ticket "failed" and you can press "Re-run AI analysis".)

## 3. Run

   php artisan migrate
   php artisan serve

Open http://127.0.0.1:8000 and submit a ticket.

## Files

- `app/Services/AiService.php` : calls the API, parses and validates the JSON
- `app/Http/Controllers/TicketController.php` : create, show, re-run analysis
- `app/Models/Ticket.php` and the migration : tickets table
- `resources/views/tickets/*` : simple Blade UI, no npm or build step needed

## Good practices used

- The API key stays in `.env` and is only used on the server.
- Ticket text is wrapped in `<ticket>` tags and the system prompt says to treat
  it as data. This helps against prompt injection.
- The AI reply is validated (category and priority must be in the allowed list).
- If the API fails, the ticket is still saved and marked `failed`; you can retry.
- Provider is switchable from `.env` only (no vendor lock-in).

## Free tier notes

Free tiers have rate limits and can change. Do not put real customer data into
a free tier for production use. Check the provider's terms.

## Ideas to extend it (good for your portfolio)

- Run the AI call in a Laravel Queue job instead of during the request.
- Add login and roles with Sanctum or Breeze.
- Add RAG: store FAQ documents and let the AI reply using them.
- Write a feature test using `Http::fake()` to mock the API.
