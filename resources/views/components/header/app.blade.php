    <header class="section-header py-3 border-bottom px-3 bg-white">
        <div class="container-fluid px-5 d-flex justify-content-between align-items-center">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo" style="width: 135px">
            </a>
            <ul class="p-0 m-0">
                <li class="nav-item dropdown no-arrow list-style-none">
                    <a class="d-flex align-items-center border-0 bg-transparent text-secondary text-decoration-none"
                        type="submit dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-2x"></i>
                        <p class="m-0 px-2 text-capitalize">{{ auth()->user()->name }}</p>
                        <i class="fas fa-chevron-down fa-xs mt-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm animated--grow-in border-0"
                        aria-labelledby="userDropdown">
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </header>
