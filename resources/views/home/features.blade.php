@extends('layouts.home')
@section('header')
@endsection
@section('content')  
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container">
    <div class="container">
      <div class="row blog">
          	<div class="col-md-12 text-center">
				<h1 class="mx-auto mb-5 text-uppercase">Features</h1>
			</div>
            <div class="col-md-12">
            	<div id="blogCarousel" class="carousel slide container-blog" data-ride="carousel">
                	<div class="carousel-inner">
                    	<div class="carousel-item active">
                    		<div class="row">
                      			<div class="col-md-4" >
                        			<div class="item-box-blog">
                          				<div class="item-box-blog-image">
                                            <!--Date-->
                                            <div class="item-box-blog-date bg-blue-ui white"> <span class="mon" style="color: Pink;">Filter</span> </div>
                                            <!--Image-->
                                            <figure> <img alt="" src="{{ asset('img/bg-crowdsourcing.jpg') }}"> </figure>
                          				</div>
                          				<div class="item-box-blog-body">
                                            <!--Heading-->
                                            <div class="item-box-blog-heading">
                                              <a href="#" tabindex="0">
                                                <h5>Searching robots/ AIs with advanced filter</h5>
                                              </a>
                                            </div>
                                            <!--Data-->
<!--                                            <div class="item-box-blog-data" style="padding: px 15px;"> -->
<!--                                               <p><i class="fa fa-user-o"></i> Admin, <i class="fa fa-comments-o"></i> Comments(3)</p> -->
<!--                                             </div> -->
                                            <!--Text-->
                                            <div class="item-box-blog-text white">
                                              <p>Robot Galaxy provides a strong filter that can search robots/ AIs by different properties instanly.</p>
                                            </div>
                                            <!--Read More Button-->
<!--                             				<div class="mt"> <a href="#" tabindex="0" class="btn bg-blue-ui white read">read more</a> </div> -->
                          				</div>
                    				</div>
                  				</div>
                  				<div class="col-md-4" >
                        			<div class="item-box-blog">
                          				<div class="item-box-blog-image">
                                            <!--Date-->
                                            <div class="item-box-blog-date bg-blue-ui white"> <span class="mon" style="color: Pink;">Account</span> </div>
                                            <!--Image-->
                                            <figure> <img alt="" src="{{ asset('img/bg-social-media.jpg') }}"> </figure>
                          				</div>
                          				<div class="item-box-blog-body">
                                            <!--Heading-->
                                            <div class="item-box-blog-heading">
                                              <a href="#" tabindex="0">
                                                <h5>Profile management</h5><br>
                                              </a>
                                            </div>
                                            <!--Text-->
                                            <div class="item-box-blog-text white">
                                              <p>With an account you can update your profile, as well as manage your uploaded robot, saved list...</p>
                                            </div>
                                        </div>
                    				</div>
                  				</div>
                  				<div class="col-md-4" >
                        			<div class="item-box-blog">
                          				<div class="item-box-blog-image">
                                            <!--Date-->
                                            <div class="item-box-blog-date bg-blue-ui white"> <span class="mon" style="color: Pink;">Social</span> </div>
                                            <!--Image-->
                                            <figure> <img alt="" src="{{ asset('img/bg-hand.jpg') }}"> </figure>
                          				</div>
                          				<div class="item-box-blog-body">
                                            <!--Heading-->
                                            <div class="item-box-blog-heading">
                                              <a href="#" tabindex="0">
                                                <h5>Communication</h5><br>
                                              </a>
                                            </div>
                                            <!--Text-->
                                            <div class="item-box-blog-text white">
                                              <p>Users can keep in touch by the mail system, and the discussion area.</p>
                                            </div>
                                        </div>
                    				</div>
                  				</div>                      
                            </div>
              			</div>
                	</div>
              	</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
@section('footer')
@endsection
 
