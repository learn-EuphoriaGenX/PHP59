<div class="d-flex justify-content-center align-items-center" style="margin-top:50px">
    <form class="bg-light p-5 shadow rounded" action="server\auth.php" method="post"
        style="width: 100%; max-width: 450px;">
        <h3 class="mb-4 text-center text-primary">Admin Registration</h3>

        <div class="mb-3">
            <label for="username" class="form-label text-primary">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
        </div>

        <div class="mb-4">
            <label for="password" class="form-label text-primary">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
        </div>

        <button type="submit" name="admin_register_btn" class="btn btn-primary w-100">Register</button>

        <p class="mt-3 mb-0 text-center">Already have an account? <a href="?adminLogin=true"
                class="text-decoration-none text-primary">Login</a></p>
    </form>
</div>