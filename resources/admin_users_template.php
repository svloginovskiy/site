<div onload="initElement();" hidden></div>
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-1 border-end border-2 px-0" style="height:100%">
            <div class="rounded border d-flex justify-content-center align-items-center" style="height: 5rem">
                Users
            </div>
        </div>
        <div class="col-11 px-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row"><?= $user['id']; ?></th>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['role']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary deleteButton" id="<?= $user['id']; ?>">
                                <i class="bi bi-trash-fill" title="Delete"></i>
                            </button>
                            <button type="button" class="btn btn-primary editButton" data-bs-toggle="modal"
                                    data-bs-target="#editModal" id="<?= $user['id']; ?>">
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
