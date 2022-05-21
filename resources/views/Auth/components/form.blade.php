<form id="form-update-profile">
    @csrf
    <div class="text-center">
        <img class="mt-4 mb-4" id="image" src="" width="150" height="150">
        <div class="row">
            <div class="input-group mb-3">
                <input type="hidden" id="id" name="id">
                <input type="text" class="form-control" id="username" name="username" placeholder="username">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="password" name="password" placeholder="password">
            </div>
            <div class="input-group mb-3">
                <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone">
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="email">
            </div>
            <div class="input-group mb-3">
                <input class="form-control" type="file" id="user_img" name="user_img">
            </div>
            <div class="input-group mb-3">
                position : &nbsp;
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="user_role" value="user" checked>
                    <label class="form-check-label" for="user">user</label>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" style="width: 100%">Edit profile</button>
</form>
