<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <!-- Dashboard -->
        <li class="{{ setSidebar(['instructor.dashboard']) }}">
            <a href="{{ route('instructor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-category'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if(isApprovedUser())
            <!-- Manage Courses -->
            <li class="{{ setSidebar(['instructor.course*']) }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i></div>
                    <div class="menu-title">Manage Courses</div>
                </a>
                <ul>
                    <li
                        class="{{ setSidebar(['instructor.course.index', 'instructor.course.show', 'instructor.course.edit']) }}">
                        <a href="{{ route('instructor.course.index') }}">
                            <i class='bx bx-radio-circle'></i>All Courses
                        </a>
                    </li>
                    <li class="{{ setSidebar(['instructor.course.create']) }}">
                        <a href="{{ route('instructor.course.create') }}">
                            <i class='bx bx-radio-circle'></i>Add Course
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Manage Coupons -->
            <li class="{{ setSidebar(['instructor.coupon*']) }}">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i></div>
                    <div class="menu-title">Manage Coupons</div>
                </a>
                <ul>
                    <li class="{{ setSidebar(['instructor.coupon.index']) }}">
                        <a href="">
                            <i class='bx bx-radio-circle'></i>All Coupons
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>