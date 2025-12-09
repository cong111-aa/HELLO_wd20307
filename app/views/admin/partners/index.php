<h2>Quản lý đối tác</h2>

<a href="index.php?controller=partner&action=create" class="btn btn-primary mb-3">
    + Thêm đối tác
</a>

<!-- KHÁCH SẠN -->
<h4 class="mt-4 text-primary">🏨 Khách sạn</h4>
<?php include_once 'table_partner.php';
showPartners($hotels); ?>

<!-- NHÀ XE -->
<h4 class="mt-4 text-success">🚌 Nhà xe</h4>
<?php include_once 'table_partner.php';
showPartners($transports); ?>