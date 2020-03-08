@extends('layouts.adminapp')

@section('content')
<br>
<div class="container">
    <div class="breadcrumb1">
        <ul>
            <a href="/admin"><i class="fa fa-home home_1"></i></a>
            <span class="divider">&nbsp;|&nbsp;</span>
            <li class="current-page">Manage Featured Profile</li>
        </ul>
    </div>

    <br>
    @if(\Session::has('success'))
    <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
    </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>Sr. No.</th>
                <th>Feature Profile Id</th>
                <th>Profile Id</th>
                <th>Plan</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Delete</th>
            </tr>
            <?php $i = 1; ?>
            @foreach($featuredprofiles as $featuredprofile)
            <tr>
                <td>{{$i}}</td>
                <td>{{$featuredprofile->id}}</td>
                <td>{{$featuredprofile->profile_id}}</td>
                <td>{{$featuredprofile->plan}}</td>
                <td>{{$featuredprofile->start_date}}</td>
                <td>{{$featuredprofile->end_date}}</td>
                <td>{{$featuredprofile->status}}</td>
                <td>{{$featuredprofile->created_at}}</td>
                <td>{{$featuredprofile->updated_at}}</td>
                <td>
                    <form method="post" class="delete_form" action="{{action('AdminController@destroyFeaturedProfile',$featuredprofile->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php $i = $i + 1; ?>
            @endforeach
        </table>
    </div>
    {{$featuredprofiles->links()}}
    <div class="clearfix"> </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.delete_form').on('submit', function() {
            if (confirm('Are you sure you want to delete it?')) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>
@endsection