{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
            
			<div class="container-fluid">
                <div class="form-head d-flex mb-3 mb-lg-5 align-items-start">
					<a href="javascript:void(0);" class="btn btn-dark"><i class="flaticon-381-clock mr-2"></i> Edit Profile</a>
					<a href="javascript:void(0);" class="btn btn-success ml-auto px-5">+ Add Netw Appointment</a>
				</div>
				
                <div class="row">
					<div class="col-xl-4">
						<div class="row">
							<div class="col-lg-6 col-xl-12">
								<div class="card bg-danger">
									<div class="card-header border-0 pb-0 justify-content-center">
										<h4 class="card-title text-white">Appointment Schedule</h4>
									</div>
									<div class="card-body patient-calender  pb-2">
										<input type='text' class="form-control d-none" id='datetimepicker1' />
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-xl-12">
								<div class="card abilities-chart">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Doctors Abilities</h4>
									</div>
									<div class="card-body">
										<div id="pie-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
										<div class="chart-point">
											<div>
												<span class="a"></span>
												Operation
											</div>
											<div>
												<span class="b"></span>
												Theraphy
											</div>
											<div>
												<span class="c"></span>
												Mediation
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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
												<h2 class="mb-2">Dr. Alexndro Zignee</h2>
												<p class="mb-2">#P-00016</p>
												<span><i class="flaticon-381-clock"></i> Join Date 21 August 2020, 12:45 AM</span>
											</div>
											<div class="text-md-right mt-4 mt-md-0">
												<div class="dropdown mb-3">
													<div class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
														<i class="flaticon-381-user-7 mr-2"></i> Dentist
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
											<h3 class="text-black mb-3">Short Biography</h3>
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
										<h4 class="card-title">Assigned Patient</h4>
									</div>
									<div class="card-body">
										<div class="media patient-box">
											<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/1.jpg') }}" alt="DexignZone">
											<div class="media-body">
												<h3 class="mt-0 mb-2 text-black bold mt-1"><b>Brian Lucky</b></h3>
												<h4 class="mb-4 text-primary">Cold & Flue</h4>
												<a href="javascript:void(0);" class="btn-link mr-4 text-dark">Unassign</a>
												<a href="javascript:void(0);" class="btn-link text-danger ">Check Imporvement</a>
											</div>
											<div id="chart" class="mr-3"></div>
											<div class="media-footer align-self-center">
												<div class="up-sign text-success">
													<i class="fa fa-caret-up"></i>
													<h3 class="text-success">4%</h3>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Recent Review</h4>
									</div>
									<div class="card-body">
										<div class="media review-box mb-4">
											<img class="mr-3 img-fluid rounded" width="105" src="{{ asset('images/avatar/1.jpg') }}" alt="DexignZone">
											<div class="media-body">
												<h4 class="mt-0 mb-3 text-black">Glee Smiley</h4>
												<p class="mb-3">Hospital & staff were extremely warm & quick in getting me start with the procedures.</p>
												<span class="btn btn-xs light btn-danger btn-rounded mb-1">EXCELENT</span>
												<span class="btn btn-xs light btn-danger btn-rounded">GREAT SERVICE</span>
											</div>
											<div class="media-footer">
												<div class="star-review text-md-center">
													<span class="text-primary">4.5</span>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</div>
											</div>
										</div>
										<div class="media review-box mb-4">
											<img class="mr-3 img-fluid rounded" width="105" src="{{ asset('images/avatar/2.jpg') }}" alt="DexignZone">
											<div class="media-body">
												<h4 class="mt-0 mb-3 text-black">Emilian Brownlee</h4>
												<p class="mb-3">Hospital & staff were extremely warm & quick in getting me start with the procedures.</p>
												<span class="btn btn-xs light btn-danger btn-rounded mb-1">EXCELENT</span>
												<span class="btn btn-xs light btn-danger btn-rounded">GREAT SERVICE</span>
											</div>
											<div class="media-footer">
												<div class="star-review text-md-center">
													<span class="text-primary">4.5</span>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</div>
											</div>
										</div>
										<div class="media review-box">
											<img class="mr-3 img-fluid rounded" width="105" src="{{ asset('images/avatar/3.jpg') }}" alt="DexignZone">
											<div class="media-body">
												<h4 class="mt-0 mb-3 text-black">Stevani Anderson</h4>
												<p class="mb-3">Hospital & staff were extremely warm & quick in getting me start with the procedures.</p>
												<span class="btn btn-xs light btn-danger btn-rounded mb-1">EXCELENT</span>
												<span class="btn btn-xs light btn-danger btn-rounded">GREAT SERVICE</span>
											</div>
											<div class="media-footer">
												<div class="star-review text-md-center">
													<span class="text-primary">4.5</span>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer border-0 pt-0 text-center">
										<a href="#" class="btn-link">Read More</a>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
            </div>

			
@endsection

