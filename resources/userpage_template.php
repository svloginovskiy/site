<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="border rounded m-3 shadow p-3"  style="width: 40rem;">
            <img src="/images/avatars/default.webp" class="img-thumbnail d-inline" width="150px" alt="avatar"/>
            <h2 class="d-inline align-bottom"><?= $username; ?></h2>
        </div>
    </div>
    <?php
    include 'posts_list_template.php'; ?>
</div>
