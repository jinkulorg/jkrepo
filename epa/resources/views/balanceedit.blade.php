<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Balances</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <style>
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
            </div>
            <div class="row">
                <div class="col-md-12">
                    <br />
                    <div class="subtitle m-b-md">
                        Edit Balance Entry
                    </div>
                    <center>

                        <form action="{{action('BalanceController@update',$id)}}" method="post">
                            @csrf

                            <input type="hidden" name="_method" value="PATCH" />

                            <input type="text" name="name" value="{{$balance->name}}" placeholder="Enter Name" />

                            <input type="text" name="type" value="{{$balance->type}}" placeholder="Enter type of balance" />

                            <input type="text" name="amount" value="{{$balance->amount}}" placeholder="Enter amount" />

                            <input type="submit" value="Edit" />

                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</body>

</html>