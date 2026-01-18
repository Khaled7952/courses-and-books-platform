<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    @include('layouts.website.head')

</head>

<body >
    {!! $codeSnippet->body_code ?? '' !!}

		<!-- Loader Start -->
	  <div id="loader">
    <i class="fas fa-spinner fa-spin"></i>
  </div>
		<!-- Loader End -->

		<!-- Header Start -->
        @include('layouts.website.header')
		<!-- Header End -->
        @yield('content')

		<!-- Footer Start -->
        <!-- WhatsApp Button -->


		@include('layouts.website.footer')
		<!-- Footer End -->


    @include('layouts.website.scripts')


</body>
</html>



