<?= $this->include('admin_lte/header') ?>
<?= $this->include('admin_lte/navbar') ?>
<?= $this->include('admin_lte/sidebar') ?>
<?= $this->include('admin_lte/custom_style') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header pt-0 pb-0">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
				</div><!-- /.col -->
				<div class="col-sm-6">
					<?= view_cell('\App\Libraries\Admin::breadcrumb') ?>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content pl-0 pr-0">
		<div class="container-fluid">
			<?= $this->include('admin_lte/cmps/alerts') ?>

			<?= $this->renderSection('content') ?>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->include('admin_lte/footer') ?>