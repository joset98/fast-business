<h2 class="nav-title-app">
    <a>Fast Business</a>
</h2>

<nav>
    <ul class="navigation-links">
        <li>
            <a href="{{route('list.products')}}">
                Productos
            </a>
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="#" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    Logout
                </a>
            </form>
        </li>
    </ul>
</nav>