@include('layout.header')

<nav class="navbar navbar-expand-lg" style="background-color: #5567FF">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand text-white" href="#">CRUD</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/user-page') }}">User</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br><br><br><br>
<div class="container mt-4" style="width: 35rem;">
    <div class="card d-flex justify-content-center">
        <div class="card-header text-white" style="background-color: #5567FF">
            Login 
        </div>
        <div class="card-body">
            <form id="form-login" method="post">
                <div class="mb-3">
                    <label for="txt-uername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="txt-password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="mb-2 mt-4">
                    position : &nbsp;
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="user_role" value="admin" required>
                        <label class="form-check-label" for="admin">admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="user_role" value="user">
                        <label class="form-check-label" for="user">user</label>
                    </div>
                </div>
                <div class="mb-3">
                    <a href="{{ url('/register') }}" class="link-primary">Register</a>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%">Login</button>
            </form>
        </div>
    </div>
</div>

@include('layout.footer')

<script>
    $(document).ready(function() {

        $('#form-login').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('/login') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: $('#username').val(),
                    password: $('#password').val(),
                    user_role: $("input[name='user_role']:checked").val()
                },
                success: function(response) {
                    if (response.user_role == 'user') {
                        window.location.href = `{{ url('/user-page') }}`;
                    }

                    if (response.user_role == 'admin') {
                        window.location.href = `{{ url('/admin-page') }}`;
                    }
                }
            });
        });
        
    });
</script>
