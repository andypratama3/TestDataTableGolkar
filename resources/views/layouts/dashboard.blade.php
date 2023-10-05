
<!DOCTYPE html>
<html lang="en">
@include('layouts.dashboard_partial.head')
<body>

  <!-- ======= Header ======= -->
  @include('layouts.dashboard_partial.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('layouts.dashboard_partial.sidebar')
  <!-- End Sidebar-->
  <main id="main" class="main">
    @include('layouts.dashboard_partial.flashmessage')
    @yield('content')
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('layouts.dashboard_partial.footer')
</body>

</html>
