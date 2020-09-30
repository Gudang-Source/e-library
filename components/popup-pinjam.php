<script>
    // nampilin popup pinjam
    $(document).on('click', 'a[data-role=pinjam]', function () {
        var id = $(this).data('id');
        var judul = $('#' + id).children('td[data-target=judul_buku]').text();
        
        // set judul buku
        $('#judulBuku').val(judul);
        $('#idBuku').val(id);
        $('#popup-pinjam').modal('toggle');
    });
</script>

<!-- Modal Tambah Data -->
<div class="modal fade" id="popup-pinjam" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Peminjaman Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- isi form -->
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Peminjaman</label>
                            <input type="date" value="<?= $today ?>" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="judul_buku" id="judulBuku" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Masukkan NPM</label>
                            <input type="text" name="npm" class="form-control" required>
                        </div>
                        <!-- id_buku -->
                        <input type="hidden" name="id_buku" id="idBuku" class="form-control">
                    </div>
                    <!-- footer form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="pinjam" class="btn btn-primary">Pinjam</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<!-- Modal Tambah Data -->