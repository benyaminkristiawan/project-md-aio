<?= $this->extend('partials/main') ?>

<?= $this->section('title') ?>
Tambah User
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Tambah User</h3>
        </div>
        <div class="card-body">
            <!-- Form Start -->
            <form method="post" action="<?= base_url('/superadmin/user/saveUser') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Flash Error Messages -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= old('email') ?>" required>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama" value="<?= old('name') ?>" required>
                </div>



                <!-- Address -->
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" class="form-control" rows="3" placeholder="Alamat"><?= old('address') ?></textarea>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label for="phone">No. Telp</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="No. Telp" value="<?= old('phone') ?>">
                </div>

                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?= old('username') ?>" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password-confirm">Konfirmasi Password</label>
                    <input type="password" name="password-confirm" id="password-confirm" class="form-control" placeholder="Konfirmasi Password" required>
                </div>

                <!-- Role -->
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="spvsellin" <?= old('role') === 'spvsellin' ? 'selected' : '' ?>>Spv Sell In</option>
                        <option value="sellin" <?= old('role') === 'sellin' ? 'selected' : '' ?>>Sell in</option>
                        <option value="spvsellout" <?= old('role') === 'spvsellout' ? 'selected' : '' ?>>Spv Sell Out</option>
                        <option value="sellout" <?= old('role') === 'sellout' ? 'selected' : '' ?>>Sell out</option>

                    </select>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="<?= base_url('/superadmin/user') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!-- Form End -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>