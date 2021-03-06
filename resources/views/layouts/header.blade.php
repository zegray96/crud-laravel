<div class="header mb-4">
    <div style="display: flex; justify-content:space-between; align-items:center">
        <div>
            <a href="{{route('dashboard')}}" class="aItemMenu"><h2 class="text-white">Inicio</h2></a>
        </div>

        <div class="userData">
            <h4 class="text-white">Bienvenido! {{auth()->user()->name}}</h4>
            <h5 class="text-white">Tu rol es: {{auth()->user()->roles()->first()->name}}</h5>
            <form id="logoutForm" action="{{route('logout')}}" method="POST">
            @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" class="btn btn-danger btn-sm">{{ __('Logout') }}</a>
        </div>
    </div>
</div>