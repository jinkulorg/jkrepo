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

		<div class="col-md-9 members_box2">

			@if(Session::has('success'))
			<div class="alert alert-success">
				<b><i class='fa fa-check' aria-hidden='true'></i> {{Session::get('success')}}</b>
			</div>
			@endif

			@if($newRequestReceiveds != null && $newRequestReceiveds->count() != 0)
			<div class="alert alert-info">
				<b><i class='fa fa-info-circle' aria-hidden='true'></i>
					{{sizeof($newRequestReceiveds)}} new request received. Please check<b>
			</div>
			@endif

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
								$allRequestsReceivedFetch = [];
								$recCount = 0;
								$allRequestsSentFetch = [];
								$sentCount = 0;

								if ($isLoggedIn == false) {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> ";
									echo "Please <a href='/login'>Login/Register</a></b>";
									echo "</div>";
								} else if ($isProfileCreated == false) {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> ";
									echo "Please <a href=" . route('profile.create') . "> create</a> your profile</b>";
									echo "</div>";
								} else if (sizeof($allRequests) == 0) {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> No request sent or received.</b>";
									echo "</div>";
								} else if (Auth::user()->Profile->isActive() == false && Auth::user()->Profile->status != "MARRIED") {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> Kindly activate your profile first to use request feature.</b>";
									echo "</div>";
								} else {
									$profileStatus = Auth::user()->Profile->status;
									foreach ($allRequests as $request) {
										if ($request->profile_id_from == Auth::user()->Profile->id) {
											//Request Sent
											$allRequestsSentFetch[$sentCount] = $request->id_from;
											$sentCount++;

											$user = App\Profile::find($request->profile_id)->User;

											$profile_pic_paths = [];
											$profile_pic_paths[0] = "#";
											if ($user->profile->profile_pic_path != null) {
												$profile_pic_paths = explode(",", $user->profile->profile_pic_path);
											}

											$date1 = date_create(date("Y/m/d"));
											$date2 = date_create($user->last_login_date);
											$diff = date_diff($date1, $date2);
											if ($diff->format("%a") == 0) {
												$lastSeen = "today";
											} else if ($diff->format("%a") == 1) {
												$lastSeen = $diff->format("yesterday");
											} else {
												$lastSeen = $diff->format("%a days ago");
											}

											if ($user->profile->height != null) {
												$heights = explode(".", $user->profile->height);
											}

											?>

											<div class="jobs-item with-thumb">
												<div class="thumb_top">
													<div class="thumb"><a href="view_profile.html"><img src="/storage/profile_images/mainimage/{{$profile_pic_paths[0]}}" class="img-responsive" alt="" /></a></div>
													<div class="jobs_right">
														<h6 class="title"><a href="view_profile.html"><b style="color: gray">Request Sent to</b> <b style="color: #c32143">{{$user->name}} {{$user->lastname}} ({{$user->profile->id}})</b></a></h6>
														<ul class="top-btns" style="color: #c32143">
															<li>{{date('d-M-Y', strtotime($request->created_at))}} {{date('h:i:s A', strtotime($request->created_at))}}</li>
														</ul>
														<ul class="login_details1">
															<li>last seen {{$lastSeen}} ({{date("d-M-Y", strtotime($user->last_login_date))}})</li>
														</ul>
														<p class="description">{{$user->profile->age()}} years, {{($user->profile->height != null && sizeof($heights) >= 1) ? $heights[0] : "0"}} Feet {{($user->profile->height != null && sizeof($heights) == 2) ? $heights[1] : "0" }} Inches |
															<span class="m_1">Subcaste</span> : {{$user->profile->subcast}} |
															<span class="m_1">Education</span> : {{$user->profile->education}} |
															<span class="m_1">Occupation</span> : {{$user->profile->occupation}}<br>
															<a href="{{action('ProfilesController@show',$user->profile->id)}}" class="read-more">view full profile</a>
														</p>
													</div>
													<div class="clearfix"> </div>
												</div>
												<div class="thumb_bottom">

													<div class="thumb" style="color: #c32143">
														<b>Status:</b>
														@if ((strtoupper($request->status) == 'PENDING' || strtoupper($request->status) == 'NEW') && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
														You are waiting for {{$user->name}}'s reply
														@elseif (strtoupper($request->status) == 'NOT INTERESTED')
														Rejected ({{$user->name}} sent not interested to you)
														@elseif (strtoupper($request->status) == 'NOT MARRY BY SENDER')
														Rejected (You decided not to marry {{$user->name}})
														@elseif (strtoupper($request->status) == 'NOT MARRY BY RECEIVER')
														Rejected ({{$user->name}} decided not to marry you)
														@elseif (strtoupper($request->status) == 'MARRIED')
														Congratulations! You are married with {{$user->name}}
														@elseif ($user->profile->status == "MARRIED")
														Rejected ({{$user->name}} got married)
														@elseif (strtoupper($profileStatus) == "MARRIED")
														Rejected (You are married)
														@elseif (strtoupper($request->status) == 'INTERESTED')
														<label style="color: green;">Accepted</label> - <a href="{{action('ProfilesController@show',$user->profile->id)}}" class="read-more">View @if($user->profile->gender == "M") his @else her @endif contact details</a>
														@else
														Rejected - (Your marriage is reverted back)
														@endif
													</div>

													@if ((strtoupper($request->status) == 'PENDING' || strtoupper($request->status) == 'NEW') && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
													<form action="{{action('RequestSentController@destroy',$request->id_from)}}" method="post">
														@csrf
														<input type="hidden" name="_method" value="DELETE" />
														<div class="thumb_but">
															<input class="btn_2" type="submit" name="unsend" value="Unsend Request" />
														</div>
													</form>
													@endif

													<!-- @if ($user->profile->status == "MARRIED" && strtoupper($request->status) != 'MARRIED')
													<div class="thumb_but" style="color: #c32143">
														<b>{{$user->name}} got married.</b>
													</div>
													@endif -->

													@if (strtoupper($request->status) == 'INTERESTED' && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
													<form action="{{action('RequestReceivedController@update',$request->id)}}" method="post">
														@csrf
														<input type="hidden" name="_method" value="PATCH" />
														<div class="thumb_but">
															Got married with @if($user->profile->gender == "M") him @else her @endif?
															<input class="btn_2" type="submit" name="SenderMarried" value="Yes" />
															<input class="btn_2" type="submit" name="SenderMarriedNever" value="Never" />
														</div>
													</form>
													@endif

													@if (strtoupper($request->status) == 'MARRIED')
													<form action="{{action('RequestReceivedController@update',$request->id)}}" method="post">
														@csrf
														<input type="hidden" name="_method" value="PATCH" />
														<div class="thumb_but">
															If not married?
															<input class="btn_2" type="submit" name="NotMarried" value="Revert" />
														</div>
													</form>
													@endif
													<div class="clearfix"> </div>

												</div>
											</div>
											<hr>
										<?php
												} else {
													//Request Received

													$allRequestsReceivedFetch[$recCount] = $request->id;
													$recCount++;

													$from_id = $request->profile_id_from;
													$user = App\Profile::find($from_id)->User;

													$profile_pic_paths = [];
													$profile_pic_paths[0] = "#";
													if ($user->profile->profile_pic_path != null) {
														$profile_pic_paths = explode(",", $user->profile->profile_pic_path);
													}

													$date1 = date_create(date("Y/m/d"));
													$date2 = date_create($user->last_login_date);
													$diff = date_diff($date1, $date2);
													if ($diff->format("%a") == 0) {
														$lastSeen = "today";
													} else if ($diff->format("%a") == 1) {
														$lastSeen = $diff->format("yesterday");
													} else {
														$lastSeen = $diff->format("%a days ago");
													}

													if ($user->profile->height != null) {
														$heights = explode(".", $user->profile->height);
													}

													if ($newRequestReceiveds->find($request->id) != null) {
														echo '<div style="background-color:LavenderBlush">';
													} else {
														echo '<div>';
													}
													?>

											<div class="jobs-item with-thumb">
												<div class="thumb_top">
													<div class="thumb"><a href="view_profile.html"><img src="/storage/profile_images/mainimage/{{$profile_pic_paths[0]}}" class="img-responsive" alt="" /></a></div>
													<div class="jobs_right">
														<h6 class="title"><a href="view_profile.html"><b style="color: gray">Request received from</b> <b style="color: #c32143">{{$user->name}} {{$user->lastname}} ({{$user->profile->id}})</b></a></h6>
														<ul class="top-btns" style="color: #c32143">
															<li>{{date('d-M-Y', strtotime($request->created_at))}} {{date('h:i:s A', strtotime($request->created_at))}}</li>
														</ul>
														<ul class="login_details1">
															<li>last seen {{$lastSeen}} ({{date("d-M-Y", strtotime($user->last_login_date))}})</li>
														</ul>
														<p class="description">{{$user->profile->age()}} years, {{($user->profile->height != null && sizeof($heights) >= 1) ? $heights[0] : "0"}} Feet {{($user->profile->height != null && sizeof($heights) == 2) ? $heights[1] : "0" }} Inches |
															<span class="m_1">Subcaste</span> : {{$user->profile->subcast}} |
															<span class="m_1">Education</span> : {{$user->profile->education}} |
															<span class="m_1">Occupation</span> : {{$user->profile->occupation}}<br>
															<a href="{{action('ProfilesController@show',$user->profile->id)}}" class="read-more">view full profile</a>
														</p>
													</div>
													<div class="clearfix"> </div>
												</div>

												<div class="thumb_bottom">

													<div class="thumb" style="color: #c32143">
														<b>Status:</b>
														@if ((strtoupper($request->status) == 'PENDING' || strtoupper($request->status) == 'NEW') && strtoupper($profileStatus) != "MARRIED"  && $user->profile->status != "MARRIED")
														{{$user->name}} is waiting for your reply
														@elseif (strtoupper($request->status) == 'NOT INTERESTED')
														Rejected (You sent not interested to {{$user->name}})
														@elseif (strtoupper($request->status) == 'NOT MARRY BY SENDER')
														Rejected ({{$user->name}} decided not to marry you)
														@elseif (strtoupper($request->status) == 'NOT MARRY BY RECEIVER')
														Rejected (You decided not to marry {{$user->name}})
														@elseif (strtoupper($request->status) == 'MARRIED')
														Congratulations! You are married with {{$user->name}}
														@elseif ($user->profile->status == "MARRIED")
														Rejected ({{$user->name}} got married)
														@elseif (strtoupper($profileStatus) == "MARRIED")
														Rejected (You are married)
														@elseif (strtoupper($request->status) == 'INTERESTED')
														<label style="color: green;">Accepted</label> - <a href="{{action('ProfilesController@show',$user->profile->id)}}" class="read-more">View @if($user->profile->gender == "M") his @else her @endif contact details</a>
														@else
														Rejected - (Your marriage is reverted back)
														@endif

													</div>

													@if ((strtoupper($request->status) == 'PENDING' || strtoupper($request->status) == 'NEW') && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
													<form action="{{action('RequestReceivedController@update',$request->id)}}" method="post">
														@csrf
														<input type="hidden" name="_method" value="PATCH" />
														<div class="thumb_but">
															<input class="btn_2" type="submit" name="Interested" value="Interested" />
															<input class="btn_2" type="submit" name="Not_Interested" value="Not Interested" />
														</div>
													</form>
													@endif

													<!-- @if ($user->profile->status == "MARRIED" && strtoupper($request->status) != 'MARRIED')
													<div class="thumb_but" style="color: #c32143">
														<b>{{$user->name}} got married.</b>
													</div>
													@endif -->

													@if (strtoupper($request->status) == 'INTERESTED' && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
													<form action="{{action('RequestReceivedController@update',$request->id)}}" method="post">
														@csrf
														<input type="hidden" name="_method" value="PATCH" />
														<div class="thumb_but">
															Got married with @if($user->profile->gender == "M") him @else her @endif?
															<input class="btn_2" type="submit" name="ReceiverMarried" value="Yes" />
															<input class="btn_2" type="submit" name="ReceiverMarriedNever" value="Never" />
														</div>
													</form>
													@endif

													@if (strtoupper($request->status) == 'MARRIED')
													<form action="{{action('RequestReceivedController@update',$request->id)}}" method="post">
														@csrf
														<input type="hidden" name="_method" value="PATCH" />
														<div class="thumb_but">
															If not married?
															<input class="btn_2" type="submit" name="NotMarried" value="Revert" />
														</div>
													</form>
													@endif

													<div class="clearfix"> </div>

												</div>

											</div>
								<?php echo "</div>";
											echo "<hr>";
										}
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
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> ";
									echo "Please <a href='/login'>Login/Register</a></b>";
									echo "</div>";
								} else if ($isProfileCreated == false) {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> ";
									echo "Please <a href=" . route('profile.create') . "> create</a> your profile</b>";
									echo "</div>";
								} else if (sizeof($requestSents) == 0) {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> No request sent.</b>";
									echo "</div>";
								} else if (Auth::user()->Profile->isActive() == false && Auth::user()->Profile->status != "MARRIED") {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> Kindly activate your profile first to use request feature.</b>";
									echo "</div>";
								} else {

									$profileStatus = Auth::user()->Profile->status;

									foreach ($requestSents as $requestsent) {

										if (in_array($requestsent->id, $allRequestsSentFetch) == false) {
											continue;
										}

										$user = $requestsent->Request_received->Profile->User;

										$profile_pic_paths = [];
										$profile_pic_paths[0] = "#";
										if ($user->profile->profile_pic_path != null) {
											$profile_pic_paths = explode(",", $user->profile->profile_pic_path);
										}

										$date1 = date_create(date("Y/m/d"));
										$date2 = date_create($user->last_login_date);
										$diff = date_diff($date1, $date2);
										if ($diff->format("%a") == 0) {
											$lastSeen = "today";
										} else if ($diff->format("%a") == 1) {
											$lastSeen = $diff->format("yesterday");
										} else {
											$lastSeen = $diff->format("%a days ago");
										}

										if ($user->profile->height != null) {
											$heights = explode(".", $user->profile->height);
										}

										?>

										<div class="jobs-item with-thumb">
											<div class="thumb_top">
												<div class="thumb"><a href="view_profile.html"><img src="/storage/profile_images/mainimage/{{$profile_pic_paths[0]}}" class="img-responsive" alt="" /></a></div>
												<div class="jobs_right">
													<h6 class="title"><a href="view_profile.html"><b style="color: gray">Request Sent to</b> <b style="color: #c32143">{{$user->name}} {{$user->lastname}} ({{$user->profile->id}})</b></a></h6>
													<ul class="top-btns" style="color: #c32143">
														<li>{{date('d-M-Y', strtotime($requestsent->created_at))}} {{date('h:i:s A', strtotime($requestsent->created_at))}}</li>
													</ul>
													<ul class="login_details1">
														<li>last seen {{$lastSeen}} ({{date("d-M-Y", strtotime($user->last_login_date))}})</li>
													</ul>
													<p class="description">{{$user->profile->age()}} years, {{($user->profile->height != null && sizeof($heights) >= 1) ? $heights[0] : "0"}} Feet {{($user->profile->height != null && sizeof($heights) == 2) ? $heights[1] : "0" }} Inches |
														<span class="m_1">Subcaste</span> : {{$user->profile->subcast}} |
														<span class="m_1">Education</span> : {{$user->profile->education}} |
														<span class="m_1">Occupation</span> : {{$user->profile->occupation}}<br>
														<a href="{{action('ProfilesController@show',$user->profile->id)}}" class="read-more">view full profile</a>
													</p>
												</div>
												<div class="clearfix"> </div>
											</div>

											<div class="thumb_bottom">

												<div class="thumb" style="color: #c32143">
													<b>Status:</b>
													@if ((strtoupper($requestsent->Request_received->status) == 'PENDING' || strtoupper($requestsent->Request_received->status) == 'NEW') && strtoupper($profileStatus) != "MARRIED"  && $user->profile->status != "MARRIED")
													You are waiting for {{$user->name}}'s reply
													@elseif (strtoupper($requestsent->Request_received->status) == 'NOT INTERESTED')
													Rejected ({{$user->name}} sent not interested to you)
													@elseif (strtoupper($requestsent->Request_received->status) == 'NOT MARRY BY SENDER')
													Rejected (You decided not to marry {{$user->name}})
													@elseif (strtoupper($requestsent->Request_received->status) == 'NOT MARRY BY RECEIVER')
													Rejected ({{$user->name}} decided not to marry you)
													@elseif (strtoupper($requestsent->Request_received->status) == 'MARRIED')
													Congratulations! You are married with {{$user->name}}
													@elseif ($user->profile->status == "MARRIED")
													Rejected ({{$user->name}} got married)
													@elseif (strtoupper($profileStatus) == "MARRIED")
													Rejected (You are married)
													@elseif (strtoupper($requestsent->Request_received->status) == 'INTERESTED')
													<label style="color: green;">Accepted</label> - <a href="{{action('ProfilesController@show',$user->profile->id)}}" class="read-more">View @if($user->profile->gender == "M") his @else her @endif contact details</a>
													@else
													Rejected - (Your marriage is reverted back)
													@endif
												</div>

												@if ((strtoupper($requestsent->Request_received->status) == 'PENDING' || strtoupper($requestsent->Request_received->status) == 'NEW') && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
												<form action="{{action('RequestSentController@destroy',$requestsent->id)}}" method="post">
													@csrf
													<input type="hidden" name="_method" value="DELETE" />
													<div class="thumb_but">
														<input class="btn_2" type="submit" name="unsend" value="Unsend Request" />
													</div>
												</form>
												@endif

												<!-- @if ($user->profile->status == "MARRIED" && strtoupper($requestsent->Request_received->status) != 'MARRIED')
													<div class="thumb_but" style="color: #c32143">
														<b>{{$user->name}} got married.</b>
													</div>
												@endif -->

												@if (strtoupper($requestsent->Request_received->status) == 'INTERESTED' && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
												<form action="{{action('RequestReceivedController@update',$requestsent->Request_received->id)}}" method="post">
													@csrf
													<input type="hidden" name="_method" value="PATCH" />
													<div class="thumb_but">
														Got married with @if($user->profile->gender == "M") him @else her @endif?
														<input class="btn_2" type="submit" name="SenderMarried" value="Yes" />
														<input class="btn_2" type="submit" name="Not_Interested" value="Never" />
													</div>
												</form>
												@endif

												@if (strtoupper($requestsent->Request_received->status) == 'MARRIED')
												<form action="{{action('RequestReceivedController@update',$requestsent->Request_received->id)}}" method="post">
													@csrf
													<input type="hidden" name="_method" value="PATCH" />
													<div class="thumb_but">
														If not married?
														<input class="btn_2" type="submit" name="NotMarried" value="Revert" />
													</div>
												</form>
												@endif

												<div class="clearfix"> </div>

											</div>
										</div>
										<hr>

								<?php
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
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> ";
									echo "Please <a href='/login'>Login/Register</a></b>";
									echo "</div>";
								} else if ($isProfileCreated == false) {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> ";
									echo "Please <a href=" . route('profile.create') . "> create</a> your profile</b>";
									echo "</div>";
								} else if (sizeof($requestReceiveds) == 0) {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> No request received.</b>";
									echo "</div>";
								} else if (Auth::user()->Profile->isActive() == false && Auth::user()->Profile->status != "MARRIED") {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> Kindly activate your profile first to use request feature.</b>";
									echo "</div>";
								} else {

									$profileStatus = Auth::user()->Profile->status;

									foreach ($requestReceiveds as $requestReceived) {

										if (in_array($requestReceived->id, $allRequestsReceivedFetch) == false) {
											continue;
										}

										$senderProfile = $requestReceived->Request_sent->Profile;
										$user = $senderProfile->User;

										$profile_pic_paths = [];
										$profile_pic_paths[0] = "#";
										if ($user->profile->profile_pic_path != null) {
											$profile_pic_paths = explode(",", $user->profile->profile_pic_path);
										}

										$date1 = date_create(date("Y/m/d"));
										$date2 = date_create($user->last_login_date);
										$diff = date_diff($date1, $date2);
										if ($diff->format("%a") == 0) {
											$lastSeen = "today";
										} else if ($diff->format("%a") == 1) {
											$lastSeen = $diff->format("yesterday");
										} else {
											$lastSeen = $diff->format("%a days ago");
										}

										if ($user->profile->height != null) {
											$heights = explode(".", $user->profile->height);
										}

										if ($newRequestReceiveds->find($requestReceived->id) != null) {
											echo '<div style="background-color:LavenderBlush">';
										} else {
											echo '<div>';
										}

										?>
										<div class="jobs-item with-thumb">
											<div class="thumb_top">
												<div class="thumb"><a href="view_profile.html"><img src="/storage/profile_images/mainimage/{{$profile_pic_paths[0]}}" class="img-responsive" alt="" /></a></div>
												<div class="jobs_right">
													<h6 class="title"><a href="view_profile.html"><b style="color: gray">Request received from</b> <b style="color: #c32143">{{$user->name}} {{$user->lastname}} ({{$user->profile->id}})</b></a></h6>
													<ul class="top-btns" style="color: #c32143">
														<li>{{date('d-M-Y', strtotime($requestReceived->created_at))}} {{date('h:i:s A', strtotime($requestReceived->created_at))}}</li>
													</ul>
													<ul class="login_details1">
														<li>last seen {{$lastSeen}} ({{date("d-M-Y", strtotime($user->last_login_date))}})</li>
													</ul>
													<p class="description">{{$user->profile->age()}} years, {{($user->profile->height != null && sizeof($heights) >= 1) ? $heights[0] : "0"}} Feet {{($user->profile->height != null && sizeof($heights) == 2) ? $heights[1] : "0" }} Inches |
														<span class="m_1">Subcaste</span> : {{$user->profile->subcast}} |
														<span class="m_1">Education</span> : {{$user->profile->education}} |
														<span class="m_1">Occupation</span> : {{$user->profile->occupation}}<br>
														<a href="{{action('ProfilesController@show',$user->profile->id)}}" class="read-more">view full profile</a>
													</p>
												</div>
												<div class="clearfix"> </div>
											</div>

											<div class="thumb_bottom">

												<div class="thumb" style="color: #c32143">
													<b>Status:</b>
													@if ((strtoupper($requestReceived->status) == 'PENDING' || strtoupper($requestReceived->status) == 'NEW') && strtoupper($profileStatus) != "MARRIED"  && $user->profile->status != "MARRIED")
													{{$user->name}} is waiting for your reply
													@elseif (strtoupper($requestReceived->status) == 'NOT INTERESTED')
													Rejected (You sent not interested to {{$user->name}})
													@elseif (strtoupper($requestReceived->status) == 'NOT MARRY BY SENDER')
													Rejected ({{$user->name}} decided not to marry you)
													@elseif (strtoupper($requestReceived->status) == 'NOT MARRY BY RECEIVER')
													Rejected (You decided not to marry {{$user->name}})
													@elseif (strtoupper($requestReceived->status) == 'MARRIED')
													Congratulations! You are married with {{$user->name}}
													@elseif ($user->profile->status == "MARRIED")
													Rejected ({{$user->name}} got married)
													@elseif (strtoupper($profileStatus) == "MARRIED")
													Rejected (You are married)
													@elseif (strtoupper($requestReceived->status) == 'INTERESTED')
													<label style="color: green;">Accepted</label> - <a href="{{action('ProfilesController@show',$user->profile->id)}}" class="read-more">View @if($user->profile->gender == "M") his @else her @endif contact details</a>
													@else
													Rejected - (Your marriage is reverted back)
													@endif
												</div>


												@if ((strtoupper($requestReceived->status) == 'PENDING' || strtoupper($requestReceived->status) == 'NEW') && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
												<form action="{{action('RequestReceivedController@update',$requestReceived->id)}}" method="post">
													@csrf
													<input type="hidden" name="_method" value="PATCH" />
													<div class="thumb_but">
														<input class="btn_2" type="submit" name="Interested" value="Interested" />
														<input class="btn_2" type="submit" name="Not_Interested" value="Not Interested" />
													</div>
												</form>
												@endif

												<!-- @if ($user->profile->status == "MARRIED" && strtoupper($requestReceived->status) != 'MARRIED')
													<div class="thumb_but" style="color: #c32143">
														<b>{{$user->name}} got married.</b>
													</div>
												@endif -->

												@if (strtoupper($requestReceived->status) == 'INTERESTED' && strtoupper($profileStatus) != "MARRIED" && $user->profile->status != "MARRIED")
												<form action="{{action('RequestReceivedController@update',$requestReceived->id)}}" method="post">
													@csrf
													<input type="hidden" name="_method" value="PATCH" />
													<div class="thumb_but">
														Got married with @if($user->profile->gender == "M") him @else her @endif?
														<input class="btn_2" type="submit" name="ReceiverMarried" value="Yes" />
														<input class="btn_2" type="submit" name="Not_Interested" value="Never" />
													</div>
												</form>
												@endif

												@if (strtoupper($requestReceived->status) == 'MARRIED')
												<form action="{{action('RequestReceivedController@update',$requestReceived->id)}}" method="post">
													@csrf
													<input type="hidden" name="_method" value="PATCH" />
													<div class="thumb_but">
														If not married?
														<input class="btn_2" type="submit" name="NotMarried" value="Revert" />
													</div>
												</form>
												@endif

												<div class="clearfix"> </div>

											</div>

										</div>

								<?php
										echo "</div>";
										echo "<hr>";
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
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> ";
									echo "Please <a href='/login'>Login/Register</a></b>";
									echo "</div>";
								} else if ($isProfileCreated == false) {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> ";
									echo "Please <a href=" . route('profile.create') . "> create</a> your profile</b>";
									echo "</div>";
								} else if (Auth::user()->Profile->isActive() == false && Auth::user()->Profile->status != "MARRIED") {
									echo "<div class='alert alert-info'>";
									echo "<b><i class='fa fa-info-circle' aria-hidden='true'></i> Kindly activate your profile first to use request feature.</b>";
									echo "</div>";
								} else {
									$marriedController = new App\Http\Controllers\MarriedController();
									?>
									<div class="alert alert-info">
										<b>
											<?php echo $marriedController->getMarriageStatus(); ?>
										</b>
									</div>
								<?php
								}
								?>
							</div>
						</div>
						<!-- </div> -->
					</div>
					@if ($isLoggedIn && $isProfileCreated && Auth::user()->Profile->isActive())
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
							<ul class="pagination pagination_1">
								<li>{{$allRequests->links()}}</li>
							</ul>
							<div class="clearfix"> </div>

						</div>
					</div>
					@endif
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<script>
		document.getElementById('notificationCount').innerText = <?php echo ($newRequestReceiveds != null) ? $newRequestReceiveds->count() : 0; ?>;
	</script>
	@endsection