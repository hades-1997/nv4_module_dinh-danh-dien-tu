<!-- BEGIN: main -->
<section class="table-dulieu">
    <div class="container" style="border-top: 1px solid #ccc;padding-top: 20px;">
            <h2 class="text-center">Kết quả kích hoạt tài khoản định danh điện tử</h2>
            <p class="text-center">(Số liệu tính đến ngày {KETQUA_NGAY})</p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Đơn vị</th>
                            <th>Mức 1 theo nơi thường trú</th>
                            <th>Mức 2 theo đơn vị thu nhận</th>
                            <th>Tổng số</th>
                            <th>Tổng Chỉ tiêu thực hiện (đến 31/12/2023)</th>
                            <th>Đạt tỷ lệ %</th>
                            <th>Số công dân chưa được kích hoạt</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- BEGIN: loop -->
                        <tr>
                            <td>{CONTENT.weight}</td>
                            <td>{CONTENT.donvi}</td>
                            <td>{CONTENT.dulieu_1}</td>
                            <td>{CONTENT.dulieu_2}</td>
                            <td>{CONTENT.dulieu_3}</td>
                            <td>{CONTENT.dulieu_4}</td>
                            <td>{CONTENT.dulieu_5} %</td>
                            <td>{CONTENT.dulieu_6}</td>
                        </tr>
                    <!-- END: loop -->
                    </tbody>
                </table>
            </div>
    </div>
</section>
<!-- END: main -->