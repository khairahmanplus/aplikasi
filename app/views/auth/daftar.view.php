<div class="container">
    <div class="row">
        <div class="col">
            <h1>Pendaftaran Pengguna</h1>

            <?php if (isset($errors_bag)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors_bag as $message): ?>
                            <li><?php echo $message; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="" method="post">

                <div class="form-group">
                    <label>Nama</label>
                    <input class="form-control <?php echo isset($errors_bag['nama']) ? 'is-invalid' : null; ?>" type="text" name="nama" value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : null ?>">
                    <?php if (isset($errors_bag['nama'])): ?>
                        <div class="invalid-feedback"><?php echo $errors_bag['nama']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Emel</label>
                    <input class="form-control <?php echo isset($errors_bag['emel']) ? 'is-invalid' : null; ?>" type="email" name="emel" value="<?php echo isset($_POST['emel']) ? $_POST['emel'] : null ?>">
                    <?php if (isset($errors_bag['emel'])): ?>
                        <div class="invalid-feedback"><?php echo $errors_bag['emel']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Kata Laluan</label>
                    <input class="form-control <?php echo isset($errors_bag['kata_laluan']) ? 'is-invalid' : null; ?>" type="password" name="kata_laluan">
                    <?php if (isset($errors_bag['kata_laluan'])): ?>
                        <div class="invalid-feedback"><?php echo $errors_bag['kata_laluan']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Pengesahan Kata Laluan</label>
                    <input class="form-control <?php echo isset($errors_bag['pengesahan_kata_laluan']) ? 'is-invalid' : null; ?>" type="password" name="pengesahan_kata_laluan">
                    <?php if (isset($errors_bag['pengesahan_kata_laluan'])): ?>
                        <div class="invalid-feedback"><?php echo $errors_bag['pengesahan_kata_laluan']; ?></div>
                    <?php endif; ?>
                </div>

                <button class="btn btn-primary" type="submit">Hantar</button>
            </form>
        </div>
    </div>
</div>