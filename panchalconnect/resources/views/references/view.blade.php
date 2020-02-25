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

        @if(Auth()->user()->Profile == null)
            <div class="alert alert-info">
				<h3><b><i class='fa fa-info-circle' aria-hidden='true'></i> 
					Please <a href="{{route('profile.create')}}"> create</a> your profile<b></h3>
			</div>
        @else
        <table width=100%>
            <td>
                <h3>{{ Auth::user()->name }} {{ Auth::user()->lastname }} References </h3>
            </td>
            <td align="right">
                <h4><a class="btn_2" href="{{route('reference.create')}}">Add Reference</a></h4>
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
                        <td>
                            <div class="my-buttons">
                                <a class="my-buttons" href="{{action('ReferenceController@edit', $reference['id'])}}">Edit</a>
                            </div>
                        </td>
                        <td>
                            <div class="my-buttons">
                                <a class="my-buttons" onclick="onDelete()" href="#">Delete</a>
                            </div>
                            <form id="delete_form" method="post" class="delete_form" action="{{action('ReferenceController@destroy',$reference['id'])}}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE" />
                                <div class="my-buttons">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="clearfix"> </div>
    
    
        @endif
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

function onDelete() {
    if (confirm('Are you sure you want to delete it?')) {
        document.getElementById("delete_form").submit();
    } else {
        return false;
    }
}
</script>
@endsection
