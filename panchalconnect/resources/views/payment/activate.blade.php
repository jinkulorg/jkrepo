<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
@extends('layouts.app')

@section('content')
<div class="grid_3">
	<div class="container">
		<div class="breadcrumb1">
			<ul>
				<a href="/"><i class="fa fa-home home_1"></i></a>
				<span class="divider">&nbsp;|&nbsp;</span>
				<li class="current-page">Activate Account</li>
			</ul>
		</div>
		<?php
		if (Auth::User() != null && Auth::User()->profile != null) {
			?>
			<form method="post" action="/pgRedirect">
				@csrf
				<table border="1">
					<tbody>
						<tr>
							<td><label>Payment ID: </label></td>
							<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . rand(10000, 99999999) ?>" readonly>
							</td>
						</tr>
						<tr>
							<td><label>Profile Id: </label></td>
							<td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="{{Auth::User()->profile->id}}" readonly></td>
						</tr>
						<tr>
							<td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" hidden></td>
						</tr>
						<tr>
							<td><input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" hidden>
							</td>
						</tr>
						<tr>
							<td><label>Amount</label></td>
							<td><input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="300" readonly>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input value="Pay" type="submit" onclick=""></td>
						</tr>
					</tbody>
				</table>
			</form>
		<?php
		}
		?>
	</div>
</div>
@endsection