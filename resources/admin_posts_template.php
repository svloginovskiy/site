<div onload="initElement();" hidden></div>
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-1 border-end border-2 px-0" style="height:100%">
            <div class="rounded border d-flex justify-content-center align-items-center" style="height: 5rem">
                <a href="/admin/users">Users</a>
            </div>
            <div class="rounded border d-flex justify-content-center align-items-center" style="height: 5rem">
                <a href="/admin/posts">Posts</a>
            </div>
        </div>
        <div class="col-11 px-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Link</th>
                    <th scope="col">Created by</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($posts as $post) : ?>
                    <tr>
                        <th scope="row"><?= $post['title']; ?></th>
                        <td><a href="/posts/<?= $post['id']; ?>">link</a></td>
                        <td><?= $post['user']; ?></td>
                        <td><?= $post['category']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary deleteButton" id="<?= $post['id']; ?>">
                                <i class="bi bi-trash-fill" title="Delete"></i>
                            </button>
                            <button type="button" class="btn btn-primary editButton" data-bs-toggle="modal"
                                    data-bs-target="#editModal" id="<?= $post['id']; ?>">
                                <i class="bi bi-pencil-fill" title="Edit"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Choose role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <select class="form-select" form="roleFrom" required>
                    <option value="admin">Admin</option>
                    <option value="writer">Writer</option>
                </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveButton">Save</button>
            </div>
        </div>
    </div>
</div>

