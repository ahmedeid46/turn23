<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <meta name="description" content=" ">

    <meta name="keywords" content=" ">

    <meta name="author" content="joinus">

    <title>B2B - Admin Panal</title>

    <link rel="apple-touch-icon" href="app-assets/images/logo/logo.png">

    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/logo/logo.png">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/apexcharts.css">

    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/toastr.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/bordered-layout.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard-ecommerce.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/charts/chart-apex.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/ext-component-toastr.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/app-ecommerce.min.css">
    
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/ext-component-toastr.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/style.css">
 </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

  <!-- BEGIN: Header-->
  <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow container-xxl">
      <div class="navbar-container d-flex content">
          <div class="bookmark-wrapper d-flex align-items-center">
              <ul class="nav navbar-nav d-xl-none">
                  <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
              </ul>
              <div class="view-options d-flex">
                  <div style="width: 100%" class="btn-group dropdown-sort">
                      <a style="width: 35%" href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">Add Product</a>
                  </div>
              </div>
          </div>
          <ul class="nav navbar-nav align-items-center ms-auto">
              <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#" data-language="ar"><i class="flag-icon flag-icon-ar"></i> Arabic</a></div>
              </li>
              <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="sun"></i></a></li>
              <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                  <div class="search-input">
                      <div class="search-input-icon"><i data-feather="search"></i></div>
                      <input class="form-control input" type="text" placeholder="Explore..." tabindex="-1" data-search="search">
                      <div class="search-input-close"><i data-feather="x"></i></div>
                      <ul class="search-list search-list-main"></ul>
                  </div>
              </li>
              <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up">5</span></a>
                  <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                      <li class="dropdown-menu-header">
                          <div class="dropdown-header d-flex">
                              <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                              <div class="badge rounded-pill badge-light-primary">6 New</div>
                          </div>
                      </li>
                      <li class="scrollable-container media-list"><a class="d-flex" href="#">
                          <div class="list-item d-flex align-items-start">
                              <div class="me-1">
                                  <div class="avatar"><img src="app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" width="32" height="32"></div>
                              </div>
                              <div class="list-item-body flex-grow-1">
                                  <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                              </div>
                          </div></a><a class="d-flex" href="#">
                          <div class="list-item d-flex align-items-start">
                              <div class="me-1">
                                  <div class="avatar"><img src="app-assets/images/portrait/small/avatar-s-3.jpg" alt="avatar" width="32" height="32"></div>
                              </div>
                              <div class="list-item-body flex-grow-1">
                                  <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                              </div>
                          </div></a><a class="d-flex" href="#">
                          <div class="list-item d-flex align-items-start">
                              <div class="me-1">
                                  <div class="avatar bg-light-danger">
                                      <div class="avatar-content">MD</div>
                                  </div>
                              </div>
                              <div class="list-item-body flex-grow-1">
                                  <p class="media-heading"><span class="fw-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                              </div>
                          </div>
                      </a>
                      </li>
                      <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Read all notifications</a></li>
                  </ul>
              </li>
              <li class="nav-item dropdown dropdown-user">
                  <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="user-nav d-sm-flex d-none">
                          <span class="user-name fw-bolder">Ahmed karem</span>
                          <span class="user-status">Admin</span>
                      </div>
                      <span class="avatar">
                <img class="round" src="app-assets/images/avatars/1.png" alt="avatar" height="40" width="40">
                <span class="avatar-status-online"></span>
              </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                      <a class="dropdown-item" href="profile.html"><i class="me-50" data-feather="user"></i> Profile</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="login.html"><i class="me-50" data-feather="power"></i> Logout</a>
                  </div>
              </li>
          </ul>
      </div>
  </nav>
  <!-- END: Header-->


  <!-- BEGIN: Main Menu-->
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
              <li class="nav-item me-auto"><a class="navbar-brand" href="index.html">
              <span class="brand-logo">
                  <img src="app-assets/images/logo/logo.png ">
              </span>
                  <h2 class="brand-text">Zatech</h2></a></li>
              <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
          </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
          <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
              <li class=" nav-item">
                  <a class="d-flex align-items-center" href="index.html">
                      <i data-feather="home"></i>
                      <span class="menu-title text-truncate" data-i18n="Review">Home</span>
                  </a>
              </li>
              <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Permission</span></a>
                  <ul class="menu-content">
                      <li><a class="d-flex align-items-center" href="register-permission.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Register Permission</span></a>
                      </li>
                      <li><a class="d-flex align-items-center" href="addproduct-permission.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Product Permission</span></a>
                      </li>
                      <li><a class="d-flex align-items-center" href="buy-permission.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Edit">Buy Permission</span></a>
                      </li>
                      <li><a class="d-flex align-items-center" href="service-permission.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Service Permission</span></a>
                      </li>
                  </ul>
              </li>
              <li class=" nav-item">
                  <a class="d-flex align-items-center" href="chat.html">
                      <i data-feather='message-circle'></i>
                      <span class="menu-title text-truncate" data-i18n="Review">Chat</span>
                  </a>
              </li>
              <li class=" nav-item">
                  <a class="d-flex align-items-center" href="notification.html">
                      <i data-feather='bell'></i>
                      <span class="menu-title text-truncate" data-i18n="Review">Notifications</span>
                  </a>
              </li>
              <li class=" nav-item">
                  <a class="d-flex align-items-center" href="users.html">
                      <i data-feather='users'></i>
                      <span class="menu-title text-truncate" data-i18n="Review">Users</span>
                  </a>
              </li>
              <li class=" nav-item">
                  <a class="d-flex align-items-center" href="profile.html">
                      <i data-feather='user'></i>
                      <span class="menu-title text-truncate" data-i18n="Review">Profile</span>
                  </a>
              </li>
              <li class=" nav-item">
                  <a class="d-flex align-items-center" href="profile-setting.html">
                      <i data-feather='settings'></i>
                      <span class="menu-title text-truncate" data-i18n="Review">Settings</span>
                  </a>
              </li>
          </ul>
      </div>
  </div>


  <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="row">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Products Permission</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Product</th>
                                    <th>SubCategory</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Company Name</span>
                                    </td>
                                    <td>Oil&Gas</td>
                                    <td>Chemical</td>
                                    <td><span class="badge rounded-pill badge-light-primary me-1">1/12/2022</span></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='addproduct-details.html'">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Show</span>
                                        </button>

                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Edit</span>
                                        </button>

                                        <button class="btn btn-danger">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Company Name</span>
                                    </td>
                                    <td>Oil&Gas</td>
                                    <td>Chemical</td>
                                    <td><span class="badge rounded-pill badge-light-primary me-1">1/12/2022</span></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='addproduct-details.html'">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Show</span>
                                        </button>

                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Edit</span>
                                        </button>

                                        <button class="btn btn-danger">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Company Name</span>
                                    </td>
                                    <td>Oil&Gas</td>
                                    <td>Chemical</td>
                                    <td><span class="badge rounded-pill badge-light-primary me-1">1/12/2022</span></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='addproduct-details.html'">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Show</span>
                                        </button>

                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Edit</span>
                                        </button>

                                        <button class="btn btn-danger">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Company Name</span>
                                    </td>
                                    <td>Oil&Gas</td>
                                    <td>Chemical</td>
                                    <td><span class="badge rounded-pill badge-light-primary me-1">1/12/2022</span></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='addproduct-details.html'">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Show</span>
                                        </button>

                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Edit</span>
                                        </button>

                                        <button class="btn btn-danger">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Company Name</span>
                                    </td>
                                    <td>Oil&Gas</td>
                                    <td>Chemical</td>
                                    <td><span class="badge rounded-pill badge-light-primary me-1">1/12/2022</span></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='addproduct-details.html'">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Show</span>
                                        </button>

                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Edit</span>
                                        </button>

                                        <button class="btn btn-danger">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold">Company Name</span>
                                    </td>
                                    <td>Oil&Gas</td>
                                    <td>Chemical</td>
                                    <td><span class="badge rounded-pill badge-light-primary me-1">1/12/2022</span></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='addproduct-details.html'">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Show</span>
                                        </button>

                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Edit</span>
                                        </button>

                                        <button class="btn btn-danger">
                                            <i data-feather="eye" class="me-50"></i>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

  <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel17">Add Product</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="mb-1">
                          <label class="form-label">Email</label>
                          <input type="text" class="form-control" placeholder="name@example.com"
                          />
                      </div>
                      <div class="mb-1">
                          <label class="form-label" for="selectDefault3">Select Service Category</label>
                          <select class="form-select" id="selectDefault3">
                              <option selected>Open this select menu</option>
                              <option value="fertilizers">fertilizers</option>
                              <option value="2">pharmaceuticals</option>
                              <option value="3">cement</option>
                              <option value="2">detergents</option>
                          </select>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal2 fade text-start" id="large2" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel17">Add Product</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="mb-1">
                          <label class="form-label">Email</label>
                          <input type="text" class="form-control" placeholder="name@example.com"
                          />
                      </div>
                      <div class="mb-1">
                          <label class="form-label" for="selectDefault3">Select Service Category</label>
                          <select class="form-select" id="selectDefault3">
                              <option selected>Open this select menu</option>
                              <option value="fertilizers">fertilizers</option>
                              <option value="2">pharmaceuticals</option>
                              <option value="3">cement</option>
                              <option value="2">detergents</option>
                          </select>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
              </div>
          </div>
      </div>
  </div>


  <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT  &copy; 2021<a class="ms-25" href="#" target="_blank">Zatech</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
      </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.min.js"></script>
    <script src="app-assets/js/core/app.min.js"></script>
    <script src="app-assets/js/scripts/customizer.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>
    <script src="app-assets/js/scripts/pages/app-ecommerce-wishlist.min.js"></script>
    <!-- END: Page JS-->

    <script src="app-assets/js/scripts/components/components-modals.min.js"></script>

    <script>
      $(window).on('load',  function(){
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      })
    </script>
  </body>
</html>