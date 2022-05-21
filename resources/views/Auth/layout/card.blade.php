<div class="card" style="width: 35rem">
    <div class="card-header text-white" style="background-color: #5567FF">
        User : Profile {{ Session::get('user-info')->username }}
    </div>
    <div class="card-body">
        @include('Auth.components.form')
    </div>
</div>



