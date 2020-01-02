<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="user-pic">
                            <img src="<?php echo e(asset(Auth::user()->photo)); ?>" alt="users" class="rounded-circle img-fluid" />
                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="m-b-10 user-name font-medium"><?php echo e(Auth::user()->name); ?></h5>
                            <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti-settings"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="logout()" title="Logout" class="btn btn-circle btn-sm">
                            <i class="ti-power-off"></i>
                        </a>
                        <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                            <a class="dropdown-item" href="<?php echo e(url('users')); ?>">
                                <i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="logout()">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                </div>
                            </div>
                        </div>
                        <!-- End User Profile-->
                    </li>
                    <!-- User Profile-->
                    <li class="sidebar-item <?php echo e((request()->segment(1) == '' ? 'selected' : '')); ?>">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(url('/')); ?>" aria-expanded="false">
                        <i class="mdi mdi-home"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Data</span>
                </li>
                <li class="sidebar-item <?php echo e((request()->segment(1) == 'students' ? 'selected' : '')); ?>">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(url('students')); ?>

                    " aria-expanded="false">
                    <i class="mdi mdi-account-multiple-outline"></i>
                    <span class="hide-menu">Siswa</span>
                </a>
            </li>
            <li class="sidebar-item <?php echo e((request()->segment(1) == 'teachers' ? 'selected' : '')); ?>">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(url('teachers')); ?>

                " aria-expanded="false">
                <i class="mdi mdi-account-convert"></i>
                <span class="hide-menu">Guru</span>
            </a>
        </li>
        <li class="sidebar-item <?php echo e((request()->segment(1) == 'employees' ? 'selected' : '')); ?>">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(url('employees')); ?>

            " aria-expanded="false">
            <i class="mdi mdi-account-switch"></i>
            <span class="hide-menu">Karyawan</span>
        </a>
    </li>
    <li class="sidebar-item <?php echo e((request()->segment(1) == 'rombels' || request()->segment(1) == 'rayons' ? 'selected' : '')); ?>">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="icon-Car-Wheel"></i>
            <span class="hide-menu">Master Data </span>
        </a>
        <ul aria-expanded="false" class="collapse  first-level">
            <li class="sidebar-item">
                <a href="<?php echo e(url('rombels')); ?>" class="sidebar-link">
                    <i class="icon-Record"></i>
                    <span class="hide-menu"> Rombel </span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?php echo e(url('rayons')); ?>" class="sidebar-link">
                    <i class="icon-Record"></i>
                    <span class="hide-menu"> Rayon </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-small-cap">
        <i class="mdi mdi-dots-horizontal"></i>
        <span class="hide-menu">Absensi</span>
    </li>
    <li class="sidebar-item <?php echo e((request()->segment(2) == 'students-list' || request()->segment(1) == 'students-calendar' ? 'selected' : '')); ?>">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="icon-Calendar-2"></i>
            <span class="hide-menu">Siswa </span>
        </a>
        <ul aria-expanded="false" class="collapse  first-level">
            <li class="sidebar-item">
                <a href="<?php echo e(url('absent/students-list')); ?>" class="sidebar-link">
                    <i class="icon-Record"></i>
                    <span class="hide-menu"> List </span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?php echo e(url('absent/students-calendar')); ?>" class="sidebar-link">
                    <i class="icon-Record"></i>
                    <span class="hide-menu"> Kalender </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="sidebar-item <?php echo e((request()->segment(2) == 'teachers-list' || request()->segment(1) == 'teachers-calendar' ? 'selected' : '')); ?>">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="icon-Calendar-4"></i>
            <span class="hide-menu">Guru </span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
                <a href="<?php echo e(url('absent/teachers-list')); ?>" class="sidebar-link">
                    <i class="icon-Record"></i>
                    <span class="hide-menu"> List </ span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="<?php echo e(url('absent/teachers-calendar')); ?>" class="sidebar-link">
                    <i class="icon-Record"></i>
                    <span class="hide-menu"> Kalender </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-small-cap">
        <i class="mdi mdi-dots-horizontal"></i>
        <span class="hide-menu">Extra</span>
    </li>
    <li class="sidebar-item <?php echo e((request()->segment(1) == 'settings' ? 'selected' : '')); ?>">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(url('settings')); ?>" aria-expanded="false">
        <i class="mdi mdi-settings"></i>
        <span class="hide-menu">Settings</span>
        </a>
    </li>
    <li class="sidebar-item <?php echo e((request()->segment(1) == 'log_activity' ? 'selected' : '')); ?>">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(url('log_activity')); ?>" aria-expanded="false">
        <i class="mdi mdi-tumblr-reblog"></i>
        <span class="hide-menu">Log Activity</span>
        </a>
    </li>
</ul>
</nav>
<!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside><?php /**PATH C:\xampp\htdocs\absensi\resources\views/components/left-sidebar.blade.php ENDPATH**/ ?>