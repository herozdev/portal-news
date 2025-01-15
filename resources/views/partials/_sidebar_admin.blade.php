<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : 'collapsed' }}" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a href="/" target="_blank" class="nav-link collapsed">
                <i class="bi bi-box-arrow-up-right"></i>
                <span>View Portal</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/posts') ? '' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse {{ Request::is('dashboard/posts*') ? 'show' : '' }} " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/dashboard/posts" class="{{ Request::is('dashboard/posts*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>My Posts</span>
                    </a>
                <li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('dashboard/categories') ? '' : 'collapsed' }}" data-bs-target="#categories" data-bs-toggle="collapse">
                <i class="bi bi-columns-gap"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="categories" class="nav-content collapse {{ Request::is('dashboard/categories*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/dashboard/categories" class="{{ Request::is('dashboard/categories*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

</aside><!-- End Sidebar-->
