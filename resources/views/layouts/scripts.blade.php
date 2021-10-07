{{-- App --}}
<script src="{{asset('js/app.js?version='.env('APP_VERSION'))}}"></script>
{{-- SweetAlert 2 --}}
<script src="{{asset('js/sweetalert2/sweetalert2.all.min.js')}}"></script>

@yield('more-scripts')