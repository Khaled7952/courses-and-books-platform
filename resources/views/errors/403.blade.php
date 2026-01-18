<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('dashboard.forbidden_title') }}</title>

    <style>
        body {
            background: #f5f6fa;
            font-family: "Tajawal", sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        .box {
            background: white;
            width: 420px;
            margin: auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        h1 {
            font-size: 90px;
            margin: 0;
            color: #444;
            font-weight: 700;
        }
        p {
            margin: 15px 0 30px;
            font-size: 18px;
            color: #666;
        }
        a {
            display: inline-block;
            padding: 12px 25px;
            background: #4a69bd;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
        }
        a:hover {
            background: #3b55a0;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>403</h1>
        <p>{{ __('dashboard.forbidden_message') }}</p>
        <a href="{{ route('dashboard.welcome') }}">{{ __('dashboard.forbidden_back') }}</a>
    </div>
</body>
</html>
