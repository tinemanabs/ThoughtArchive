<div class="container">
    <div class="row">
        <div class="col-7">
            <div class="col d-flex justify-content-center">
                <img src="<?php echo base_url('assets/img/register-page.png') ?>" alt="" srcset="" style="width: 50vw; height:100vh">
            </div>
        </div>
        <div class="col mb-3 align-self-center">
            <div class="brand-name text-center h4" style="font-family: 'Paprika', cursive;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z" />
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                </svg>
                <strong>thought archive</strong>
            </div>
            <div class="fw-bold text-center h2 text-primary">Create Account</div>

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

            <?php echo form_open('RegisterController/store') ?>
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="Jane" name="fname">
                <?php echo '<div class="text-danger">' . form_error('fname') . '</div>'; ?>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Last Name</label>
                <input type="text" class="form-control" placeholder="Doe" name="lname">
                <?php echo '<div class="text-danger">' . form_error('lname') . '</div>'; ?>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="e.g. Schwifty" name="uname">
                <?php echo '<div class="text-danger">' . form_error('uname') . '</div>'; ?>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="example@email.com" name="email">
                <?php echo '<div class="text-danger">' . form_error('email') . '</div>'; ?>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Must have atleast 6 characters" name="pwd">
                <?php echo '<div class="text-danger">' . form_error('pwd') . '</div>'; ?>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Please confirm your password" name="cpwd">
                <?php echo '<div class="text-danger">' . form_error('cpwd') . '</div>'; ?>
            </div>

            <div class="col d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>

            </form>

            <div class="col d-flex justify-content-center mt-2">
                <div class="fw-bold text-center text-secondary">Already have an account? &nbsp;<a href="<?php echo base_url() ?>LoginController" class="link-primary">Login</a></div>
            </div>

        </div>
    </div>
</div>