<?php if (!isset($_SESSION['username'])) : redirect(base_url('errors/cli/error_404')); ?>

<?php else : ?>
    <div class="container mt-3">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="container text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="#e2e3e5" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <div class="col mt-3">
                        <div class="d-grid gap-2 mx-auto">
                            <div class="h1"><?php echo $userdata['u_firstname'] . " " . $userdata['u_lastname'] ?></div>
                            <div class="h3"><span class="badge rounded-pill bg-primary">@<?php echo $_SESSION['username'] ?></span></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="card">
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

                        <?php echo form_open_multipart('PostController/savePost/' .  $_SESSION['username']) ?>
                        <div class="mb-4">
                            <textarea class="form-control" id="message-text" placeholder="Share your post!" rows="4" name="caption"></textarea>
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
        </div>
    </div>


    <div class="container mt-4 mb-5">

        <?php if ($this->session->flashdata('deletepost')) : ?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <div style="margin-left: 0.5rem;">
                    <?php echo $this->session->flashdata('deletepost'); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (empty($data)) : ?>
            <div class="card">
                <div class="card-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                    </svg>

                    <div class="fs-3">No Posts Yet</div>

                </div>
            </div>
        <?php endif; ?>



        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($data as $row) : ?>
                <div class="col">

                    <div class="card h-100">

                        <img src="<?php echo base_url() ?>uploads/<?php echo $row->post_img ?>" class="card-img-top" alt="...">
                        <div class="card-body"></div>

                        <div class="card-footer">

                            <div class="dropdown float-end dropup">
                                <button class="btn btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                    </svg>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-success" href="<?php echo base_url('PostController/profile/') . $row->u_username . "/" .  $row->post_id; ?>" data-bs-toggle="modal" data-bs-target="#id<?php echo $row->post_id ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-1" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>View</a></li>
                                    <li><a class="dropdown-item text-danger" href="<?php echo base_url('PostController/deletePost/') . $row->u_username . "/" .  $row->post_id; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash me-1" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade " id="id<?php echo $row->post_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               

                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                        <img src="<?php echo base_url() ?>uploads/<?php echo $row->post_img ?>" class="card-img-top" alt="...">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                            <div class="fs-1 fw-light"><span class="badge rounded-pill bg-primary">@<?php echo $row->u_username ?></span></div>
                                                <p class="card-text fs-1 fw-lighter"><?php echo $row->post_caption ?></p>
                                                <p class="card-text"><small class="text-muted"><?php echo $row->post_created_at ?></small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>


    </div>

<?php endif; ?>