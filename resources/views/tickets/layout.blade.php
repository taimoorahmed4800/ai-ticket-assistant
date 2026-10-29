<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AI Ticket Assistant</title>
    <style>
        :root { --bg:#f4f6fb; --card:#fff; --text:#1d2433; --muted:#6b7280; --brand:#2e5c9a; --line:#e3e7ef; }
        * { box-sizing: border-box; }
        body { margin:0; font-family: system-ui, -apple-system, "Segoe UI", sans-serif; background:var(--bg); color:var(--text); }
        .wrap { max-width: 860px; margin: 0 auto; padding: 24px 16px 60px; }
        h1 { margin: 0 0 4px; font-size: 24px; color: var(--brand); }
        .sub { color: var(--muted); margin-bottom: 20px; }
        .card { background: var(--card); border:1px solid var(--line); border-radius:10px; padding:18px; margin-bottom:16px; }
        label { display:block; font-weight:600; margin: 10px 0 4px; font-size: 14px; }
        input, textarea { width:100%; padding:9px 10px; border:1px solid var(--line); border-radius:6px; font: inherit; }
        textarea { min-height: 110px; resize: vertical; }
        button { background: var(--brand); color:#fff; border:0; padding:10px 16px; border-radius:6px; font: inherit; cursor:pointer; margin-top:14px; }
        button.secondary { background:#fff; color:var(--brand); border:1px solid var(--brand); }
        .err { color:#b42318; font-size:13px; margin-top:4px; }
        .row { display:flex; justify-content:space-between; gap:12px; align-items:center; }
        .badge { display:inline-block; padding:2px 9px; border-radius:99px; font-size:12px; font-weight:600; background:#eef2f9; color:var(--brand); }
        .p-urgent { background:#fde8e8; color:#b42318; } .p-high { background:#fff1e0; color:#b45309; }
        .p-medium { background:#fff9db; color:#8a6d00; } .p-low { background:#e7f6ec; color:#1e7a46; }
        .muted { color: var(--muted); font-size: 13px; }
        a { color: var(--brand); text-decoration: none; }
        pre { white-space: pre-wrap; font: inherit; margin: 0; }
        .reply { background:#f7f9fd; border-left:3px solid var(--brand); padding:12px; border-radius:6px; }
    </style>
</head>
<body>
<div class="wrap">
    <h1><a href="{{ route('tickets.index') }}">AI Ticket Assistant</a></h1>
    <div class="sub">Laravel + free AI API: automatic category, priority, summary and reply draft.</div>
    @yield('content')
</div>
</body>
</html>
