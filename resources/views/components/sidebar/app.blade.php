<aside class="col-lg-2 mx-0 bg-white min-vh-100">
    <nav class="sidebar card border-0 py-2 mb-4">
        <ul class="nav flex-column" id="nav_accordion">
            <li class="nav-item rounded {{ $currentPath === 'dashboard' ? 'bg-gray' : '' }}">
                <a class="nav-link item {{ $currentPath === 'dashboard' ? 'text-body' : 'text-secondary' }} d-flex justify-content-between align-items-center"
                    href="/dashboard">
                    <div>
                        <i class="fas fa-home text-center" style="width: 30px"></i>
                        <span>
                            Dashboard
                        </span>
                    </div>
                </a>
            </li>
            <li class="nav-item rounded {{ $currentPath === 'barang' ? 'bg-gray' : '' }}">
                <a class="nav-link item text-secondary d-flex justify-content-between align-items-center {{ $currentPath === 'barang' ? 'text-body' : 'text-secondary' }}"
                    href="/barang">
                    <div>
                        <i class="fas fa-file-alt text-center" style="width: 30px"></i>
                        <span>
                            Data Barang
                        </span>
                    </div>
                </a>
            </li>
            <li class="nav-item rounded">
                <a class="nav-link item text-secondary d-flex justify-content-between align-items-center"
                    href="/barang/laporan">
                    <div>
                        <i class="fas fa-download text-center" style="width: 30px"></i>
                        <span>
                            Laporan
                        </span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</aside>
