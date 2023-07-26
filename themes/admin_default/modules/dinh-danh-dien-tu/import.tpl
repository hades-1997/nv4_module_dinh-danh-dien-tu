<!-- BEGIN: main -->
<!-- BEGIN: thongbao -->
<div class="alert alert-danger">
	{thongbao}
</div>
<!-- END: thongbao -->
<form class="form-inline" method="post" enctype="multipart/form-data" action="{FORM_ACTION}">
	<input name="save" type="hidden" value="1" />
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<tbody>
				<tr>
					<td class="text-left">Chọn file uploads:</td>
					<td><input name="file" id="IequestionFile" required="required" type="file"></td>
				</tr>
				<tr>
					<td class="text-center" colspan="2">
						<a href="{link_file}" class="tab4 bsubmit btn btn-warning" onclick="alert('Để tránh lỗi không đồng bộ với hệ thống Xin lưu ý:\nSau khi tải file mẫu về, chỉ được thêm nội dung theo mẫu không tự sửa theo ý cá nhân.')">
						<span class="fa fa-download"></span>Tải file Excel mẫu</a>
						
						<input type="submit" name="import" class="btn btn-primary btn-sm" value="Uploads File">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>
<!-- END: main -->