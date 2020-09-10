@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Update Products</a>
				</li> 
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Products</h2>
						<p class="alert-success">
                    <?php
                    $message=Session::get('message');
                    if($message){
                        echo $message;
                        Session::put('message',null);
                    }
                    ?>
					</div>
					<div class="box-content">
              <form class="form-horizontal" action="{{url('/update_product',$product_info->product_id)}}" method="post" enctype="multipart/form-data">
                     @csrf
						  <fieldset>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_name" value="{{$product_info->product_name}}">
							  </div>
							</div>         
							
                            

							<div class="control-group">
                            <label class="form-control" for="date01">Category Name</label>
							 <div class="controls">
                                <select  class="form-control" name="category_id">
                            	 @foreach($all_category_info as $category)
                                 <option value="{{$category->category_id}}" <?php if(($category->category_id) ==($product_info->category_id)) echo"selected"; ?>>{{$category->category_name}}</option>
                                 @endforeach
							    </select>
                            </div>
                            </div>

		                   <div class="control-group">
           				  <label class="form-control" for="date01">Manufacture Name</label>
						   <div class="controls">
                                <select class="form-control" name="manufacture_id">
                                @foreach($all_manufacture_info as $manufacture)
                               <option value="{{$manufacture->manufacture_id}}" <?php if(($manufacture->manufacture_id) ==($product_info->manufacture_id)) echo"selected"; ?>>{{$manufacture->manufacture_name}}</option>
                               @endforeach
                                </select> 
                              </div>
                            </div>

                            <div class="control-group">
							  <label class="control-label" for="date01">Product Price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_price" value="{{$product_info->product_price}}">
							  </div>
							</div> 

							

							
                            
                            
                            <div class="control-group">
							  <label class="control-label" for="date01">Product Size</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_size" value="{{$product_info->product_size}}">
							  </div>
							</div> 

                            <div class="control-group">
							  <label class="control-label" for="date01">Product Color</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_color" value="{{$product_info->product_color}}">
							  </div>
							</div> 
                            
                            
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update Product</button>
							  <button type="reset" class="btn">Cancel</button>
	                       </div>
                     </fieldset>
                 	</form> 
 @endsection                    