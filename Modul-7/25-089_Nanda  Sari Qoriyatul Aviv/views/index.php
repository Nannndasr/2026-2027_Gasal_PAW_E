<?php require_once "partials/header.guest.php" ?>

<main class="container my-9">
  <section class="text-center my-12">
    <h1 class="fs-5xl">Perpustakaan digital</h1>
    <p class="fs-lg mb-9">Cari buku, lihat ketersediaan stok, dan kelola peminjaman dalam satu tempat.</p>
    <a class="btn btn-solid theme-primary" href="/signup">Daftar gratis</a> <a class="btn btn-outline theme-primary"
      href="/login">Masuk</a>
  </section>
  <section class="row text-center">
    <div class="md:col-4 mb-7">
      <h2 class="fs-xl">
        <a href="/books">Katalog buku</a>
      </h2>
      <p>Temukan buku berdasarkan judul, penulis, atau kategori.</p>
    </div>
    <div class="md:col-4 mb-7">
      <h2 class="fs-xl">
        <a href="/loans">Peminjaman</a>
      </h2>
      <p>Pantau buku yang dipinjam dan batas tanggal pengembalian.</p>
    </div>
    <div class="md:col-4 mb-7">
      <h2 class="fs-xl">Pengelolaan data</h2>
      <p>Pustakawan mengatur buku, kategori, dan anggota.</p>
    </div>
  </section>
</main>

<?php require_once "partials/footer.guest.php" ?>