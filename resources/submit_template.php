<div class="container">
    <div class="row justify-content-md-center">
        <div class="submit-form col-md-auto border rounded m-3 shadow">
            <form class="form-floating pt-3" action="/submit" method="POST">
                <div class="form-floating mb-1">
                    <input type="text" class="form-control border-0 fw-bold" id="postTitle"
                           placeholder="Title" name="title"
                           required>
                    <label class="text-muted fw-bold" for="postTitle">Enter title</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control border-0" placeholder="Leave a comment here" id="postText" style="height: 10rem; resize: none"></textarea>
                    <label class="text-muted fw-bold" for="postText">Enter text</label>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
        </div>
    </div>
</div>