<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_address_type'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/address-type') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-book"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Address Type</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_bank'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/bank') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-money"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Bank</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_certificate_type'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/certificate-type') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-layout-cta-btn-right"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Certificate Type</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_corporate_rank'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/corporate-rank') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="fas fa-sort-alpha-up"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Corporate Rank</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_education'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/education') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-medall"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Education</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_employment_status'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/employment-status') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-pin2"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Employment Status</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_employment_type'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/employment-type') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-briefcase"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Employment Type</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_family_type'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/family-type') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="fas fa-child"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Family Type</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_gender'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/gender') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="fas fa-mars"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Gender</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_grade'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/grade') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-tag"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Grade</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_job_title'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/job-title') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="icon icon-briefcase"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Job Title</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_letter_type'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/letter-type') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-layout-cta-left"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Letter Type</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_marital_status'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/marital-status') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="fas fa-venus-mars"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Marital Status</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_origin'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/origination') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-id-badge"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Origination</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_religion'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/religion') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="ti-star"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Religion</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_tax_status'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/tax-status') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="far fa-newspaper"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Tax Status</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <span class="<?= (in_array(2, $rights['reference_team'])) ? null : 'disabled' ?>">
                <a class="link" href="<?= base_url('reference/team') ?>">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex flex-row">
                                <h2 class="round align-self-center round-success"><i class="icon icon-people"></i></h2>
                                <div class="ml-2 align-self-center">
                                    <h6>Team</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </span>
        </div>
    </div>
</div>