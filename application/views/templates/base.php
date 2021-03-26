<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>HRIS | <?= $title ?></title>

	<link href="<?= base_url('assets/images/favicon.png') ?>" rel="icon" type="image/png" sizes="16x16">
	<link href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/plugins/alertify/css/alertify.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/plugins/toastr-master/css/toastr.min.css') ?>" rel="stylesheet">

	<?php if (!empty($css)) :
		foreach ($css as $file) :
			echo "<link href='" . base_url($file) . '.css' . "' rel='stylesheet' />";
		endforeach;
	endif ?>

	<link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/colors/' . (!empty($userTheme) ? $userTheme : 'green-dark') . '.css') ?>" id="theme" data-current-theme="<?= (!empty($userTheme) ? $userTheme : 'green-dark') ?>" rel="stylesheet">

	<?php if (file_exists(FCPATH . 'assets/css/' . $this->router->fetch_class() . '.css')) :
		echo "<link href='" . base_url('assets/css/' . $this->router->fetch_class() . '.css') . "' rel='stylesheet' />";
	endif ?>

</head>

<body class="fix-header fix-sidebar card-no-border" data-title="<?= $title ?>" data-route="<?= $route ?>" data-controller="<?= $this->router->fetch_class() ?>" data-method="<?= $this->router->fetch_method() ?>" data-flash-type="<?= !empty($this->session->flashdata('data')['type']) ? $this->session->flashdata('data')['type'] : null ?>" data-flash-message="<?= !empty($this->session->flashdata('data')['message']) ? $this->session->flashdata('data')['message'] : null ?>">

	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
	</div>

	<div id="main-wrapper">
		<header class="topbar">
			<nav class="navbar top-navbar navbar-expand-md navbar-light">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.html">
						<b>
							<img src="<?= base_url('assets/images/logo-icon.png') ?>" alt="homepage" class="dark-logo" />
							<img src="<?= base_url('assets/images/logo-light-icon.png') ?>" alt="homepage" class="light-logo" />
						</b>
						<span>
							<img src="<?= base_url('assets/images/logo-text.png') ?>" alt="homepage" class="dark-logo" />
							<img src="<?= base_url('assets/images/logo-light-text.png') ?>" class="light-logo" alt="homepage" />
						</span>
					</a>
				</div>

				<div class="navbar-collapse">
					<ul class="navbar-nav mr-auto mt-md-0 ">
						<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:;"><i class="ti-menu"></i></a> </li>
						<li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:;"><i class="icon-arrow-left-circle"></i></a> </li>
					</ul>

					<ul class="navbar-nav my-lg-0">

						<li class="nav-item dropdown">
							<a class="nav-link text-muted text-muted waves-effect waves-dark" id="timeout" data-toggle="modal" data-target="#session-dialog" href="javascript:;"> <i class="mdi mdi-alarm"></i>
								<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
							</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
								<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
							</a>
							<div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
								<ul>
									<li>
										<div class="drop-title">Notifications</div>
									</li>
									<li>
										<div class="message-center">
											<a href="#">
												<div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
												<div class="mail-contnet">
													<h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
												</div>
											</a>
										</div>
									</li>
									<li>
										<a class="nav-link text-center" href="javascript:;"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
								<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
							</a>
							<div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
								<ul>
									<li>
										<div class="drop-title">You have 1 new messages</div>
									</li>
									<li>
										<div class="message-center">
											<a href="#">
												<div class="user-img"> <img src="<?= base_url('assets/images/users/1.jpg') ?>" alt="user" class="img-circle"> <span class="profile-status online float-right"></span> </div>
												<div class="mail-contnet">
													<h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span>
												</div>
											</a>
										</div>
									</li>
									<li>
										<a class="nav-link text-center" href="javascript:;"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url('assets/images/users/1.jpg') ?>" alt="user" class="profile-pic" /></a>
							<div class="dropdown-menu dropdown-menu-right animated flipInY">
								<ul class="dropdown-user">
									<li>
										<div class="dw-user-box">
											<div class="u-img"><img src="<?= base_url('assets/images/users/1.jpg') ?>" alt="user"></div>
											<div class="u-text">
												<h4>Steave Jobs</h4>
												<p class="text-muted">varun@gmail.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li role="separator" class="divider"></li>
									<li><a href="#"><i class="ti-user"></i> My Profile</a></li>
									<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
									<li><a href="#"><i class="ti-email"></i> Inbox</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
									<li role="separator" class="divider"></li>
									<li><a class="logout-route" href="<?= base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<aside class="left-sidebar">
			<div class="scroll-sidebar">
				<nav class="sidebar-nav">
					<ul id="sidebarnav">
						<li id="dashboardNav">
							<a href="<?= base_url('dashboard') ?>" aria-expanded="false"><i class="mdi mdi-home-outline"></i><span class="hide-menu"> Dashboard </span></a>
						</li>
						<li class="nav-small-cap">Modules</li>

						<?php foreach ($modules as $module) : ?>

							<li id="<?= $module->module_code ?>">
								<a class="has-arrow " href="<?= ($module->module_route != '#') ? base_url($module->module_route) : "#" ?>" aria-expanded="false"><i class="<?= $module->module_icon ?>"></i><span class="hide-menu"> <?= $module->module_desc ?></span></a>
								<?= subModules($module->module_code) ?>
							</li>

						<?php endforeach ?>

						<li class="nav-small-cap">FORMS, TABLE &amp; WIDGETS</li>
						<li>
							<a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Sample Pages</span></a>
							<ul aria-expanded="false" class="collapse">
								<li><a href="#" class="has-arrow">Authentication <span class="label label-rounded label-success">6</span></a>
									<ul aria-expanded="false" class="collapse">
										<li><a href="pages-login.html">Login 1</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>

			<div class="sidebar-footer">
				<a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
				<a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
				<a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
			</div>
		</aside>

		<div class="page-wrapper">

			<div class="modal fade" id="session-dialog">
				<div class="modal-dialog" style="width:400px;" role="document">
					<div class="modal-content timeout-modal">
						<div class="modal-body">
							<button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div class="text-center mt-3 mb-4"><i class="ti-lock timeout-icon"></i></div>
							<div class="text-center text-custom h4 mb-3">Set Auto Logout</div>
							<p class="text-center mb-4">You are about to be signed out due to inactivity.<br>Select after how many minutes of inactivity you log out of the system.</p>
							<div id="timeout-reset-box" style="display:none;">
								<div class="form-group text-center">
									<button class="btn btn-danger btn-fix btn-air" id="timeout-reset">Deactivate</button>
								</div>
							</div>
							<div id="timeout-activate-box">
								<form id="timeout-form" class="form-control-line" action="javascript:;">
									<div class="form-group pl-3 pr-3 mb-4">
										<input class="form-control form-control-line" type="text" name="timeout_count" placeholder="Minutes" id="timeout-count">
									</div>
									<div class="form-group col-6 offset-3">
										<button class="btn btn-outline-custom btn-block" id="timeout-activate">Activate</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="global-modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-action">OK</button>
							<button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="global-child-modal" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-action">OK</button>
							<button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid p-3">
				<?= $this->load->view($pageContent); ?>
			</div>

			<button class="right-side-toggle waves-effect waves-light btn-success btn-circle btn-sm float-right ml-2 btn-service-panel"><i class="ti-settings text-white"></i></button>

			<div class="right-sidebar">
				<div class="slimscrollright">
					<div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
					<div class="r-panel-body">
						<ul id="themecolors" class="mt-3">
							<li><b>With Light sidebar</b></li>
							<li><a href="javascript:;" data-theme="default" class="default-theme">1</a></li>
							<li><a href="javascript:;" data-theme="green" class="green-theme">2</a></li>
							<li><a href="javascript:;" data-theme="red" class="red-theme">3</a></li>
							<li><a href="javascript:;" data-theme="blue" class="blue-theme">4</a></li>
							<li><a href="javascript:;" data-theme="purple" class="purple-theme">5</a></li>
							<li><a href="javascript:;" data-theme="megna" class="megna-theme">6</a></li>
							<li class="d-block mt-4"><b>With Dark sidebar</b></li>
							<li><a href="javascript:;" data-theme="default-dark" class="default-dark-theme">7</a></li>
							<li><a href="javascript:;" data-theme="green-dark" class="green-dark-theme">8</a></li>
							<li><a href="javascript:;" data-theme="red-dark" class="red-dark-theme">9</a></li>
							<li><a href="javascript:;" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
							<li><a href="javascript:;" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
							<li><a href="javascript:;" data-theme="megna-dark" class="megna-dark-theme">12</a></li>
						</ul>
						<ul class="mt-3 chatonline">
							<li><b>Chat option</b></li>
							<li>
								<a href="javascript:;"><img src="<?= base_url('assets/images/users/1.jpg') ?>" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<footer class="footer">
				© 2019 - <?= date('Y') ?> PT RESLIN INDONESIA. All Rights Reserved.
				<div class="to-top"><i class="fa fa-angle-double-up"></i></div>
			</footer>

		</div>

	</div>

	<script>
		baseUrl = (path = "") => {
			let url = '<?= base_url() ?>';
			return url + path;
		}
	</script>

	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/bootstrap/js/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-validate/jquery.validate.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-idletimer/jquery.idletimer.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/waves/waves.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/alertify/js/alertify.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/toastr-master/js/toastr.min.js') ?>"></script>

	<?php if (!empty($js)) :
		foreach ($js as $file) :
			echo "<script src='" . base_url($file) . '.js' . "' type='text/javascript'></script>";
		endforeach;
	endif; ?>

	<script src="<?= base_url('assets/js/sidebarmenu.js') ?>"></script>
	<script src="<?= base_url('assets/js/custom.js') ?>"></script>
	<script src="<?= base_url('assets/js/func.js') ?>"></script>
	<script src="<?= base_url('assets/js/main.js') ?>"></script>
	<script src="<?= base_url('assets/js/' . $this->router->fetch_class() . '.js') ?>"></script>
	<script src="<?= base_url('assets/js/exec.js') ?>"></script>

</body>

</html>