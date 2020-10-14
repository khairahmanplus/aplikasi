<div class="container">
    <div class="row">
        <div class="col">
            <h1>Log Masuk Pengguna</h1>
            <hr>

            <form action="" method="post">

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

                <button class="btn btn-primary" type="submit">Log Masuk</button>

            </form>
        </div>
    </div>
</div>