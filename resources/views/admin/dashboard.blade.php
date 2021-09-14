@extends('admin.layout.default')


@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <!-- project stats -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-content">
              <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                  <div class="p-1 text-center">
                    <div>
                      <h3 class="font-large-1 grey darken-1 text-bold-400">$84,962</h3>
                      <span class="font-small-3 grey darken-1">Monthly Profit</span>
                    </div>
                    <div class="card-content overflow-hidden">
                      <div id="morris-comments" class="height-75"></div>
                      <ul class="list-inline clearfix mb-0">
                        <li class="border-right-grey border-right-lighten-2 pr-2">
                          <h3 class="success text-bold-400">$8,200</h3>
                          <span class="font-small-3 grey darken-1"><i class="ft-chevron-up success"></i> Today</span>
                        </li>
                        <li class="pl-2">
                          <h3 class="success text-bold-400">$5,400</h3>
                          <span class="font-small-3 grey darken-1"><i class="ft-chevron-down success"></i> Yesterday</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                  <div class="p-1 text-center">
                    <div>
                      <h3 class="font-large-1 grey darken-1 text-bold-400">1,879</h3>
                      <span class="font-small-3 grey darken-1">Total Sales</span>
                    </div>
                    <div class="card-content overflow-hidden">
                      <div id="morris-likes" class="height-75"></div>
                      <ul class="list-inline clearfix mb-0">
                        <li class="border-right-grey border-right-lighten-2 pr-2">
                          <h3 class="primary text-bold-400">4789</h3>
                          <span class="font-small-3 grey darken-1"><i class="ft-chevron-up primary"></i> Today</span>
                        </li>
                        <li class="pl-2">
                          <h3 class="primary text-bold-400">389</h3>
                          <span class="font-small-3 grey darken-1"><i class="ft-chevron-down primary"></i> Yesterday</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                  <div class="p-1 text-center">
                    <div>
                      <h3 class="font-large-1 grey darken-1 text-bold-400">894</h3>
                      <span class="font-small-3 grey darken-1">Support Tickets</span>
                    </div>
                    <div class="card-content overflow-hidden">
                      <div id="morris-views" class="height-75"></div>
                      <ul class="list-inline clearfix mb-0">
                        <li class="border-right-grey border-right-lighten-2 pr-2">
                          <h3 class="danger text-bold-400">81</h3>
                          <span class="font-small-3 grey darken-1"><i class="ft-chevron-up danger"></i> Critical</span>
                        </li>
                        <li class="pl-2">
                          <h3 class="danger text-bold-400">498</h3>
                          <span class="font-small-3 grey darken-1"><i class="ft-chevron-down danger"></i> Low</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ project stats -->
      <!--/ project charts -->
      <div class="row match-height">
        <div class="col-xl-8 col-lg-12">
          <div class="card">
            <div class="card-content">
              <ul class="list-inline text-center pt-2 m-0">
                <li class="mr-1">
                  <h6><i class="ft-circle warning"></i> <span class="grey darken-1">Remaining</span></h6>
                </li>
                <li class="mr-1">
                  <h6><i class="ft-circle success"></i> <span class="grey darken-1">Completed</span></h6>
                </li>
              </ul>
              <div class="chartjs height-250">
                <canvas id="line-stacked-area" height="250"></canvas>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-3 text-center">
                  <span class="text-muted">Total Projects</span>
                  <h2 class="block font-weight-normal">18</h2>
                  <div class="progress mt-2" style="height: 7px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-3 text-center">
                  <span class="text-muted">Total Task</span>
                  <h2 class="block font-weight-normal">125</h2>
                  <div class="progress mt-2" style="height: 7px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-3 text-center">
                  <span class="text-muted">Completed Task</span>
                  <h2 class="block font-weight-normal">242</h2>
                  <div class="progress mt-2" style="height: 7px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-3 text-center">
                  <span class="text-muted">Total Revenue</span>
                  <h2 class="block font-weight-normal">$11,582</h2>
                  <div class="progress mt-2" style="height: 7px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-12">
          <div class="card  card-inverse bg-primary">
            <div class="card-content">
              <div class="card-body sales-growth-chart">
                <div class="chart-title mb-1 text-center">
                  <span class="white">Total monthly Sales.</span>
                </div>
                <div id="monthly-sales" class="height-250"></div>
              </div>
            </div>
            <div class="card-footer text-center">
              <div class="chart-stats mt-1 white">
                <a href="#" class="btn bg-primary bg-darken-3 mr-1 white">Statistics <i class="ft-bar-chart"></i></a> for the last year.
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ project charts -->

      <!--project health, featured & chart-->
      <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body text-center">
                <div class="card-header mb-2">
                  <span class="success darken-1">Total Budget</span>
                  <h3 class="font-large-2 grey darken-1 text-bold-200">$24,879</h3>
                </div>
                <div class="card-content">
                  <input type="text" value="75" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="150" data-height="150" data-inputColor="#e1e1e1" data-readOnly="true" data-fgColor="#37BC9B" data-knob-icon="ft-trending-up">
                  <ul class="list-inline clearfix mt-2 mb-0">
                    <li class="border-right-grey border-right-lighten-2 pr-2">
                      <h2 class="grey darken-1 text-bold-400">75%</h2>
                      <span class="success">Completed</span>
                    </li>
                    <li class="pl-2">
                      <h2 class="grey darken-1 text-bold-400">25%</h2>
                      <span class="danger">Remaining</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
          <div class="card white bg-warning text-center">
            <div class="card-content">
              <div class="card-body">
                <img src="{{asset('/admin-assets/app-assets')}}/images/elements/04.png" alt="element 05" height="170" class="mb-1">
                <h4 class="card-title white">Storage Device</h4>
                <p class="card-text white">945 items</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="media align-items-stretch">
                <div class="p-2 bg-warning text-white media-body text-left rounded-left">
                  <h5 class="text-white">New Orders</h5>
                  <h5 class="text-white text-bold-400 mb-0">4,65,879</h5>
                </div>
                <div class="p-2 text-center bg-warning bg-darken-2 rounded-right">
                  <i class="icon-camera font-large-2 text-white"></i>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="card">
          <div class="card-content">
              <div class="media">
                  <div class="p-2 bg-warning white media-body">
                      <h5 class="white">New Orders</h5>
                      <h5 class="text-bold-400 white">4,65,879</h5>
                  </div>
                  <div class="p-2 text-center bg-warning bg-darken-2 media-left media-middle">
                      <i class="ft-shopping-cart font-large-2 white"></i>
                  </div>
              </div>
          </div>
      </div> -->
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12">
          <div class="card card-inverse bg-info">
            <div class="card-content">
              <div class="position-relative">
                <div class="chart-title position-absolute mt-2 ml-2 white">
                  <h1 class="font-large-2 text-bold-200 white">84%</h1>
                  <span>Employees Satisfied</span>
                </div>
                <canvas id="emp-satisfaction" class="height-400 block"></canvas>
                <div class="chart-stats position-absolute position-bottom-0 position-right-0 mb-3 mr-3 white">
                  <a href="#" class="btn bg-info bg-darken-3 mr-1 white">Statistics <i class="ft-bar-chart"></i></a> for the last year.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- projects table with monthly chart -->
      <div class="row">
        <div class="col-xl-8 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Ongoing Projects</h4>
              <a class="heading-elements-toggle"><i class="ft-more-horizontal font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content">
              <div class="card-body">
                <p class="m-0">Total ongoing projects 6<span class="float-right"><a href="project-summary.html" target="_blank">Project Summary <i class="ft-arrow-right"></i></a></span></p>
              </div>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Project</th>
                      <th>Owner</th>
                      <th>Priority</th>
                      <th>Progress</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-truncate">ReactJS App</td>
                      <td class="text-truncate">
                        <span class="avatar avatar-xs"><img src="{{asset('/admin-assets/app-assets')}}/images/portrait/small/avatar-s-4.png" alt="avatar"></span> <span>Sarah W.</span>
                      </td>
                      <td class="text-truncate"><span class="tag tag-success">Low</span></td>
                      <td class="valign-middle">
                        <div class="progress m-0" style="height: 7px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-truncate">Fitness App</td>
                      <td class="text-truncate">
                        <span class="avatar avatar-xs"><img src="{{asset('/admin-assets/app-assets')}}/images/portrait/small/avatar-s-5.png" alt="avatar"></span> <span>Edward C.</span>
                      </td>
                      <td class="text-truncate"><span class="tag tag-warning">Medium</span></td>
                      <td class="valign-middle">
                        <div class="progress m-0" style="height: 7px;">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-truncate">SOU plugin</td>
                      <td class="text-truncate">
                        <span class="avatar avatar-xs"><img src="{{asset('/admin-assets/app-assets')}}/images/portrait/small/avatar-s-6.png" alt="avatar"></span> <span>Carol E.</span>
                      </td>
                      <td class="text-truncate"><span class="tag tag-danger">Critical</span></td>
                      <td class="valign-middle">
                        <div class="progress m-0" style="height: 7px;">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-truncate">Android App</td>
                      <td class="text-truncate">
                        <span class="avatar avatar-xs"><img src="{{asset('/admin-assets/app-assets')}}/images/portrait/small/avatar-s-7.png" alt="avatar"></span> <span>Gregory L.</span>
                      </td>
                      <td class="text-truncate"><span class="tag tag-success">Low</span></td>
                      <td class="valign-middle">
                        <div class="progress m-0" style="height: 7px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-truncate">ABC Inc. UI/UX</td>
                      <td class="text-truncate">
                        <span class="avatar avatar-xs"><img src="{{asset('/admin-assets/app-assets')}}/images/portrait/small/avatar-s-8.png" alt="avatar"></span> <span>Susan S.</span>
                      </td>
                      <td class="text-truncate"><span class="tag tag-warning">Medium</span></td>
                      <td class="valign-middle">
                        <div class="progress m-0" style="height: 7px;">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-truncate">Product UI</td>
                      <td class="text-truncate">
                        <span class="avatar avatar-xs"><img src="{{asset('/admin-assets/app-assets')}}/images/portrait/small/avatar-s-9.png" alt="avatar"></span> <span>Walter K.</span>
                      </td>
                      <td class="text-truncate"><span class="tag tag-danger">Critical</span></td>
                      <td class="valign-middle">
                        <div class="progress m-0" style="height: 7px;">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-12">
          <div class="card">
            <div class="card-content bg-success">
              <div class="card-body sales-growth-chart">
                <div id="completed-project" class="height-250"></div>
              </div>
            </div>
            <div class="card-footer">
              <div class="chart-title">
                <span class="text-muted">Total completed project and earning.</span>
              </div>
              <ul class="list-inline text-center clearfix mt-2 mb-0">
                <li class="border-right-grey border-right-lighten-2 pr-1"><span class="text-muted">Completed Projects</span>
                  <h3 class="block">250</h3>
                </li>
                <li class="pl-2"><span class="text-muted">Total Earnings</span>
                  <h3 class="block">64.54 M</h3>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--/ projects table with monthly chart -->


      <!-- Recent invoice with Statistics -->
      <div class="row match-height">
        <div class="col-xl-4 col-lg-12">
          <div class="card">
            <div class="card-header no-border-bottom">
              <h4 class="card-title">Invoices Stats</h4>
              <a class="heading-elements-toggle"><i class="ft-more-horizontal font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content">
              <div class="card-body">
                <ul class="list-inline text-right pr-2 mb-0">
                  <li>
                    <h6><i class="ft-circle grey lighten-1"></i> Paid</h6>
                  </li>
                  <li>
                    <h6><i class="ft-circle danger"></i> Unpaid</h6>
                  </li>
                </ul>
              </div>
              <div id="project-invoices" class="height-250"></div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Striped rows</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body">
                <p class="card-text">Use <code class="highlighter-rouge">.table-striped</code> to add zebra-striping to any table row within the <code class="highlighter-rouge">&lt;tbody&gt;</code>. This styling doesn't work in IE8 and below as <code>:nth-child</code> CSS selector isn't supported.</p>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Username</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Recent invoice with Statistics -->


      <!-- Emp of month & social cards -->
      <div class="row">
        <div class="col-xl-4 col-lg-12">
          <div class="card profile-card-with-cover border-grey border-lighten-2">
            <div class="card-img-top img-fluid bg-cover height-200" style="background: url('{{asset('/admin-assets/app-assets')}}/images/carousel/16.jpg');"></div>
            <div class="card-profile-image">
              <img src="{{asset('/admin-assets/app-assets')}}/images/portrait/small/avatar-s-9.png" class="rounded-circle img-border" alt="Card image">
            </div>
            <div class="profile-card-with-cover-content text-center">
              <div class="card-body">
                <h4 class="card-title">Philip Garrett</h4>
                <p class="text-muted m-0">Employee of the month</p>
              </div>
              <div class="card-body">
                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="ft-facebook"></span></a>
                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="ft-twitter"></span></a>
                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span class="ft-github font-medium-4"></span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
          <div class="card bg-twitter white height-200">
            <div class="card-content">
              <div class="card-body">
                <div class="text-center my-1">
                  <i class="ft-twitter font-large-3"></i>
                </div>
                <div class="tweet-slider">
                  <ul class="text-center">
                    <li>Congratulations to Rob Jones in accounting for winning our <span class="yellow">#NFL</span> football pool!</li>
                    <li>Contests are a great thing to partner on. Partnerships immediately <span class="yellow">#DOUBLE</span> the reach.</li>
                    <li>Puns, humor, and quotes are great content on <span class="yellow">#Twitter</span>. Find some related to your business.</li>
                    <li>Are there <span class="yellow">#common-sense</span> facts related to your business? Combine them with a great photo.</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card bg-warning text-center height-200">
            <div class="card-content">
              <div class="card-body">
                <img src="{{asset('/admin-assets/app-assets')}}/images/elements/04.png" alt="element 05" height="110" class="mb-1">
                <h4 class="card-title m-0 white">Storage Device</h4>
                <p class="card-text white">Best Design</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
          <div class="card card-inverse card-success text-center height-200">
            <div class="card-content">
              <div class="card-body">
                <img src="{{asset('/admin-assets/app-assets')}}/images/elements/06.png" alt="element 05" height="110" class="mb-1">
                <h4 class="card-title m-0">Ceramic Bottle</h4>
                <p class="card-text">Best UI</p>
              </div>
            </div>
          </div>
          <div class="card bg-facebook white height-200">
            <div class="card-content">
              <div class="card-body">
                <div class="text-center my-1">
                  <i class="ft-facebook font-large-3"></i>
                </div>
                <div class="fb-post-slider" dir="rtl">
                  <ul class="text-center">
                    <li>Congratulations to Rob Jones in accounting for winning our #NFL football pool!</li>
                    <li>Contests are a great thing to partner on. Partnerships immediately #DOUBLE the reach.</li>
                    <li>Puns, humor, and quotes are great content on #Twitter. Find some related to your business.</li>
                    <li>Are there #common-sense facts related to your business? Combine them with a great photo.</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Emp of month & social cards -->

      <!--CLNDR Wrapper-->
      <div id="clndr" class="clearfix">
        <script type="text/template" id="clndr-template">
          <div class="clndr-controls">
                <div class="clndr-previous-button">&lt;</div>
                <div class="clndr-next-button">&gt;</div>
                <div class="current-month">
                    <%= month %>
                        <%= year %>
                </div>
            </div>
            <div class="clndr-grid">
                <div class="days-of-the-week clearfix">
                    <% _.each(daysOfTheWeek, function(day) { %>
                        <div class="header-day">
                            <%= day %>
                        </div>
                        <% }); %>
                </div>
                <div class="days">
                    <% _.each(days, function(day) { %>
                        <div class="<%= day.classes %>" id="<%= day.id %>"><span class="day-number"><%= day.day %></span></div>
                        <% }); %>
                </div>
            </div>
            <div class="event-listing">
                <div class="event-listing-title">Project meetings</div>
                <% _.each(eventsThisMonth, function(event) { %>
                    <div class="event-item font-small-3">
                        <div class="event-item-day font-small-2">
                            <%= event.date %>
                        </div>
                        <div class="event-item-name text-bold-600">
                            <%= event.title %>
                        </div>
                        <div class="event-item-location">
                            <%= event.location %>
                        </div>
                    </div>
                    <% }); %>
            </div>
        </script>
      </div>
      <!--/CLNDR Wrapper -->

    </div>
  </div>
</div>

@endsection