<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            body{
                padding: 2px;
                margin: 0;
            }
            .container{
                border: 1px solid gray;
            }
            .title{
                background-color: #C9E4CA;
                padding: 10px 20px;
                margin: 0;
                border-bottom: 1px solid gray;
            }
            .title p{
                width: 50%;
                float: left;
                margin: 0;
            }

            .ticket_code {
                font-weight: 700;
                right: 0;
            }

            .title::after {
                content: "";
                display: table;
                clear: both;
            }
            .subtitle{
                padding: 0px 20px;
            }
            .departing{
                color: gray;
                margin: 0;
                padding: 10px 0px;
                border-bottom: 1px solid gray;
            }
            .flight{
                margin-bottom: 25px;
                margin-top: 15px;
            }
            .flight div{
                width: 50%;
                float: left;
                margin: 0;
            }
            .flight::after {
                content: "";
                display: table;
                clear: both;
            }
            .city{
                font-size: 26px;
                font-weight: 700;
                margin-bottom: 12px;
            }
            .time{
                color: gray;
            }
            p{
                margin: 0;
            }
            .user{
                margin: 0 20px;
                padding-bottom: 20px;
                padding-top: 10px;
                border-top: 1px solid gray;
            }
            .user p{
                width: 50%;
                float: left;
                margin: 0;
            }
            .user::after {
                content: "";
                display: table;
                clear: both;
            }
            .name,
            .seat{
                font-weight: 700;
            }
            .foot{
                border-top: 1px dashed gray;
                padding-top: 10px;
                margin-top: 30px;
                color: gray;
                font-size: 12px;
            }
            .universal{
                margin-bottom: 20px;
                font-size: 26px;
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        <p class="universal">Universal Airlines</p>
        <div class="container">
            <div class="title">
                <p class="">Date of Booking: {{ $ticket['created_at']}}</p>
                <p class="ticket_code">Ticket #{{ $ticket['ticket_code'] }}</p>
            </div>  
            <div class="subtitle">
                <p class="departing">Departing Flight {{ date('d-m-Y', strtotime($flight['date'])) }} / {{ $flight['departure_time'] }}</p>
                <div class="flight">
                    <div class="">
                        <p class="city">{{ $flight['origin'] }}</p>
                        <p class="">{{ $flight['departure_terminal'] }}</p>
                        <p class="time">{{ $flight['departure_time'] }}</p>
                    </div>
                    <div class="text-center">
                        <p class="city"> {{ $flight['destination'] }} </p>
                        <p class="">{{ $flight['arrival_terminal'] }}</p>
                        <p class="time">{{ $flight['arrival_time'] }}</p>
                    </div>
                </div>
            </div>
            <div class="user">
                <div class="">
                    <p class="name">Mr./Mrs. {{ $user_name }}</p>
                </div>  
                <div class="">
                    <p class="seat">Seat {{ $ticket['seat'] }}</p>
                </div>
            </div>
        </div>
        <div>
            <p class="foot">You can print this ticket to present it at the airport, and you can give it to another person to use on your behalf. The passenger assumes full responsibility for the use of this ticket.</p>
        </div>
    </body>
</html>
