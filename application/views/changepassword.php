<?php if (!isset($_SESSION['username'])) : redirect(base_url('errors/cli/error_404')); ?>

<?php else : ?>
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header fs-2 fw-light bg-primary text-white">
            Change your Password
        </div>
        <div class="card-body">
            <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    <div style="margin-left: 0.5rem;">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                    <div style="margin-left: 0.5rem;">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php echo form_open('UserController/updatePassword/' . $_SESSION['username']);?>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput" placeholder="Current Password" name="oldpw">
                <label for="floatingInput">Current Password</label>
                <?php echo '<div class="text-danger">' . form_error('oldpw') . '</div>'; ?>

            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="New Password" name="newpw">
                <label for="floatingPassword">New Password</label>
                <?php echo '<div class="text-danger">' . form_error('newpw') . '</div>'; ?>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm new password" name="confpw">
                <label for="floatingPassword">Confirm new password</label>
                <?php echo '<div class="text-danger">' . form_error('confpw') . '</div>'; ?>
            </div>

            <div class="d-grid gap-2 d-md-block mb-3">
                <button class="btn btn-primary" type="submit">Save Changes</button>
                <a class="btn btn-outline-secondary" href="<?php echo base_url('UserController') ?>" role="button">Cancel</a>
            </div>

            </form>
        </div>
    </div>


</div>
<?php endif; ?>