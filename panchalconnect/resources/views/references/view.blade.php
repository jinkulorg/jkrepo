@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">My References</li>
            </ul>
        </div>

        <br>
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
        @endif

        <table width=100%>
            <td>
                <h3>{{ Auth::user()->name }} {{ Auth::user()->lastname }} References </h3>
            </td>
            <td align="right">
                <h4><a href="{{route('reference.create')}}">Add Reference</a></h4>
            </td>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>First Name</th>
                        <th>Second Name</th>
                        <th>Last Name</th>
                        <th>Relation</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Pincode</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($references as $reference)
                    <tr>
                        <td>{{$reference['first_name']}}</td>
                        <td>{{$reference['second_name']}}</td>
                        <td>{{$reference['last_name']}}</td>
                        <td>{{$reference['relation']}}</td>
                        <td>{{$reference['city']}}</td>
                        <td>{{$reference['state']}}</td>
                        <td>{{$reference['pincode']}}</td>
                        <td><a href="{{action('ReferenceController@edit', $reference['id'])}}">Edit</a></td>
                        <td>
                            <form method="post" class="delete_form" action="{{action('ReferenceController@destroy',$reference['id'])}}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" style="width:100px; height:30px">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="clearfix"> </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
        $('.delete_form').on('submit', function(){    
                if (confirm('Are you sure you want to delete it?')) {
                        return true;
                } else {
                        return false;
                }
        });
});
</script>
@endsection
