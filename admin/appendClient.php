<div id="appending-client-section" >
    <h1 class="title">Pending Client</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Home</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Clients Management</a></li>
    </ul>
    
    <div class="data">
        <div class="content-data">
            <div class="head">
                <h3>Pending Client</h3>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Added Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>admin_master</td>
                        <td>admin@ecommerce2025.com</td>
                        <td>May 10, 2025</td>
                    </tr>
                    <tr>
                        <td>marketing_admin</td>
                        <td>marketing@ecommerce2025.com</td>
                        <td>May 5, 2025</td>
                    </tr>
                    <tr>
                        <td>product_manager</td>
                        <td>products@ecommerce2025.com</td>
                        <td>Apr 28, 2025</td>
                    </tr>
                    <tr>
                        <td>support_team1</td>
                        <td>support1@ecommerce2025.com</td>
                        <td>May 2, 2025</td>
                    </tr>
                    <tr>
                        <td>order_processor</td>
                        <td>orders@ecommerce2025.com</td>
                        <td>Apr 15, 2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- This is the dashboard section (your existing content) -->
<div id="dashboard-section">
    <!-- Your existing dashboard content is here -->
</div>

<style>
/* Simple styles for the admin table */
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
