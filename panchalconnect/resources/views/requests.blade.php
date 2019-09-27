@extends('layouts.app')

@section('content')
<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
        <a href="/"><i class="fa fa-home home_1"></i></a>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page">Messages</li>
     </ul>
   </div>
  
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
							All requests

						</div>
						</div>
						<!--------------------Request Sent------------------------------->
                        <div class="tab-pane fade" id="request-sent" role="tabpanel" aria-labelledby="request-sent-tab">
						<div class="basic_1">
							Request Sent
						</div>
						</div>
						<!--------------------Request Reeived------------------------------->
                        <div class="tab-pane fade" id="request-received" role="tabpanel" aria-labelledby="request-received-tab">
						<div class="basic_1">
							Request Received
						</div>
						</div>
						<!--------------------Married------------------------------->
                        <div class="tab-pane fade" id="married" role="tabpanel" aria-labelledby="married">
						<div class="basic_1">
							Married
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

@endsection