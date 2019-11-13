<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Balances</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
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
            font-size: 64px;
        }

        .subtitle {
            font-size: 34px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
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
        <div class="content">
            <div class="title m-b-md">
                E-Personal Assistant
            </div>
            <div class="links">
                <a href="/">Home</a>
                <a href="{{route('balance.create')}}">Add Balance</a>
            </div>
            <br>
            @if($message = Session::get('success'))
                <p>{{$message}}</p>
            @endif
            <div class="subtitle m-b-md">
                Your Balances
            </div>
            <table style="width:100%">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($balances as $row)
                <tr>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['type']}}</td>
                    <td>{{$row['amount']}}</td>
                    <td><a href="{{action('BalanceController@edit', $row['id'])}}"><button>Edit</button></a></td>
                    <td>
                        <form method="post" class="delete_form" action="{{action('BalanceController@destroy',$row['id'])}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit">Delete</button>
                        </form>
                    </td> 
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
$(document).ready(function(){
        $('.delete_form').on('submit', function(){
                if (confirm('Are you sure you want to delete it?')) {
                        returen true;
                } else {
                        returen false;
                }
        });
});
</script>
</html>