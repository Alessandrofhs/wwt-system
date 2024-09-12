<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('deskapp-master/vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo" />
            <img src="{{ asset('deskapp-master/vendors/images/deskapp-logo-white.svg') }}" alt=""
                class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-house"></span><span class="mtext">Home</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-database"></span><span class="mtext">Master Data</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('limbah') }}">Limbah</a></li>
                        <li><a href="{{ route('destination') }}">Destination</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('report') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Report</span>
                    </a>
                </li>
                <li>
                    <a href="calendar.html" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-file-earmark-check"></span><span class="mtext">Approval</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
