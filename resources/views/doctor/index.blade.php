{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
            
			<div class="container-fluid">
                <div class="form-head d-flex mb-3  mb-lg-5   align-items-start">
					<a href="javascript:void(0);" class="btn btn-danger">+ New Doctor</a>
					<div class="input-group search-area ml-auto d-inline-flex">
						<input type="text" class="form-control" placeholder="Search here">
						<div class="input-group-append">
							<span class="input-group-text"><i class="flaticon-381-search-2"></i></span>
						</div>
					</div>
					<div class="dropdown ml-3 d-inline-block">
						<div class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
							<i class="flaticon-381-controls-3 mr-2"></i> Filter
						</div>
						<div class="dropdown-menu dropdown-menu-left">
							<a class="dropdown-item" href="#">A To Z List</a>
							<a class="dropdown-item" href="#">Z To A List</a>
						</div>
					</div>
					<div class="dropdown ml-3 d-inline-block">
						<div class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
							Newest
						</div>
						<div class="dropdown-menu dropdown-menu-left">
							<a class="dropdown-item" href="#">Newest</a>
							<a class="dropdown-item" href="#">Old</a>
						</div>
					</div>
					<a href="javascript:void(0);" class="btn btn-outline-primary ml-3"><i class="flaticon-381-menu-1 mr-0"></i></a>
					<a href="javascript:void(0);" class="btn btn-light ml-3"><i class="flaticon-381-pad mr-0"></i></a>
				</div>
				
                <div class="row">
					<div class="col-xl-12">
						<div id="accordion-one" class="accordion doctor-list ">
							<div class="accordion__item">
								<div class="accordion__header rounded-lg" data-toggle="collapse" data-target="#default_collapseOne">
									<span class="accordion__header-alphabet">A</span>
									<span class="accordion__header-line flex-grow-1"></span>
									<span class="accordion__header--text">5 Doctors</span>
									<span class="accordion__header--indicator style_two"></span>
								</div>
								<div id="default_collapseOne" class="collapse accordion__body show" data-parent="#accordion-one">
										<div class="widget-media best-doctor pt-4">
											<div class="timeline row">
												<div class="col-lg-6">
													<div class="timeline-panel bg-white p-4 mb-4">
														<div class="media mr-4">
															<img alt="image" width="90" src="{{ asset('images/avatar/1.jpg') }}">
														</div>
														<div class="media-body">
															<h4 class="mb-2">Dr. Samantha Queque</h4>
															<p class="mb-2 text-primary">Gynecologist</p>
															<div class="star-review">
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-gray"></i>
																<i class="fa fa-star text-gray"></i>
																<span class="ml-3">451 reviews</span>
															</div>
														</div>
														<div class="social-media">
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="timeline-panel active bg-white p-4  mb-4" >
														<div class="media mr-4">
															<img alt="image" width="90" src="{{ asset('images/avatar/2.jpg') }}">
														</div>
														<div class="media-body">
															<h4 class="mb-2">Dr. Abdul Aziz Lazis</h4>
															<p class="mb-2 text-primary">Physical Therapy</p>
															<div class="star-review">
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-gray"></i>
																<span class="ml-3">238 reviews</span>
															</div>
														</div>
														<div class="social-media">
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="timeline-panel bg-white p-4 mb-4">
														<div class="media mr-4">
															<img alt="image" width="90" src="{{ asset('images/avatar/3.jpg') }}">
														</div>
														<div class="media-body">
															<h4 class="mb-2">Dr. Samuel Jr.</h4>
															<p class="mb-2 text-primary">Dentist</p>
															<div class="star-review">
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-gray"></i>
																<i class="fa fa-star text-gray"></i>
																<span class="ml-3">300 reviews</span>
															</div>
														</div>
														<div class="social-media">
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="timeline-panel bg-white p-4 mb-4">
														<div class="media mr-4">
															<img alt="image" width="90" src="{{ asset('images/avatar/4.jpg') }}">
														</div>
														<div class="media-body">
															<h4 class="mb-2">Dr. Alex Siauw</h4>
															<p class="mb-2 text-primary">Physical Therapy</p>
															<div class="star-review">
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-gray"></i>
																<i class="fa fa-star text-gray"></i>
																<span class="ml-3">451 reviews</span>
															</div>
														</div>
														<div class="social-media">
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="timeline-panel bg-white p-4 mb-4">
														<div class="media mr-4">
															<img alt="image" width="90" src="{{ asset('images/avatar/5.jpg') }}">
														</div>
														<div class="media-body">
															<h4 class="mb-2">Dr. Jennifer Ruby</h4>
															<p class="mb-2 text-primary">Nursingc</p>
															<div class="star-review">
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<i class="fa fa-star text-orange"></i>
																<span class="ml-3">700 reviews</span>
															</div>
														</div>
														<div class="social-media">
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
															<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
														</div>
													</div>
												</div>
											</div>
										</div>
								</div>
							</div>
							<div class="accordion__item">
								<div class="accordion__header rounded-lg" data-toggle="collapse" data-target="#default_collapseTwo">
									<span class="accordion__header-alphabet">B</span>
									<span class="accordion__header-line flex-grow-1"></span>
									<span class="accordion__header--text">3 Doctors</span>
									<span class="accordion__header--indicator style_two"></span>
								</div>
								<div id="default_collapseTwo" class="collapse accordion__body" data-parent="#accordion-one">
									<div class="widget-media best-doctor pt-4">
										<div class="timeline row">
											<div class="col-lg-6">
												<div class="timeline-panel bg-white p-4 mb-4">
													<div class="media mr-4">
														<img alt="image" width="90" src="{{ asset('images/avatar/1.jpg') }}">
													</div>
													<div class="media-body">
														<h4 class="mb-2">Dr. Samantha Queque</h4>
														<p class="mb-2 text-primary">Gynecologist</p>
														<div class="star-review">
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-gray"></i>
															<i class="fa fa-star text-gray"></i>
															<span class="ml-3">451 reviews</span>
														</div>
													</div>
													<div class="social-media">
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="timeline-panel active bg-white p-4  mb-4" >
													<div class="media mr-4">
														<img alt="image" width="90" src="{{ asset('images/avatar/2.jpg') }}">
													</div>
													<div class="media-body">
														<h4 class="mb-2">Dr. Abdul Aziz Lazis</h4>
														<p class="mb-2 text-primary">Physical Therapy</p>
														<div class="star-review">
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-gray"></i>
															<span class="ml-3">238 reviews</span>
														</div>
													</div>
													<div class="social-media">
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="timeline-panel bg-white p-4 mb-4">
													<div class="media mr-4">
														<img alt="image" width="90" src="{{ asset('images/avatar/3.jpg') }}">
													</div>
													<div class="media-body">
														<h4 class="mb-2">Dr. Samuel Jr.</h4>
														<p class="mb-2 text-primary">Dentist</p>
														<div class="star-review">
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-gray"></i>
															<i class="fa fa-star text-gray"></i>
															<span class="ml-3">300 reviews</span>
														</div>
													</div>
													<div class="social-media">
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion__item">
								<div class="accordion__header rounded-lg" data-toggle="collapse" data-target="#default_collapseThree">
									<span class="accordion__header-alphabet">C</span>
									<span class="accordion__header-line flex-grow-1"></span>
									<span class="accordion__header--text">2 Doctors</span>
									<span class="accordion__header--indicator style_two"></span>
								</div>
								<div id="default_collapseThree" class="collapse accordion__body" data-parent="#accordion-one">
									<div class="widget-media best-doctor pt-4">
										<div class="timeline row">
											<div class="col-lg-6">
												<div class="timeline-panel active bg-white p-4  mb-4" >
													<div class="media mr-4">
														<img alt="image" width="90" src="{{ asset('images/avatar/2.jpg') }}">
													</div>
													<div class="media-body">
														<h4 class="mb-2">Dr. Abdul Aziz Lazis</h4>
														<p class="mb-2 text-primary">Physical Therapy</p>
														<div class="star-review">
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-gray"></i>
															<span class="ml-3">238 reviews</span>
														</div>
													</div>
													<div class="social-media">
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="timeline-panel bg-white p-4 mb-4">
													<div class="media mr-4">
														<img alt="image" width="90" src="{{ asset('images/avatar/3.jpg') }}">
													</div>
													<div class="media-body">
														<h4 class="mb-2">Dr. Samuel Jr.</h4>
														<p class="mb-2 text-primary">Dentist</p>
														<div class="star-review">
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-orange"></i>
															<i class="fa fa-star text-gray"></i>
															<i class="fa fa-star text-gray"></i>
															<span class="ml-3">300 reviews</span>
														</div>
													</div>
													<div class="social-media">
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
														<a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
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