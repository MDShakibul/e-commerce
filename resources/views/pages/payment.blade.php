@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			<?php
			 $contents = Cart::getContent();
			 
			?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach($contents as $v_contents){?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($v_contents->attributes->image)}}" style="height : 80px; width : 80px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_contents->name}}</a></h4>
								
							</td>
							<td class="cart_price">
								<p>{{$v_contents->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<form action="{{url('/update-cart')}}" method="post">
								@csrf
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_contents->quantity}}" autocomplete="off" size="2">
									<input  type="hidden" name="id" value="{{$v_contents->id}}" >
<!-- 									<input type="submit" name="submit" value="Update" class="btn btn-sm btn-default">
 -->								</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
								<?php

								$var = $v_contents->price * $v_contents->quantity;
								echo $var;

								?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-from-cart/'.$v_contents->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php } ?>

						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div>
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Payment method</li>
			</ol>
		</div>
		<div class="paymentCont col-sm-6">
					<div class="headingWrap">
							<h3 class="headingTop text-center">Select Your Payment Method</h3>	
<!-- 							<p class="text-center">Created with bootsrap button and using radio button</p>
 -->					</div>
				

					<form action="{{url('/order-place')}}" method="post">
					@csrf
					<input type="radio" name="payment_method" value="handcash"> Hand Cash<br>
					<input type="radio" name="payment_method" value="cart"> Debit Cart<br>
					<input type="radio" name="payment_method" value="bkash"> B-kash<br>
					<input type="submit" name="" value="Done">
					</form>
					<!-- <div class="footerNavWrap clearfix">
						<div class="btn btn-success pull-left btn-fyi"><span class="glyphicon glyphicon-chevron-left"></span> Done</div>
					</div> -->
				</div>
	</div>
</section><!--/#do_action-->

@endsection