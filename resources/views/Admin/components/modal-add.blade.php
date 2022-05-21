<button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modal-add-user">
    add users
</button>

<div class="modal fade" id="modal-add-user" tabindex="-1" aria-labelledby="modal-add-userLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-white" style="background-color: #5567FF">
          <h5 class="modal-title" id="modal-add-userLabel">Modal Add</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
            <form id="form-add-users" method="post">
              @csrf
              <div class="row">
                  <div class="col-md-6 mt-2">
                      <label for="txt-uername" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="username" required>
                  </div>
                  <div class="col-md-6 mt-2">
                      <label for="txt-uername" class="form-label">Password</label>
                      <input type="text" class="form-control" id="password" name="password" aria-describedby="password" placeholder="password" required>
                  </div>
                  <div class="col-md-6 mt-2">
                      <label for="txt-Phone" class="form-label">Phone</label>
                      <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="phone" required>
                  </div>
                  <div class="col-md-6 mt-2">
                      <label for="txt-Email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email" required>
                  </div>
                  <div class="col-md-6 mt-2">
                      <label for="txt-image" class="form-label">image</label>
                      <input class="form-control" type="file" id="user_img" name="user_img" required>
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
              <button type="submit" class="btn btn-primary mt-4" style="width: 100%">save</button>
          </form>
        </div>
        <div class="modal-footer">
  
        </div>
      </div>
    </div>
</div>