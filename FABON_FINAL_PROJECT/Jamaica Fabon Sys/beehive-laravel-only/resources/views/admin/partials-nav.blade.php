<div class="admin-nav no-print">
    <a class="btn ghost" href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a class="btn ghost" href="{{ route('admin.menu') }}">Menu</a>
    <a class="btn ghost" href="{{ route('admin.tables') }}">Tables</a>
    <a class="btn ghost" href="{{ route('admin.settings') }}">Settings</a>
    <a class="btn honey" href="{{ route('staff.orders') }}">Staff Terminal</a>
    <form method="POST" action="{{ route('logout', 'admin') }}">@csrf<button class="btn red">Logout</button></form>
</div>
