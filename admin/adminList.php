<?php 
require_once 'admin.php';
printAllAdmins();
?>

<style>
.admin-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: var(--light);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 4px 4px 16px rgba(0, 0, 0, 0.05);
}

.admin-table thead {
    background: var(--blue);
    color: var(--light);
}

.admin-table th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
}

.admin-table tbody tr {
    border-bottom: 1px solid var(--grey);
}

.admin-table tbody tr:hover {
    background: rgba(22, 153, 176, 0.05);
}

.admin-table td {
    padding: 12px 15px;
    font-size: 14px;
}

.admin-table .status {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.admin-table .status.active {
    background: var(--light-green);
    color: var(--green);
}

.admin-table .status.pending {
    background: #FFF4DE;
    color: #FFA800;
}
</style>
