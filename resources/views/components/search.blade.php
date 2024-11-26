<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
                <form action="{{ route('kosan.index') }}" method="GET" class="navbar-search form-inline" id="navbar-search-main">
                    <div class="input-group input-group-merge search-bar">
                        <span class="input-group-text" id="topbar-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </span>
                        <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search"
                               name="search" value="{{ request('search') }}" aria-label="Search" aria-describedby="topbar-addon">
                    </div>
                </form>
                

                <!-- Dropdown Button -->
                <div class="btn-group ms-2">
                    <button class="btn dropdown-toggle" type="button" id="dropdownSort" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #28a745; color: white;">
                        Sort
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                        <li><a class="dropdown-item" href="#" data-type="alpha">Name</a></li>
                        <li><a class="dropdown-item" href="#" data-type="numeric">Date</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
