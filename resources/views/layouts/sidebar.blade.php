<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo"><a href="{{ route('home') }}">
                        <img src="assets/images/logo.png" alt="" style="width: 21%;" /> <span>Hostel</span></a></div>
                <li><a href="{{ route('home') }}"><i class="ti-home"></i> Dashboard </a>

                </li>
                @if(auth()->user()->role_id == 1)

                <li><a class="sidebar-sub-toggle"><i class="ti-home"></i> Hostels <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ route('add.hostel') }}">Add Hostel</a></li>
                        <li><a href="{{ route('show.hostel') }}">All Hostels</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> Roles <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ route('add.user') }}">Add New Role</a></li>
                        <li><a href="{{ route('all.users') }}">All Roles</a></li>
                    </ul>
                </li>

                <li><a class="sidebar-sub-toggle"><i class="ti-layout-grid2-alt"></i> Rooms <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ route('ad.room') }}">Add Room</a></li>
                        <li><a href="{{ route('all.rooms') }}">All Rooms</a></li>
                    </ul>
                </li>

                <li><a class="sidebar-sub-toggle"><i class="ti-layout"></i> Courses <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ route('add.course') }}">Add Course</a></li>
                        <li><a href="{{ route('all.courses') }}">All Courses</a></li>

                    </ul>
                </li>
                @endif
                @if(auth()->user()->role_id == 3)
                <li><a href="{{ route('profile') }}"><i class="ti-user"></i> Profile</a></li>
                <li><a href="{{ route('change.password') }}"><i class="ti-target"></i> Change Password</a></li>
                <li><a href="{{ route('hostel.booking') }}"><i class="ti-panel"></i> Book Hostel</a></li>
                <li><a href="{{ route('room.detail') }}"><i class="ti-view-list-alt"></i> Room Detail</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
