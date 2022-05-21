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
                    <a class="nav-link text-white" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br><br>

<div class="container mt-4" style="width: 40rem;">
    <div class="card d-flex justify-content-center">
        <div class="card-header text-white" style="background-color: #5567FF">
            Register
        </div>
        <div class="card-body">
            <form id="form-register" action="{{ url('/register') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label for="txt-uername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="username">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="txt-uername" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" aria-describedby="password" placeholder="password">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="txt-Phone" class="form-label">Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="phone">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="txt-Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="txt-image" class="form-label">image</label>
                        <input class="form-control" type="file" id="user_img" name="user_img">
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
                </div>
                <button type="submit" class="btn btn-primary mt-4" style="width: 100%">Register</button>
            </form>
        </div>
    </div>
</div>

@include('layout.footer')

<script>
    $(document).ready(function() {
        $('#form-register').submit(function(e) {
            e.preventDefault();

            let form_data = new FormData($(this)[0]);
            form_data.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: $(this).attr('action'),
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 200) {
                        window.location.href = `{{ url('/') }}`;
                    }
                }
            });
        });
    });
</script>
