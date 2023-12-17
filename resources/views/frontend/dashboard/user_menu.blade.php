<div class="services-bar-widget">
    <h3 class="title">User Sidebar</h3>
    <div class="side-bar-categories">
        <img src="{{ !empty($profileData->photo) ? url('uploads/user_images/' . $profileData->photo) : asset('frontend/assets/img/blog/blog-profile1.jpg') }}"
            class="rounded mx-auto d-block" alt="Image" style="width:100px; height:100px;">
        <div class="text-center mt-2">
            <strong>{{ $profileData->name }}</strong> <br>
            <strong>{{ $profileData->email }}</strong>
        </div>
        <br><br>

        <ul>

            <li>
                <a href="{{ route('dashboard') }}">User Dashboard</a>
            </li>
            <li>
                <a href="{{ route('user.profile') }}">User Profile </a>
            </li>
            <li>
                <a href="{{ route('user.change.password') }}">Change Password</a>
            </li>
            <li>
                <a href="{{ route('user.booking') }}">Booking Details </a>
            </li>
            <li>
                <a href="{{ route('user.logout') }}">Logout </a>
            </li>
        </ul>
    </div>
</div>
