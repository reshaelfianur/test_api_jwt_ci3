<div class="container edit-form">
    <div class="row">
        <div class="col-md-12">
            <form action="<?= base_url($route . 'save') ?>" method="post" id="education-form" class="form-horizontal">
                <input type="hidden" name="education_id" value="<?= $row->education_id ?>">
                <div class="form-group row mb-4">
                    <label for="education_code" class="col-sm-3 col-form-label text-md-right">Code*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="education_code" id="education_code" value="<?= $row->education_code ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="education_desc" class="col-sm-3 col-form-label text-md-right">Description*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="education_desc" id="education_desc" value="<?= $row->education_desc ?>" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>