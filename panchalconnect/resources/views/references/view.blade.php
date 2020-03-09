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
            <div class="basic_1">
          <h3 class="profile_title" style="margin: 5px; padding: 5px;"><b>{{ Auth::user()->name }} {{ Auth::user()->lastname }} References</b> </h3>
        </div>

            </td>
            <td>
            <div class="basic_1">
                <h4 style="text-align: right;"><a class="btn_1" href="{{route('reference.create')}}"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Add Reference</a></h4>
</div>
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
                                </i><a class="my-buttons" href="{{action('ReferenceController@edit', $reference['id'])}}">Edit</a>
                            </div>
                        </td>
                        <td>
                            <div class="my-buttons">
                                <?php $refid = $reference['id']; ?>
                                <a class="my-buttons" href="#" onclick="onDelete({{$refid}})">Delete</a>
                            </div>
                            <form id="delete_form" method="post" class="delete_form" action="#">
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

function onDelete(refid) {
    document.getElementById('delete_form').action = 'reference/' + refid;
    if (confirm('Are you sure you want to delete it?')) {
        document.getElementById("delete_form").submit();
    } else {
        return false;
    }
}
</script>
@endsection
