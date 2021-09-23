<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="border rounded m-3 shadow p-3"  style="width: 40rem;">
            <img src="<?= empty($avatar) ? '/images/avatars/default.webp' : $avatar; ?>" class="img-thumbnail d-inline" width="150px" alt="avatar"/>
            <h2 class="d-inline align-bottom"><?= $username; ?></h2>
            <p><?=$description; ?></p>
        </div>
    </div>
    <?php
    include 'posts_list_template.php'; ?>
</div>
