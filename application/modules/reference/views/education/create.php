<div class="container create-form">
    <div class="row">
        <div class="col-md-12">
            <form action="<?= base_url($route . 'store') ?>" method="post" id="education-form" class="form-horizontal">
                <div class="form-group mb-4 row">
                    <label for="education_code" class="col-sm-3 col-form-label text-md-right">Code*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="education_code" id="education_code" autocomplete="off">
                    </div>
                </div>
                <div class="form-group mb-4 row">
                    <label for="education_desc" class="col-sm-3 col-form-label text-md-right">Description*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="education_desc" id="education_desc" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>