<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="col-md-auto border rounded m-3 shadow">
            <form class="" action="/u/<?=$username; ?>/settings/edit" method="POST">
                <h1 class="fw-bold">Settings</h1>
                <div class="mb-3 row">
                    <label for="inputUsername" class="col-3">Username</label>
                    <div class="col-9">
                        <input type="text"  class="form-control" id="inputUsername" name="username" value="<?=$username; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputEmail" class="col-3">Email</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="inputEmail" name="email" value="<?=$email; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-3">Password</label>
                    <div class="col-9">
                        <input type="password" class="form-control" name="password" id="inputPassword">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDescription" class="col-3">Description</label>
                    <div class="col-9">
                        <textarea class="form-control" id="inputDescription" name="description" rows="3"><?= $description; ?></textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload your avatar image</label>
                    <input class="form-control" type="file" id="formFile" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save settings</button>
                </div>
            </form>
        </div>
    </div>
</div>