<?php if (!isset($_SESSION['username'])) : redirect(base_url('errors/cli/error_404')); ?>

<?php else : ?>
    <?php if (empty($data)) : ?>

        <div class="container mt-3">
            <div class="card">

                <div class="card-body">
                    <?php echo form_open_multipart('PostController/store/' .  $_SESSION['username']) ?>
                    <div class="mb-4">
                        <textarea class="form-control" id="message-text" placeholder="Share your first post!" rows="4" name="caption"></textarea>
                        <div id="emailHelp" class="form-text">Limit description to 280 characters.</div>

                        <?php echo '<div class="text-danger">' . form_error('caption') . '</div>'; ?>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="formFile" name="image">
                        <?php echo '<div class="text-danger">' . form_error('image') . '</div>'; ?>

                        <?php if ($this->session->flashdata('error')) : ?>

                            <div class="text-danger">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2 btn-lg">Post</button>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                    </svg>

                    <div class="fs-3">No Posts Yet</div>

                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php if (!empty($data)) : ?>
        <div class="container mt-3 mb-5">
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

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">

                        <div class="card-body">
                            <?php echo form_open_multipart('PostController/store/' .  $_SESSION['username']) ?>
                            <div class="mb-4">
                                <textarea class="form-control" id="message-text" placeholder="Share us your day!" rows="15" name="caption"></textarea>
                                <div id="emailHelp" class="form-text">Limit description to 280 characters.</div>

                                <?php echo '<div class="text-danger">' . form_error('caption') . '</div>'; ?>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="file" id="formFile" name="image">
                                <?php echo '<div class="text-danger">' . form_error('image') . '</div>'; ?>

                                <?php if ($this->session->flashdata('error')) : ?>

                                    <div class="text-danger">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary me-md-2 btn-lg">Post</button>
                            </div>

                        </div>
                    </div>
                </div>

                <?php foreach ($data as $row) : ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo base_url() ?>uploads/<?php echo $row->post_img ?>" class="card-img-top" alt="...">
                            <div class="card-body">

                            </div>
                            <div class="card-footer" style="background-color:#0d6efd; color: white;">
                                <small class="text h5"><?php echo '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16"> <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/></svg>' . $row->u_firstname . ' ' . $row->u_lastname ?></small>
                            </div>

                            <div class="card-footer">
                                <p class="card-text fs-4"><?php echo $row->post_caption ?></p>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <small class="text-muted fs-6"><strong><?php echo '<span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-at " viewBox="0 0 16 16">
                                        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                                        </svg>' . $row->u_username ?></strong></span></small>
                                    </div>

                                    <div class="col">
                                        <small class="text-muted"><?php echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill me-1" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>' . $row->post_created_at ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>