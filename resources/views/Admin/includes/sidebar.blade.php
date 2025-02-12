<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style=" position: fixed;">
      <!-- Brand Logo -->
      <a href="/admindashboard" class="brand-link">
          <img src="{{ asset('/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Tega Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{Auth::user()->name}}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
                    <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-house"></i>
                                <p>
                                    Home
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="/admin/addslider" class="nav-link">
                                  <i class="fa-regular fa-images"></i>
                                  <p>
                                      Add Slider
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addproduct" class="nav-link">
                                  <i class="fa-solid fa-cart-shopping"></i>
                                  <p>
                                      Add Product
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addhistory" class="nav-link">
                                  <i class="fa-solid fa-clock-rotate-left"></i>
                                  <p>
                                      Add History
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addmission" class="nav-link">
                                  <i class="fa-solid fa-rocket"></i>
                                  <p>
                                      Add Mission
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addvision" class="nav-link">
                                  <i class="fa-solid fa-eye"></i>
                                  <p>
                                      Add Vision
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addtestimonial" class="nav-link">
                                  <i class="fa-solid fa-comment"></i>
                                  <p>
                                      Add Testimonial
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addindustry" class="nav-link">
                                  <i class="fa-solid fa-industry"></i>
                                  <p>
                                      Add Industry On Focus
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addpioneers" class="nav-link">
                                  <i class="fa-solid fa-people-group"></i>
                                  <p>
                                      Add Industry Pioneers
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addblog" class="nav-link">
                                  <i class="fa-solid fa-blog"></i>
                                  <p>
                                      Add Blog Posts
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addcasestudy" class="nav-link">
                                  <i class="fa-solid fa-magnifying-glass"></i>
                                  <p>
                                      Add Case Study
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addfaq" class="nav-link">
                                  <i class="fa-solid fa-clipboard-question"></i>
                                  <p>
                                      Add FAQ
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addbrochure" class="nav-link">
                                  <i class="fa-solid fa-file"></i>
                                  <p>
                                      Add Brochure
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/admin/addnews" class="nav-link">
                                  <i class="fa-solid fa-newspaper"></i>
                                  <p>
                                      Add News
                                  </p>
                              </a>
                          </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-briefcase"></i>
                                <p>
                                    Career
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/addjob" class="nav-link">
                                <i class="fa-solid fa-user-check"></i>
                                    <p>
                                        Add Job
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fa-solid fa-gears"></i>
                                <p>
                                    Resources
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/addmedia" class="nav-link">
                                <i class="fa-solid fa-photo-film"></i>
                                    <p>
                                    Add Media
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/addvideo" class="nav-link">
                                <i class="fa-solid fa-photo-film"></i>
                                    <p>
                                    Add Video
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/addevent" class="nav-link">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <p>
                                        Add Event
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/addwhitepaper" class="nav-link">
                                    <i class="fa-solid fa-image"></i>
                                    <p>
                                        Add Whitepaper
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
</div>
</body>