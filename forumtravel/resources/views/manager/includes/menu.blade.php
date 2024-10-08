<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
      @foreach($modules as $m)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <a href="{{ route($m['name'] . '.index') }}" class="nav-link">
            <span>{{ $m['name'] }}</span>
          </a>
        </h6>
      @endforeach
    </ul>
  </div>
</nav>
