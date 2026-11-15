<?php require_once "partials/header.guest.php" ?>

<main class="container my-9">
  <div class="row justify-content-center">
    <div class="md:col-8 lg:col-5">
      <div class="card">
        <div class="card-body">
          <h1 class="mb-7">Masuk</h1>
          <form>
            <div class="form-field mb-5"><label class="form-label" for="username">Username</label><input
                class="form-control" type="text" id="username" name="username" required></div>
            <div class="form-field mb-5"><label class="form-label" for="password">Kata sandi</label><input
                class="form-control" type="password" id="password" name="password" required></div>
            <button type="submit" class="btn btn-solid theme-primary w-100">Masuk</button>
          </form>
          <p class="mt-7 mb-0">Belum punya akun? <a href="/signup">Daftar</a></p>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require_once "partials/footer.guest.php" ?>