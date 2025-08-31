<div class="d-flex justify-content-center align-items-center" style="margin-top:50px">
    <form class="bg-light p-5 shadow rounded" action="server\auth.php" method="post"
        style="width: 100%; max-width: 450px;">
        <h3 class="mb-4 text-center text-success">User Registration</h3>

        <div class="mb-3">
            <label for="username" class="form-label text-success">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-success">Email address</label>
            <input type="email" class="form-control" name="useremail" id="email" placeholder="example@email.com">
        </div>

        <div class="mb-4">
            <label for="password" class="form-label text-success">Password</label>
            <input type="password" class="form-control" name="userpassword" id="password"
                placeholder="Enter your password">
        </div>

        <button type="submit" name="user_register_btn" class="btn btn-success w-100">Register</button>

        <p class="mt-3 mb-0 text-center">Already have an account? <a href="?login=true"
                class="text-decoration-none text-success">Login</a></p>
    </form>
</div>