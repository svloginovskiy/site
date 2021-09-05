<div class="container">
    <div class="row justify-content-md-center">
        <div class="submit-form col-md-auto border rounded m-3 shadow">
            <form class="form-floating pt-3" action="/submit" method="POST" enctype="multipart/form-data">
                <div class="form-floating mb-1">
                    <input type="text" class="form-control border-0 fw-bold" id="postTitle"
                           placeholder="Title" name="title"
                           required>
                    <label class="text-muted fw-bold" for="postTitle">Enter title</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control border-0" placeholder="Leave a comment here" id="postText"
                              style="height: 10rem; resize: none" name="text"></textarea>
                    <label class="text-muted fw-bold" for="postText">Enter text</label>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    <div class="ms-auto position-relative me-1">
                        <label for="fileInput" title="Upload an image">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-image" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                            </svg>
                        </label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                        <input class="form-control invisible" type="file" accept="image/*" style="position: absolute; top: 0;"
                               id="fileInput" name="image">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>