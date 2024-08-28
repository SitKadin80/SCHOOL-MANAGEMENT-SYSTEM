<div class="sidebar" data-color="orange">
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ request()->is('student') ? 'active' : '' }}">
                <a href="{{ URL('student') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>Student</p>
                </a>
            </li>
            <li class="{{ request()->is('teacher') ? 'active' : '' }}">
                <a href="{{ URL('teacher') }}">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>Teacher</p>
                </a>
            </li>
            <li class="{{ request()->is('room') ? 'active' : '' }}">
                <a href="{{ URL('room') }}">
                    <i class="now-ui-icons education_atom"></i>
                    <p>Room</p>
                </a>
            </li>
        </ul>
    </div>

</div>