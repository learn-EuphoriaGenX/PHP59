<div class="d-flex justify-content-center align-items-center" style="margin-top:50px">
    <form class="bg-light p-5 shadow rounded" action="server\common.php" method="post"
        style="width: 100%; max-width: 450px;" enctype="multipart/form-data">
        <h3 class="mb-4 text-center text-success fw-bold">📤 Upload New Notes</h3>

        <div class="mb-3">
            <label for="username" class="form-label text-success">Notes Title</label>
            <input type="text" class="form-control" name="title" id="username"
                placeholder="PHP Interview Questions.">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label text-success">Notes Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"
                placeholder="Here is your Notes Description"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile1" class="form-label text-success">Notes Thumbnail</label>
            <input class="form-control" type="file" id="formFile1" name="thumbnail"
                accept="image/png, image/jpeg, image/jpg">
            <small class="text-muted">Upload a cover image (jpg, jpeg, png)</small>
        </div>

        <div class="mb-3">
            <label for="formFile2" class="form-label text-success">Notes Zip</label>
            <input class="form-control" type="file" id="formFile2" name="zip_file" accept=".zip">
            <small class="text-muted">Upload your complete notes as ZIP</small>
        </div>
        <button type="submit" name="upload_btn" class="btn btn-success w-100 py-2 mt-4 fw-bold shadow">
            🚀 Publish Notes
        </button>
    </form>
</div>