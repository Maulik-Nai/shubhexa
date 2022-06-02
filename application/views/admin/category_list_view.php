<script>
$(document).ready(function(e) {
	$('#data-table').dataTable({
		"bProcessing": true,
		"iDisplayLength": 25,
		"responsive": true,
		"bDestroy": true
	});
});
</script>
<div class="contentpanel">
	<!-------------->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><?=$sub_title?>
			<span class="pull-right">
				<div class="btn-group pull-right">
					<a class="btn btn-success btn-small" href="<?=file_path('admin')?><?=$this->uri->rsegment(1)?>/addnew/add">Add New</a>
				</div>
				</span>
			</h4>
		</div>
		<div class="panel-body">
			<table class="table  table-bordered responsive" id="data-table">
				<thead>
					<tr>
						<th>Sr. No</th>
						<th>Category Name</th>
						<th>Access Name</th>
						<th>Image</th>
						<th>Banner Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?=$html?>
				</tbody>
			</table>
		</div>
		<!-- panel-body -->
	</div>
	<!-------------->
</div>
<!-- contentpanel -->
<style>
	.btn_custom {
		padding: 3px 15px !important;
	}
</style>

