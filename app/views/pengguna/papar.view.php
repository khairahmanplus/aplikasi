<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="font-weight-bold">Butiran Pengguna</h1>
            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between">
                            <strong>Nama</strong>
                            <?php echo $pengguna->nama ?? '-'; ?>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <strong>Emel</strong>
                            <?php echo $pengguna->emel ?? '-'; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>