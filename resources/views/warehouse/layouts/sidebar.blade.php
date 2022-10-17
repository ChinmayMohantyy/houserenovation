<div class="dashboard-navbar">

    <div class="d-user-avater">
        <img src="https://via.placeholder.com/500x500" class="img-fluid avater" alt="">
        {{-- <h4>{{auth()->guard('warehouse')->user()->name}}</h4> --}}
        <span>House Captain</span>
        <!-- <div class="elso_syu89">
            <ul>
                <li><a href="#"><i class="ti-facebook"></i></a></li>
                <li><a href="#"><i class="ti-twitter"></i></a></li>
                <li><a href="#"><i class="ti-instagram"></i></a></li>
                <li><a href="#"><i class="ti-linkedin"></i></a></li>
            </ul>
        </div> -->
        <!-- <div class="elso_syu77">
            <div class="one_third">
                <div class="one_45ic text-warning bg-light-warning"><i class="fas fa-star"></i>
                </div><span>Ratings</span>
            </div>
            <div class="one_third">
                <div class="one_45ic text-success bg-light-success"><i class="fas fa-file-invoice"></i></div>
                <span>Courses</span>
            </div>
            <div class="one_third">
                <div class="one_45ic text-purple bg-light-purple"><i class="fas fa-user"></i>
                </div><span>Enrolled User</span>
            </div>
        </div> -->
    </div>

    <div class="d-navigation">
        <ul id="side-menu">
            <li class="active"><a href="{{url('/housecaptain')}}"><i class="fas fa-th"></i>Dashboard</a>
            <li class=""><a href="{{url('/housecaptain/repair-requests')}}"><i class="fas fa-th"></i>House Repair Requests</a>
            </li>
            <!-- <li class="dropdown">
                <a href="javascript:void(0);"><i class="fas fa-shopping-basket"></i>Courses<span
                        class="ti-angle-left"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="manage-course.html">Manage Courses</a></li>
                    <li><a href="add-new-course.html">Add New Course</a></li>
                    <li><a href="course-category.html">Course Category</a></li>
                    <li><a href="coupons.html">Coupons</a></li>
                </ul>
            </li> -->
           <li><a href="{{url('/housecaptain/logout')}}"><i class="fas fa-th"></i>Logout</a></li>
        </ul>
    </div>

</div>