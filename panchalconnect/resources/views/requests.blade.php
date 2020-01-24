@extends('layouts.app')

@section('content')
<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
        <a href="/"><i class="fa fa-home home_1"></i></a>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page">Requests</li>
     </ul>
   </div>
  
   @if(Session::has('success'))
            <div class="alert alert-success">
                <p>{{Session::get('success')}}</p>
            </div>
	@endif

	@if($newRequestReceiveds != null && $newRequestReceiveds->count() != 0) 
		<div class="alert alert-success">
			<p>{{sizeof($newRequestReceiveds)}} new request received. Please check</p>
		</div>
	@endif

   <div class="col-md-9 members_box2">
   	   
       <div class="col_4">
		    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">

			   <ul id="myTab" class="nav nav-tabs nav-tabs1" role="tablist">
				  <li role="presentation" class="active"><a href="#all" id="all-tab" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">All</a></li>
				  <li role="presentation"><a href="#request-sent" role="tab" id="request-sent-tab" data-toggle="tab" aria-controls="request-sent">Request Sent</a></li>
				  <li role="presentation"><a href="#request-received" role="tab" id="request-received-tab" data-toggle="tab" aria-controls="request-received">Request Received</a></li>
				  <li role="presentation"><a href="#married" role="tab" id="married-tab" data-toggle="tab" aria-controls="married">Married</a></li>
			   </ul>
				<div id="myTabContent" class="tab-content">
				
                    <!-- <div class="col-md-12 basic_1_left"> -->
                        <!--------------------All------------------------------->
                        <div class="tab-pane fade in active" id="all" role="tabpanel" aria-labelledby="all-tab">
						<div class="basic_1">
							<?php 
							if ($isLoggedIn == false) {
								?> Please <a href="/login">Login/Register</a> <?php
							} else if ($isProfileCreated == false) {
								?> Please <a href="{{route('profile.create')}}"> create</a> your profile <?php
							} else if (sizeof($allRequests) == 0) {
								echo "No request sent or received.";
							} else {
								$profileStatus = Auth::user()->Profile->status;
								foreach($allRequests as $request) {
									if ($request->profile_id_from == Auth::user()->Profile->id) {

										$user = App\Profile::find($request->profile_id)->User;
										echo "<b>Request Sent:</B>";
										if (strtoupper($request->status) == 'PENDING' && strtoupper($profileStatus) != "MARRIED") {
										?>
										<form action="{{action('RequestSentController@destroy',$request->id_from)}}" method="post">
											@csrf
											<input type="hidden" name="_method" value="DELETE"/>
											<input type="submit" name="unsend" value="Unsend Request"/>
										</form>
	
										<?php
										}

										if (strtoupper($request->status) == 'INTERESTED' && strtoupper($profileStatus) != "MARRIED") {
											?>
											Are you married with {{$user->name}} {{$user->lastname}}?
											<form action="{{action('RequestReceivedController@update',$request->id)}}" method="post">
												@csrf
												<input type="hidden" name="_method" value="PATCH"/>
												<input type="submit" name="SenderMarried" value="Yes"/>
												<input type="submit" name="Not_Interested" value="Never"/>
											</form>
		
											<?php
										}
										echo "Profile Number: " . $request->profile_id;
										?><br><?php
										echo "Name: " . $user->name . " " . $user->lastname;
										?><br><?php
										echo "Sent at: " . $request->created_at;
									} else {
										echo "<b>Request Received:</b><br>";
										$from_id = $request->profile_id_from;
										$user = App\Profile::find($from_id)->User;
										if (strtoupper($request->status) == 'PENDING' && strtoupper($profileStatus) != "MARRIED") {
											?>
											<form action="{{action('RequestReceivedController@update',$request->id)}}" method="post">
												@csrf
												<input type="hidden" name="_method" value="PATCH"/>
												<input type="submit" name="Interested" value="Interested"/>
												<input type="submit" name="Not_Interested" value="Not Interested"/>
											</form>
		
											<?php
										}

										if (strtoupper($request->status) == 'INTERESTED' && strtoupper($profileStatus) != "MARRIED") {
											?>
											Are you married with {{$user->name}} {{$user->lastname}}?
											<form action="{{action('RequestReceivedController@update',$request->id)}}" method="post">
												@csrf
												<input type="hidden" name="_method" value="PATCH"/>
												<input type="submit" name="ReceiverMarried" value="Yes"/>
												<input type="submit" name="Not_Interested" value="Never"/>
											</form>
		
											<?php
										}
										
										if ($newRequestReceiveds->find($request->id) != null) {
											echo '<div style="background-color:LavenderBlush">';
										} else {
											echo '<div>';
										}
										echo "Profile Number:" . $from_id;
										?><br><?php
										echo "Name: " . $user->name . " " . $user->lastname;
										?><br><?php
										echo "Received at: " . $request->created_at;
										echo "</div>";
									}
									?><br><?php
									echo "Status: " . $request->status;
									?><br><br><?php
								}
							}
							?>
						</div>
						</div>
						<!--------------------Request Sent------------------------------->
                        <div class="tab-pane fade" id="request-sent" role="tabpanel" aria-labelledby="request-sent-tab">
						<div class="basic_1">
							<?php
							if ($isLoggedIn == false) {
								?> Please <a href="/login">Login/Register</a> <?php
							} else if ($isProfileCreated == false) {
								?> Please <a href="{{route('profile.create')}}"> create</a> your profile <?php
							} else if (sizeof($requestSents)==0) {
								echo "No request sent.";
							} else {
								$profileStatus = Auth::user()->Profile->status;
								foreach($requestSents as $requestsent) {
									$user = $requestsent->Request_received->Profile->User;
									if (strtoupper($requestsent->Request_received->status) == 'PENDING' && strtoupper($profileStatus) != "MARRIED") {
									?>
									<form action="{{action('RequestSentController@destroy',$requestsent->id)}}" method="post">
										@csrf
										<input type="hidden" name="_method" value="DELETE"/>
										<input type="submit" name="unsend" value="Unsend Request"/>
									</form>

									<?php
									}
									if (strtoupper($requestsent->Request_received->status) == 'INTERESTED' && strtoupper($profileStatus) != "MARRIED") {
										?>
										Are you married with {{$user->name}} {{$user->lastname}}?
										<form action="{{action('RequestReceivedController@update',$requestsent->Request_received->id)}}" method="post">
											@csrf
											<input type="hidden" name="_method" value="PATCH"/>
											<input type="submit" name="SenderMarried" value="Yes"/>
											<input type="submit" name="Not_Interested" value="Never"/>
										</form>
	
										<?php
									}
									echo "Profile Number: " . $requestsent->Request_received->profile_id;
									?><br><?php
									echo "Name: " . $user->name . " " . $user->lastname;
									?><br><?php
									echo "Sent at: " . $requestsent->created_at;
									?><br><?php
									echo "Status: " . $requestsent->Request_received->status;
									?><br><hr><br><?php
								}
							}
							?>
						</div>
						</div>
						<!--------------------Request Received------------------------------->
                        <div class="tab-pane fade" id="request-received" role="tabpanel" aria-labelledby="request-received-tab">
						<div class="basic_1">
							<?php
							if ($isLoggedIn == false) {
								?> Please <a href="/login">Login/Register</a> <?php
							} else if ($isProfileCreated == false) {
								?> Please <a href="{{route('profile.create')}}"> create</a> your profile <?php
							} else if (sizeof($requestReceiveds)==0) {
								echo "No request received.";
							} else {
								$profileStatus = Auth::user()->Profile->status;
								foreach($requestReceiveds as $requestReceived) {
									$senderProfile = $requestReceived->Request_sent->Profile;
									$user = $senderProfile->User;
									if (strtoupper($requestReceived->status) == 'PENDING' && strtoupper($profileStatus) != "MARRIED") {
										?>
										<form action="{{action('RequestReceivedController@update',$requestReceived->id)}}" method="post">
											@csrf
											<input type="hidden" name="_method" value="PATCH"/>
											<input type="submit" name="Interested" value="Interested"/>
											<input type="submit" name="Not_Interested" value="Not Interested"/>
										</form>
	
										<?php
									}

									if (strtoupper($requestReceived->status) == 'INTERESTED' && strtoupper($profileStatus) != "MARRIED") {
										?>
										Are you married with {{$user->name}} {{$user->lastname}}?
										<form action="{{action('RequestReceivedController@update',$requestReceived->id)}}" method="post">
											@csrf
											<input type="hidden" name="_method" value="PATCH"/>
											<input type="submit" name="ReceiverMarried" value="Yes"/>
											<input type="submit" name="Not_Interested" value="Never"/>
										</form>
	
										<?php
									}
									if ($newRequestReceiveds->find($requestReceived->id) != null) {
										echo '<div style="background-color:LavenderBlush">';
									} else {
										echo '<div>';
									}
									echo "Profile Number:" . $senderProfile->id;
									?><br><?php
									echo "Name: " . $user->name . " " . $user->lastname;
									?><br><?php
									echo "Received at: " . $requestReceived->created_at;
									?><br><?php
									echo "Status: " . $requestReceived->status;
									echo "</div>";
									?><br><hr><br><?php
								}
							}
							?>
						</div>
						</div>
						<!--------------------Married------------------------------->
                        <div class="tab-pane fade" id="married" role="tabpanel" aria-labelledby="married">
						<div class="basic_1">
						<?php
						if ($isLoggedIn == false) {
								?> Please <a href="/login">Login/Register</a> <?php
							} else if ($isProfileCreated == false) {
								?> Please <a href="{{route('profile.create')}}"> create</a> your profile <?php
							} else {
								?><div class="alert alert-success"><?php
									$marriedController = new App\Http\Controllers\MarriedController();
									echo $marriedController->getMarriageStatus();
								?></div><?php
							}
						?>
						</div>
						</div>
					<!-- </div> -->
				</div>
			   <div id="myTabContent" class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
				    <ul class="pagination pagination_1">
				 	  <li class="active"><a href="#">1</a></li>
				 	  <li><a href="#">2</a></li>
				 	  <li><a href="#">3</a></li>
				 	  <li><a href="#">4</a></li>
				 	  <li><a href="#">5</a></li>
				 	  <li><a href="#">...</a></li>
				 	  <li><a href="#">Next</a></li>
	                </ul>
	                <div class="clearfix"> </div>
	               
			 </div> 
		  </div>
	   </div>
    </div>
   <div class="clearfix"> </div>
  </div>
</div>
<script>
	document.getElementById('notificationCount').innerText = <?php echo ($newRequestReceiveds != null) ? $newRequestReceiveds->count() : 0; ?>;
</script>
@endsection