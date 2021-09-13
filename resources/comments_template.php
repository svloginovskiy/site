<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="submit-form col-md-auto border rounded m-3 shadow " style="width: 40rem;">
            <?php if ($isLoggedIn) : ?>
            <form class="form-floating pt-3" action="/posts/<?= $post_id;?>/comment" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <textarea
                            class="form-control border-0"
                            placeholder="Leave a comment"
                            id="postText"
                            style="height: 10rem; resize: none" name="comment"></textarea>
                    <div class="invalid-feedback">
                        Text should contain less than 65000 symbols!
                    </div>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </div>
            </form>

        </div>
        <?php endif; ?>
        <?php foreach ($comments as $comment): ?>
        <div class="border col-md-auto rounded m-3 shadow" style="width: 40rem;">
            <h1><?= $comment['name']; ?></h1>
            <p><?= $comment['text']; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>


