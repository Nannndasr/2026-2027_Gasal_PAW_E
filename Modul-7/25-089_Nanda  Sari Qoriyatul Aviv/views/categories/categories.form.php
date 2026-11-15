<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <h1 class="mb-7">Tambah kategori</h1>
  <div class="row">
    <div class="md:col-8 lg:col-6">
      <form action="/api/categories/add" method="POST">
        <div class="form-field mb-5"><label class="form-label" for="category_name">Nama kategori</label><input
            class="form-control" type="text" id="category_name" name="category_name" required></div>
        <div class="form-field mb-5"><label class="form-label" for="description">Deskripsi</label><textarea
            class="form-control" id="description" name="description" rows="3"></textarea></div>
        <button type="submit" class="btn btn-solid theme-primary">Simpan</button> <a class="btn btn-text"
          href="/categories">Batal</a>
      </form>
    </div>
  </div>
</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>