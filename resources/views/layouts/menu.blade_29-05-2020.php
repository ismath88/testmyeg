
<li class="nav-item">
    <a class="nav-link" href="{{ url('home') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>OVERVIEW</span>
    </a>

    <ul class="navbar-item">
        <li class="nav-item {{ Request::is('systemsettings*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('systemsettings.index') }}">
                <span>Systemsettings</span>
            </a>
        </li>

        <li class="nav-item"><a class="nav-link" href="#"><span>Grading</span></a></li>
    </ul>

</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="nav-icon icon-cursor"></i>
        <span>INSTITUTES</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="nav-icon icon-cursor"></i>
        <span>RECRUITERS</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="nav-icon icon-cursor"></i>
        <span>STUDENTS</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="nav-icon icon-cursor"></i>
        <span>INBOX</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="nav-icon icon-cursor"></i>
        <span>PAYMENT</span>
    </a>
</li>


