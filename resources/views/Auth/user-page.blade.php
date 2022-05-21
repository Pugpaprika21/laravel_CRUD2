@include('Auth.layout.header')

@include('Auth.components.navbar')

<div class="container d-flex justify-content-center mt-4">
    @include('Auth.layout.card')
</div>

@include('Auth.layout.footer')

<script>
    $(document).ready(function () {
        
        (function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ url('/profile-page') }}",
                success: function (response) {
                    response.forEach(users => {
                        $('#id').val(users.id);
                        $('#username').val(users.username);
                        $('#password').val(users.password);
                        $('#phone').val(users.phone);
                        $('#email').val(users.email);
                        $('#image').attr('src', `{{ asset('uploads/user_upload/${users.user_img}') }}`);
                    });
                }
            });
        })();

        $('#form-update-profile').submit(function (e) { 
            e.preventDefault();    

            let update_profile = new FormData($(this)[0]);
            update_profile.append('_token', '{{ csrf_token() }}');
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('/update-profile') }}",
                data: update_profile,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);

                    if (response.status == 200) {
                        window.location.reload();
                    }
                }
            });
        });
    });

    function logout() {
      $.ajax({
        type: "GET",
        url: `{{ url('/user-logout/${2}') }}`,
        success: function (response) {
          if (response.message == 'logout') {
            window.location.href = `{{ url('/') }}`;
          }
        }
      });
    } 


</script>
