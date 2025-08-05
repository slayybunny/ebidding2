@extends('layouts.admin.app')

@section('page-title', 'MANAGE USERS')

@section('content')
<style>
  .badge-active {
    background-color: #16a34a;
    color: #fff;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 13px;
  }

  .badge-inactive {
    background-color: #9ca3af;
    color: #fff;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 13px;
  }

  .btn-view {
    background-color: transparent;
    color: #2563eb;
    border: 1px solid #2563eb;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 13px;
    transition: 0.3s;
  }

  .btn-view:hover {
    background-color: #2563eb;
    color: #fff;
  }

  .btn-view i {
    margin-right: 4px;
  }

  .table thead {
    background-color: #f3f4f6;
    font-size: 14px;
  }

  .table td, .table th {
    vertical-align: middle;
    padding: 10px 8px;
    font-size: 13px;
  }

  .user-code {
    font-size: 12px;
    color: #6b7280;
  }

  .card-body h5 {
    font-size: 18px;
    font-weight: 600;
    color: #1f2937;
  }

  .tab-button {
    margin-right: 10px;
    font-size: 14px;
    padding: 6px 16px;
  }

  .tab-button.active {
    background-color: #b8860b;
    color: white;
  }

  .tab-wrapper {
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 5px;
    margin-bottom: 20px;
  }
</style>

<div class="container mt-4">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h5 class="mb-4">Senarai Pengguna Ebidding</h5>

      <!-- Tab buttons with line -->
      <div class="tab-wrapper">
        <button id="btnUser" class="btn tab-button active">User</button>
        <button id="btnAdmin" class="btn tab-button">Admin</button>
      </div>

      <div class="table-responsive">
        <!-- USER TABLE -->
        <table class="table table-bordered text-center align-middle" id="userTable">
          <thead>
            <tr>
              <th>Bil</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Peranan</th>
              <th>Status</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @php
              $users = [
                ['name' => 'Lin Hui', 'email' => 'lin.hui@gmail.com', 'role' => 'tenders', 'status' => 'Inactive', 'code' => 'TD002'],
                ['name' => 'Siti Rahmah', 'email' => 'siti.rahmah@gmail.com', 'role' => 'user', 'status' => 'Active', 'code' => 'US003'],
                ['name' => 'Aiman Fikri', 'email' => 'aiman.fikri@gmail.com', 'role' => 'user', 'status' => 'Inactive', 'code' => 'US004'],
                ['name' => 'Nur Hidayah', 'email' => 'hidayah.nur@gmail.com', 'role' => 'tenders', 'status' => 'Active', 'code' => 'TD005'],
                ['name' => 'Tan Wei', 'email' => 'tan.wei@yahoo.com', 'role' => 'user', 'status' => 'Active', 'code' => 'US006'],
              ];
            @endphp

            @foreach($users as $index => $user)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                  {{ $user['name'] }}<br>
                  <span class="user-code">Kod: {{ $user['code'] }}</span>
                </td>
                <td>{{ $user['email'] }}</td>
                <td>{{ ucfirst($user['role']) }}</td>
                <td>
                  <span class="badge {{ $user['status'] === 'Active' ? 'badge-active' : 'badge-inactive' }}">
                    {{ $user['status'] === 'Active' ? 'Active' : 'Non-Active' }}
                  </span>
                </td>
                <td>
                  <button class="btn btn-view">
                    <i class="fas fa-eye"></i> Lihat
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <!-- ADMIN TABLE -->
        <table class="table table-bordered text-center align-middle d-none" id="adminTable">
          <thead>
            <tr>
              <th>Bil</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Peranan</th>
              <th>Status</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @php
              $admins = [
                ['name' => 'Puteri', 'email' => 'puteri@gmail.com', 'role' => 'super admin', 'status' => 'Active', 'code' => 'AD001'],
                ['name' => 'Ahmad Zulkifli', 'email' => 'zulkifli.admin@gmail.com', 'role' => 'admin', 'status' => 'Active', 'code' => 'AD002'],
                ['name' => 'Lim Kok Leong', 'email' => 'lim.leong@ebidding.com', 'role' => 'admin', 'status' => 'Inactive', 'code' => 'AD003'],
              ];
            @endphp

            @foreach($admins as $index => $admin)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                  {{ $admin['name'] }}<br>
                  <span class="user-code">Kod: {{ $admin['code'] }}</span>
                </td>
                <td>{{ $admin['email'] }}</td>
                <td>{{ ucfirst($admin['role']) }}</td>
                <td>
                  <span class="badge {{ $admin['status'] === 'Active' ? 'badge-active' : 'badge-inactive' }}">
                    {{ $admin['status'] === 'Active' ? 'Active' : 'Non-Active' }}
                  </span>
                </td>
                <td>
                  <button class="btn btn-view">
                    <i class="fas fa-eye"></i> Lihat
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  const btnUser = document.getElementById('btnUser');
  const btnAdmin = document.getElementById('btnAdmin');
  const userTable = document.getElementById('userTable');
  const adminTable = document.getElementById('adminTable');

  btnUser.addEventListener('click', () => {
    btnUser.classList.add('active');
    btnAdmin.classList.remove('active');
    userTable.classList.remove('d-none');
    adminTable.classList.add('d-none');
  });

  btnAdmin.addEventListener('click', () => {
    btnAdmin.classList.add('active');
    btnUser.classList.remove('active');
    adminTable.classList.remove('d-none');
    userTable.classList.add('d-none');
  });
</script>
@endsection
