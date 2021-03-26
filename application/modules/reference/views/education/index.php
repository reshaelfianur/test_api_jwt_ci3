<?php if (!in_array(2, $rights)) : ?>
	<?= $this->load->view('forbidden-access') ?>
<?php else : ?>
	<div class="page-header">
		<div class="row page-titles">
			<div class="col-12 align-self-center">
				<h3 class="text-themecolor mb-0 mt-0"><?= $title ?></h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>"><i class="ti-home font-16"></i></a></li>
					<li class="breadcrumb-item"><a href="<?= base_url('reference') ?>">Reference</a></li>
					<li class="breadcrumb-item active"><?= $title ?></li>
				</ol>
			</div>
		</div>
	</div>
	<div class="page-content fade-in-up">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="d-inline-block">
							<div class="flexbox">
								<label class="mb-0 mr-2">Show</label>
								<select class="select-picker show-tick form-control" id="length-change" data-style="btn-solid" data-width="80px">
									<option value="5">5</option>
									<option value="10" selected="selected">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>
								<label class="mb-0 ml-2">entries</label>
							</div>
						</div>
						<div class="float-right">
							<div class="d-inline-block pr-2 pb-2">
								<div class="form-rounded">
									<input type="text" class="form-control form-control-rounded form-control-solid key-search" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
									<input type="hidden" class="form-control" name="rights" value='<?= json_encode($rights) ?>'>
								</div>
							</div>
							<div class="d-inline-block pb-2">
								<a class="btn btn-rounded btn-outline-custom btn-add <?= (in_array(1, $rights)) ? null : 'disabled' ?>" href="<?= base_url($route . 'create') ?>"><i class="mdi mdi-plus-circle"></i> Add <?= $title ?></a>
							</div>
						</div>
						<div class="table-responsive">
							<table id="education-list" class="table table-bordered table-hover dt-responsive w-100">
								<thead>
									<tr>
										<th class="no-sort">#</th>
										<th>Code</th>
										<th>Description</th>
										<?php if (in_array(3, $rights) || in_array(4, $rights)) : ?>
											<th class="no-sort text-center">Action</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Code</th>
										<th>Description</th>
										<?php if (in_array(3, $rights) || in_array(4, $rights)) : ?>
											<th class="text-center">Action</th>
										<?php endif ?>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>