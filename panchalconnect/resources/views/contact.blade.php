@extends('layouts.app')

@section('content')
<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
        <a href="/"><i class="fa fa-home home_1"></i></a>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page">Contact</li>
     </ul>
   </div>
   <div class="grid_5">
    <p>We are here for you to support for any queries or doubts regarding this panchalconnect application. 
      If you face any kind of difficulty in using the application, you may contact us. 
      You may either contact us directly using telephone details given below or complete the contact us form, we will contact you within 24 hours.</p>
      <address class="addr row">
        <dl class="grid_4">
            <dt>Address :<br><br><br></dt>
            <dd>
               Aali, Power house road, <br> India, Gujarat, Anand, <br> Khambhat - 388620.
            </dd>
        </dl>
        <dl class="grid_4">
            <dt>Telephones :</dt>
            <dd>
               +91 7202083110 (M)
            </dd>
        </dl>
        <dl class="grid_4">
            <dt>E-mail :</dt>
            <dd>
              kul.d.panchal@gmail.com
            </dd>
        </dl>
      </address>
    </div>
   </div>
</div>
<div class="about_middle">
  <div class="container">
	 <h2>Contact Form</h2>
	  <form id="contact-form" class="contact-form">
        <fieldset>
          <input type="text" class="text" placeholder="" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
          <input type="text" class="text" placeholder="" value="Phone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}">
          <input type="text" class="text" placeholder="" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
          <textarea value="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
          <input name="submit" type="submit" id="submit" value="Submit">
        </fieldset>
      </form>
  </div>
</div>
@endsection