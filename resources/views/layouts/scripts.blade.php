{{-- App --}}
<script src="{{asset('js/app.js?version='.env('APP_VERSION'))}}"></script>
{{-- SweetAlert 2 --}}
<script src="{{asset('js/sweetalert2/sweetalert2.all.min.js')}}"></script>
{{-- Bootstrap Selectpicker --}}
<script src="{{asset('js/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select/defaults-es_ES.js')}}"></script>

@yield('more-scripts')

