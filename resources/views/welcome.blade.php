@extends('partials.head')

@section('content');
{{--     <h1><a href="{{ task.link }}">{{ task.title }}</a></h1>
    <p>{{ task.body }}</p>
    <p>{{ task.created_at->toFormattedDateString() }}</p>

    @foreach ($comments as $comment)
        <li>{{ comment.created_at->diffForHumans() }}</li>
    @endforeach --}}
    hey there
@endsection;
{{-- 
@section('scripts');
    scripts
@endsection; --}}



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/admin') }}">Admin</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Hello
                </div>
                <ul>
{{--                     @foreach ($types as $element)
                        <li>{{ $element }}</li>
                    @endforeach --}}
{{--             $t->increments('id');
            $t->string('name');
            $t->string('slug');
            $t->integer('template');
            $t->integer('rights');
            $t->timestamps(); --}}
                </ul>
            </div>
        </div>
    </body>
</html>
