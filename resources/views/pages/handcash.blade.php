@extends('layout')
@section('content')


	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{url('/customer_login')}}" method="post">
						@csrf
							<input type="email" placeholder="Email" name="customer_email" required=""/>
							<input type="password" placeholder="Passoward" name="password" required="" />
							<!-- <span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span> -->
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				
				
	</section><!--/form-->
	
	


@endsection