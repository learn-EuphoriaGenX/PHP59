<div class="d-flex justify-content-center align-items-center" style="margin-top:90px">
    <form class="bg-light p-5 shadow rounded" action="" method="post" style="width: 100%; max-width: 450px;">
        <h3 class="mb-4 text-center text-primary">Admin Login</h3>

        <div class="mb-3">
            <label for="email" class="form-label text-primary">Email address</label>
            <input type="email" class="form-control" name="useremail" id="email" placeholder="example@email.com">
        </div>


        <div class="mb-4">
            <label for="password" class="form-label text-primary">Password</label>
            <input type="password" class="form-control" name="userpassword" id="password"
                placeholder="Enter your password">
        </div>

        <button type="submit" name="login_btn" class="btn btn-primary w-100">Login</button>

        <p class="mt-3 mb-0 text-center">Login as a User? <a href="?login=true"
                class="text-decoration-none text-primary">Login</a></p>
    </form>
</div>