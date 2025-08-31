@extends('layouts.admin.app')

@section('page-title')
  <i class="fas fa-gavel me-2"></i> Bidding Platform
@endsection

@section('content')
<style>
  .badge-pending { background-color: #fbbf24; }
  .badge-accepted { background-color: #10b981; }
  .badge-rejected { background-color: #ef4444; }
</style>

<div class="card p-4">
  <div class="d-flex justify-content-between mb-3">
    <div>
      <input type="text" class="form-control" placeholder="Search by user/item..." id="searchInput" />
    </div>
    <div>
      <select class="form-select" id="statusFilter">
        <option value="">All Status</option>
        <option value="Pending">Pending</option>
        <option value="Accepted">Accepted</option>
        <option value="Rejected">Rejected</option>
      </select>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Item</th>
          <th>Bid Amount</th>
          <th>Status</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="biddingTable">
        <tr>
          <td>1</td>
          <td>Ahmad Zaki</td>
          <td>iPhone 15 Pro Max</td>
          <td>RM5,500</td>
          <td><span class="badge badge-pending">Pending</span></td>
          <td>2025-07-08</td>
          <td>
            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Siti Khadijah</td>
          <td>Samsung S24 Ultra</td>
          <td>RM4,800</td>
          <td><span class="badge badge-accepted">Accepted</span></td>
          <td>2025-07-07</td>
          <td>
            <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
        <!-- More rows -->
      </tbody>
    </table>
  </div>
</div>

<script>
  const searchInput = document.getElementById('searchInput');
  const statusFilter = document.getElementById('statusFilter');
  const tableRows = document.querySelectorAll('#biddingTable tr');

  function filterTable() {
    const search = searchInput.value.toLowerCase();
    const status = statusFilter.value.toLowerCase();

    tableRows.forEach(row => {
      const user = row.cells[1].textContent.toLowerCase();
      const item = row.cells[2].textContent.toLowerCase();
      const currentStatus = row.cells[4].textContent.toLowerCase();

      const show =
        (user.includes(search) || item.includes(search)) &&
        (status === '' || currentStatus.includes(status));

      row.style.display = show ? '' : 'none';
    });
  }

  searchInput.addEventListener('input', filterTable);
  statusFilter.addEventListener('change', filterTable);
</script>
@endsection
