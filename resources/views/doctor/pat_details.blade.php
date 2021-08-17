  {{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
            
			<div class="container-fluid">
                <div class="form-head d-flex mb-md-5 mb-3 align-items-start">
					<a href="javascript:void(0);" class="btn btn-dark"><i class="flaticon-381-clock mr-2"></i> Edit Profile</a>
					<a href="javascript:void(0);" class="btn btn-outline-danger ml-auto"><i class="flaticon-381-error"></i> Reject Patient</a>
					<a href="javascript:void(0);" class="btn btn-success ml-2"><i class="flaticon-381-success-2"></i> Accept Patient</a>
				</div>
				
                <div class="row">
					<div class="col-xl-8">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="d-flex doctor-info-details mb-5">
											<div class="media align-self-start">
												<img alt="image" class="rounded" width="130" src="{{ asset('images/avatar/2.jpg') }}">
												<i class="flaticon-381-heart"></i>
											</div>
											<div class="media-body">
												<h2 class="mb-2">Brian Lucky</h2>
												<p class="mb-md-2 mb-4">#P-00016</p>
												<span class="mb-md-0 mb-3 d-block"><i class="flaticon-381-clock"></i> Join Date 21 August 2020, 12:45 AM</span>
											</div>
											<div class="text-md-right">
												<div class="dropdown mb-md-3 mb-2">
													<div class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
														<i class="flaticon-381-user-7 mr-2"></i> 
														<span>Cold & Flu</span>
													</div>
													<div class="dropdown-menu dropdown-menu-left">
														<a class="dropdown-item" href="#">A To Z List</a>
														<a class="dropdown-item" href="#">Z To A List</a>
													</div>
												</div>
												<div class="star-review">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
													<span class="ml-3">238 reviews</span>
												</div>
											</div>
										</div>
										
										<div class="doctor-info-content">
											<h3 class="text-black mb-3">Story About Disease</h3>
											<p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
											<p class="mb-2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi </p>
										</div>
									</div>
									<div class="card-footer border-0 pt-0 text-center">
										<a href="#" class="btn-link">Read More</a>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Assigned Doctor</h4>
									</div>
									<div class="card-body">
										<div class="assigned-doctor owl-carousel">
											<div class="items">
												<div class="bootstrap-media">
													<div class="media mb-4">
														<img class="mr-3 img-fluid rounded" width="94" src="{{ asset('images/avatar/1.jpg') }}" alt="DexignZone">
														<div class="media-body">
															<h4 class="mt-0 mb-1 text-black">Dr. Inggrid A.</h4>
															<p class="mb-1">Dentist</p>
															<div class="star-review fs-14">
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-gray"></i>
																<i class="fa fa-star text-gray"></i>
																<span class="ml-3">451 reviews</span>
															</div>
														</div>
													</div>
													<a href="javascript:void(0);" class="btn btn-outline-dark mr-2">Availability</a>
													<a href="javascript:void(0);" class="btn btn-danger">+ Assign</a>
												</div>
											</div>
											<div class="items">
												<div class="bootstrap-media">
													<div class="media mb-4">
														<img class="mr-3 img-fluid rounded" width="94" src="{{ asset('images/avatar/2.jpg') }}" alt="DexignZone">
														<div class="media-body">
															<h4 class="mt-0 mb-1 text-black">Dr. Widan Cheeh</h4>
															<p class="mb-1">Respiratory Specialist</p>
															<div class="star-review fs-14">
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-gray"></i>
																<i class="fa fa-star text-gray"></i>
																<span class="ml-3">451 reviews</span>
															</div>
														</div>
													</div>
													<a href="javascript:void(0);" class="btn btn-outline-dark mr-2">Availability</a>
													<a href="javascript:void(0);" class="btn btn-danger">+ Assign</a>
												</div>
											</div>
											<div class="items">
												<div class="bootstrap-media">
													<div class="media mb-4">
														<img class="mr-3 img-fluid rounded" width="94" src="{{ asset('images/avatar/3.jpg') }}" alt="DexignZone">
														<div class="media-body">
															<h4 class="mt-0 mb-1 text-black">Dr. Samantha Queque</h4>
															<p class="mb-1">Gynecologist</p>
															<div class="star-review fs-14">
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-gray"></i>
																<i class="fa fa-star text-gray"></i>
																<span class="ml-3">451 reviews</span>
															</div>
														</div>
													</div>
													<a href="javascript:void(0);" class="btn btn-outline-dark mr-2">Availability</a>
													<a href="javascript:void(0);" class="btn btn-danger">+ Assign</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Disease History</h4>
									</div>
									<div class="card-body">
										<div class="widget-timeline-icon">
											<ul class="timeline">
												<li>
													<div class="icon bg-primary flaticon-381-heart"></div>
													<a class="timeline-panel text-muted" href="#">
														<h4 class="mb-2 mt-1">Diabetes</h4>
														<p class="fs-15 mb-0 ">Sat, 23 Jul 2020, 01:24 PM</p>
													</a>
												</li>
												<li>
													<div class="icon bg-primary flaticon-381-heart"></div>
													<a class="timeline-panel text-muted" href="#">
														<h4 class="mb-2 mt-1">Sleep Problem</h4>
														<p class="fs-15 mb-0 ">Sat, 23 Jul 2020, 01:24 PM</p>
													</a>
												</li>
												<li>
													<div class="icon bg-primary flaticon-381-heart"></div>
													<a class="timeline-panel text-muted" href="#">
														<h4 class="mb-2 mt-1">Dental Care</h4>
														<p class="fs-15 mb-0 ">Sat, 23 Jul 2020, 01:24 PM</p>
													</a>
												</li>
												<li>
													<div class="icon bg-primary flaticon-381-heart"></div>
													<a class="timeline-panel text-muted" href="#">
														<h4 class="mb-2 mt-1">Diabetes</h4>
														<p class="fs-15 mb-0 ">Sat, 23 Jul 2020, 01:24 PM</p>
													</a>
												</li>
											</ul>	
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Patient Statistic</h4>
									</div>
									<div class="card-body">
										<div class="widget-timeline-icon">
											<div class="row align-items-center mx-0">
												<div class="col-xl-6 col-xxl-12 col-md-12 px-0 mb-3">
													 <span class="donut" data-peity='{ "fill": ["rgb(32, 159, 132)", "rgba(39, 129, 213, 1)","rgba(255, 44, 83, 1)"]}'>2,5,3</span>
												</div>	
												<div class="col-xl-6 col-xxl-12 col-md-12 px-0">
													<p class="mb-2 d-flex  fs-14">Immunities (24%)
														<span class="pull-right ml-auto">25</span>
													</p>
													<div class="progress mb-3" style="height:8px">
														<div class="progress-bar bg-info progress-animated" style="width:85%; height:8px;" role="progressbar">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
													<p class="mb-2 d-flex  fs-14">Heart Beat (41%)
														<span class="pull-right ml-auto">12</span>
													</p>
													<div class="progress mb-3" style="height:8px">
														<div class="progress-bar bg-success progress-animated" style="width:90%; height:8px;" role="progressbar">
															<span class="sr-only">60% Complete</span>
														</div>
													</div>
													<p class="mb-2 d-flex  fs-14">Weigth (15%)
														<span class="pull-right ml-auto">15</span>
													</p>
													<div class="progress" style="height:8px">
														<div class="progress-bar bg-danger progress-animated" style="width:65%; height:8px;" role="progressbar">
															<span class="sr-only">60% Complete</span>
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
					<div class="col-xl-4">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="patient-map-area mb-4">
											<img src="{{ asset('images/map.jpg') }}" alt=""/> 
											<a href="javascript:void(0);" class="btn btn-danger btn-xs">View in Fullscreen</a>
											<i class="flaticon-381-location-4"></i>
										</div>
										<div class="iconbox">
											<i class="las la-map-marker-alt"></i>
											<small>Address</small>
											<p>795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="iconbox">
											<i class="las la-phone"></i>
											<small>Phone</small>
											<p>+12 5123 5512 66</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="iconbox">
											<i class="las la-envelope-open"></i>
											<small>Email</small>
											<p>example@mail.com</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="card bg-secondary">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title text-white mt-1">Note for Patient</h4>
									</div>
									<div class="card-body text-white">
										<p class="mb-0 fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
            </div>

			
@endsection

