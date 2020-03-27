@extends('layouts.home')
@section('header')
@endsection
@section('content')  
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
    <div class="container how-section1"> 
    <div class="col-md-12 text-center">
			<h1 class="mx-auto mb-5 text-uppercase">Introduction</h1>
		</div> 
                    <div class="row">
                        <div class="col-md-6 how-img">
                            <img src="{{ asset('/img/bg-idea.jpg') }}" class="rounded-circle img-fluid" alt=""/>
                        </div>
                        <div class="col-md-6">
                            <h4>Project Background</h4>
                                        <h4 class="subheading">SCI-FI media is a source of inspiration for interactive technology researchers, 
                                        </h4>
                        <p class="white">including those working in robots and Artificial Intelligence. However, with the large volume of SCI-FI media, 
                                        researchers may not be aware of all portrayed content. 
                                        An overview, taxonomy or catalogue can go a long way in seeking ideas, inspirations or knowledge.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>The Purpose</h4>
                                        <h4 class="subheading">Our proposed taxonomy</h4>
                                        <p class="white">will be presented in the form of a portal and will aim to 
                                        differentiate the robots and AI's across a number of variables and factors including their features and appearances. 
                                        Such dissection of SCI-FI 
                                        media will allow researchers to attain a granular view of what range of functionalities are possible.</p>
                        </div>
                        <div class="col-md-6 how-img">
                            <img src="{{ asset('/img/bg-purpose.jpg') }}" class="rounded-circle img-fluid" alt=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 how-img">
                             <img src="{{ asset('/img/bg-team.jpg') }}" class="rounded-circle img-fluid" alt=""/>
                        </div>
                        <div class="col-md-6">
                            <h4>Development Team</h4>
                                        <h4 class="subheading">These are the people that have made a huge contribution and played a great 
                                        role in the human resource (HR) and research development (R&D) of the SCI-FI 
                                        media system/website coming into existence in collaboration with Western Sydney University (UWS) 2019.:</h4>
                                        <p class="white">Supervisor: Omar Mubin<br>Team members: Nhut Cuong Ha, Matthew Sant, Michael Geoffrey Brown, Beji Obong
</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Plan in the Future</h4>
                                        <h4 class="subheading">Our SCI-FI media system/website </h4>
                                        <p class="white">Our SCI-FI media system/website has been designed with flexibility in mind to expand as it grows in data size and adapts to changes that might be needed to the interface/System in the near future. This is just the beginning of 
                                        what&apos; more to come as the catalog expands with more data selection for users and new features are implemented as Technology progresses.

<br>This is just the beginning of what&apos;s more to come</p>
                        </div>
                        <div class="col-md-6 how-img">
                            <img src="{{ asset('/img/bg-plan.jpg') }}" class="rounded-circle img-fluid" alt=""/>
                        </div>
                    </div>
    </div>
</div>
@endsection
@section('footer')
@endsection
 
