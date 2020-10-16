<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="font-weight-bold">Senarai Pengguna</h1>
            <hr>

            <a class="btn btn-primary mb-4" href="<?php echo url('/pengguna/baru'); ?>">Tambah Pengguna Baru</a>

            <?php $halaman_terkini = $_GET['halaman'] ?? 1; ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Bil.</th>
                        <th>Nama</th>
                        <th>Emel</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($senarai_pengguna) > 0): ?>
                        <?php foreach ($senarai_pengguna as $indeks => $pengguna): ?>
                            <tr>
                                <td class="align-middle">
                                    <?php echo (($halaman_terkini - 1) * PAGINATION_LIMIT) + $indeks + 1; ?>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark font-weight-bold font-italic" href="<?php echo url('/pengguna/papar', ['id' => $pengguna->id]); ?>">
                                        <?php echo $pengguna->nama ?? '-'; ?>
                                    </a>
                                </td>
                                <td class="align-middle"><?php echo $pengguna->emel ?? '-'; ?></td>
                                <td class="float-right">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                            Tindakan
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo url('/pengguna/papar', ['id' => $pengguna->id]); ?>">Papar</a>
                                            <a class="dropdown-item" href="<?php echo url('/pengguna/kemaskini', ['id' => $pengguna->id]); ?>">Kemaskini</a>
                                            <a class="dropdown-item" href="<?php echo url('/pengguna/buang', ['id' => $pengguna->id]); ?>" data-toggle="modal" data-target="#pengesahan-tindakan">Buang</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <ul class="pagination justify-content-end">
                <?php foreach (range(1, $jumlah_halaman) as $halaman): ?>
                    <li class="page-item <?php echo $halaman_terkini == $halaman ? 'active' : null; ?>">
                        <a href="<?php echo url('/pengguna', ['halaman' => $halaman]); ?>" class="page-link">
                            <?php echo $halaman; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
</div>




<div class="modal fade" id="pengesahan-tindakan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengesahan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <strong class="text-danger">Adakah anda pasti untuk buang rekod yang dipilih?</strong>
                <form id="borang-buang-rekod" action="" method="post"></form>
            </div>
            <div class="modal-footer">
                <button form="borang-buang-rekod" type="submit" class="btn btn-outline-danger">Ya, teruskan buang!</button>
            </div>
        </div>
    </div>
</div>