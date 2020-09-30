<script>
    // nampilin popup pinjam
    $(document).on('click', 'a[data-role=kembalikan]', function () {
        var id = $(this).data('id');
        var judul = $('#' + id).children('td[data-target=judul_buku]').text();
        var tanggal = $('#' + id).children('td[data-target=tanggal]').text();
        var idBuku = $('#' + id).children('td[data-target=id_buku]').text();
        
        // set judul buku
        $('#judulBuku').val(judul);
        $('#tanggal').val(tanggal);
        $('#idPinjam').val(id);
        $('#idBuku').val(idBuku);
        $('#popup-kembalikan').modal('toggle');
    });
</script>

<!-- Modal Kembalikan -->
<div class="modal fade" id="popup-kembalikan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pengembalian Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- isi form -->
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Peminjaman</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="judul_buku" id="judulBuku" class="form-control" readonly>
                        </div>
                        <!-- id_pinjam -->
                        <input type="hidden" name="id_pinjam" id="idPinjam" class="form-control">
                        <input type="hidden" name="id_buku" id="idBuku" class="form-control">
                    </div>
                    <!-- footer form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="kembalikan" class="btn btn-primary">Kembalikan</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<!-- Modal kembalikan -->