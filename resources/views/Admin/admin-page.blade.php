@include('Admin.layout.header')

@include('Admin.components.navbar')

<div class="container mt-4">
    <div class="d-flex justify-content-end">
        @include('Admin.components.modal-add')
        @include('Admin.components.modal-edit')
    </div>
    @include('Admin.components.table-crud')
</div>

@include('Admin.layout.footer')

<script>
    $(document).ready(function() {

        function displayUser() {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ url('/displayUser') }}",
                success: function(response) {

                    let tbody = ``;
                    let countRow = 1;

                    response.forEach(data => {
                        tbody = `
                          <tr>
                            <td>${countRow}</td>
                            <td>${data.username}</td>
                            <td>${data.password}</td>
                            <td>${data.phone}</td>
                            <td>${data.email}</td>
                            <td><img src="{{ asset('uploads/user_upload/${data.user_img}') }}" class="rounded" width="50px" height="50px" alt="user-image"></td>
                            <td>${data.user_role}</td>
                            <td>${data.created_at.slice(0, 10)}</td>
                            <td>${data.updated_at.slice(0, 10)}</td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                  Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"> 
                                  <li><a class="dropdown-item" onclick="edit_users(${data.id})">Edit</a></li>
                                  <li><a class="dropdown-item" onclick="delete_users(${data.id})">Delete</a></li>
                                </ul>
                              </div>  
                            </td>
                          </tr>
                        `;

                        $('.display-user').append(tbody);
                        countRow++;
                    });
                }
            });
        }

        displayUser();

        $('#form-add-users').submit(function(e) {
            e.preventDefault();

            let form_addUsers = new FormData($(this)[0]);
            form_addUsers.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('/add-users') }}",
                data: form_addUsers,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 200) {
                      Swal.fire(
                          'สำเร็จ',
                          'เพิ่มข้อมูลผู้ใช้สำเร็จ!',
                          'success'
                      ).then(function(result) {
                          window.location.reload();
                      });

                    } else {
                        return false;
                    }
                }
            });
        });
    });

    function edit_users(id) {
        $.ajax({
          type: "GET",
          dataType: "json",
          url: `{{ url('edit-users/${id}') }}`,
          success: function(edit_users) {

            if (edit_users) {
              $('#modal-edit-users').modal('show');
              $('#user_id_update').val(edit_users.id);
              $('#username_update').val(edit_users.username);
              $('#password_update').val(edit_users.password);
              $('#phone_update').val(edit_users.phone);
              $('#email_update').val(edit_users.email);
              $('#user_img_update').attr('file', edit_users.user_img);
              
              edit_users.user_role == 'admin'
                ? $("#admin_role_update").prop("checked", true) 
                : $("#user_role_update").prop("checked", true);
            }
          }
        });
    }

    document.getElementById('form-update-users').onsubmit = function(e) {
        e.preventDefault();

        let form_updateUsers = new FormData($(this)[0]);
        form_updateUsers.append('_token', '{{ csrf_token() }}');
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ url('/update-users') }}",
            data: form_updateUsers,
            contentType: false,
            processData: false,
            success: function(response) {
              if (response.status == 200) {
                Swal.fire(
                  'สำเร็จ',
                  'เเก้ไขข้อมูลผู้ใช้สำเร็จ!',
                  'success'
                ).then(function(result) {
                  window.location.reload();
                });

              } else {
                return false;
              }
            }
        }); 
    }

    function delete_users(id) {
      Swal.fire({
        title: 'คำเตือน',
        text: `ต้องการลบ id : ${id} ผู้ใช้คนนี้หรือไม่!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({ 
            type: "GET",
            dataType: "json",
            url: `{{ url('/dalete-users/${id}') }}`,
            success: function (response) {
              if (response.status == 200) {
                Swal.fire(
                  'สำเร็จ',
                  'ลบข้อมูลผู้ใช้สำเร็จ!',
                  'success'
                ).then(function(result) {
                  window.location.reload();
                });

              } else {
                return false;
              }
            }
          });
        }
      });
    }

    function logout() {
      $.ajax({
        type: "GET",
        url: `{{ url('/admin-logout/${1}') }}`,
        success: function (response) {
          if (response.message == 'logout') {
            window.location.href = `{{ url('/') }}`;
          }
        }
      });
    }

</script>
