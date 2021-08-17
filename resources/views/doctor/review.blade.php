{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
            
			<div class="container-fluid">
                <div class="form-head d-flex mb-5     align-items-start">
					<div class="input-group search-area d-inline-flex">
						<input type="text" class="form-control" placeholder="Search here">
						<div class="input-group-append">
							<span class="input-group-text"><i class="flaticon-381-search-2"></i></span>
						</div>
					</div>
					<a href="javascript:void(0);" class="btn btn-danger ml-auto">DELETE</a>
					<a href="javascript:void(0);" class="btn btn-success ml-3">PUBLISH</a>
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
				</div>
                <div class="row">
					<div class="col-xl-12">
						<ul class="nav nav-pills review-tab">
							<li class="nav-item">
								<a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">ALL REVIEW</a>
							</li>
							<li class="nav-item">
								<a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">PUBLISHED</a>
							</li>
							<li class="nav-item">
								<a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="true">DELETED</a>
							</li>
						</ul>
						<div class="tab-content">
							<div id="navpills-1" class="tab-pane active">
								<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox1" required="">
												<label class="custom-control-label" for="customCheckBox1"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/1.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Glee Smiley
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Diabetes</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
								<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox2" required="">
												<label class="custom-control-label" for="customCheckBox2"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/2.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Alexa Keev
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Dental Care</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
								<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox3" required="">
												<label class="custom-control-label" for="customCheckBox3"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/3.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Ivankov
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Cold & Flu</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
								<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox4" required="">
												<label class="custom-control-label" for="customCheckBox4"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/4.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Axestoria Jr.
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Diabetes</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="navpills-2" class="tab-pane">
								<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox1_2" required="">
												<label class="custom-control-label" for="customCheckBox1_2"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/1.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Glee Smiley
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Diabetes</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
								<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox2_2" required="">
												<label class="custom-control-label" for="customCheckBox2_2"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/2.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Alexa Keev
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Dental Care</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div id="navpills-3" class="tab-pane">
									<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox2_1" required="">
												<label class="custom-control-label" for="customCheckBox2_1"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/2.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Alexa Keev
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Dental Care</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
								<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox3_1" required="">
												<label class="custom-control-label" for="customCheckBox3_1"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/3.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Ivankov
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Cold & Flu</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
								<div class="card review-table">
									<div class="media">
										<div class="checkbox mr-3 align-self-center">
											<div class="custom-control custom-checkbox checkbox-info">
												<input type="checkbox" class="custom-control-input" checked="" id="customCheckBox4_1" required="">
												<label class="custom-control-label" for="customCheckBox4_1"></label>
											</div>
										</div>
										<img class="mr-3 img-fluid rounded" width="110" src="{{ asset('images/avatar/4.jpg') }}" alt="DexignZone">
										<div class="media-body">
											<h3 class="fs-20 text-black font-w600 mb-3">Axestoria Jr.
												<span class="star-review ml-3 d-inline-block">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</span>
											</h3>
											<p>When I came with my mother, I was very nervous. But after entering here I felt warmed with smiling</p>
											<span class="fs-15">Sunday, 24 July 2020   04:55 PM</span>
										</div>
										<div class="media-footer d-flex align-self-center">
											<div class="disease mr-5">
												<p class="mb-1 fs-14">Disease</p>
												<h4 class="text-success">Diabetes</h4>
											</div>
											<div class="edit ml-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger">DELETE</a>
												<a href="javascript:void(0);" class="btn btn-outline-success ml-2">PUBLISH</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				   </div>
					<div class="col-xl-12">
						<div class="d-md-flex d-block align-items-center mt-4">
							<p>Showing 10 from 46 data</p>
							<nav class="ml-auto">
								<ul class="pagination pagination-gutter pagination-danger">
									<li class="page-item page-indicator">
										<a class="page-link" href="javascript:void()">
											<i class="la la-angle-left"></i></a>
									</li>
									<li class="page-item active"><a class="page-link" href="javascript:void()">1</a>
									</li>
									<li class="page-item"><a class="page-link" href="javascript:void()">2</a></li>
									<li class="page-item"><a class="page-link" href="javascript:void()">3</a></li>
									<li class="page-item"><a class="page-link" href="javascript:void()">4</a></li>
									<li class="page-item page-indicator">
										<a class="page-link" href="javascript:void()">
											<i class="la la-angle-right"></i></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
            </div>

			
@endsection

