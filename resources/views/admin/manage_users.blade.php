@extends('layouts.admin.app')

@section('page-title', 'MANAGE USERS')

@section('content')
<style>
    /* CSS sedia ada */
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

    .badge-locked {
        background-color: #dc3545;
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
    
    .btn-delete {
        background-color: transparent;
        color: #dc3545;
        border: 1px solid #dc3545;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 13px;
        transition: 0.3s;
        margin-left: 5px;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-view i, .btn-delete i {
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

    .col-bil { width: 5%; }
    .col-nama { width: 20%; }
    .col-email { width: 25%; }
    .col-peranan { width: 10%; }
    .col-status { width: 10%; }
    .col-tindakan { width: 30%; }

    /* Gaya untuk modal pengesahan */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    .modal-content {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 400px;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-4">Senarai Pengguna Ebidding</h5>

            <div class="tab-wrapper">
                <button id="btnUser" class="btn tab-button active">User</button>
                <button id="btnAdmin" class="btn tab-button">Admin</button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle" id="userTable">
                    <thead>
                        <tr>
                            <th class="col-bil">Bil</th>
                            <th class="col-nama">Nama</th>
                            <th class="col-email">Email</th>
                            <th class="col-peranan">Peranan</th>
                            <th class="col-status">Status</th>
                            <th class="col-tindakan">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr id="user-row-{{ $user->id }}">
                                <td class="col-bil">{{ $index + 1 }}</td>
                                <td class="col-nama">
                                    {{ $user->name ?? ($user->first_name . ' ' . $user->last_name) }}<br>
                                    <span class="user-code">
                                        Kod: {{ $user->user_code ?? 'US' . str_pad($user->id, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="col-email">{{ $user->email }}</td>
                                <td class="col-peranan">{{ ucfirst($user->role ?? 'user') }}</td>
                                <td class="col-status">
                                    @php
                                        // Tentukan waktu terakhir login. Jika null, gunakan waktu pembuatan akun.
                                        $last_login_time = \Carbon\Carbon::parse($user->last_login_at ?? $user->created_at);
                                        // Hitung jumlah hari sejak terakhir login
                                        $days_since_last_login = $last_login_time->diffInDays(\Carbon\Carbon::now());
                                    @endphp
                                    @if($days_since_last_login <= 30)
                                        <span class="badge badge-active">Active</span>
                                    @else
                                        <span class="badge badge-inactive">Non-Active</span>
                                    @endif
                                </td>
                                <td class="col-tindakan">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-view">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <button type="button" class="btn btn-delete" onclick="showDeleteModal('user', '{{ $user->id }}', '{{ route('admin.users.delete', $user->id) }}')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="table table-bordered text-center align-middle d-none" id="adminTable">
                    <thead>
                        <tr>
                            <th class="col-bil">Bil</th>
                            <th class="col-nama">Nama</th>
                            <th class="col-email">Email</th>
                            <th class="col-peranan">Peranan</th>
                            <th class="col-status">Status</th>
                            <th class="col-tindakan">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $index => $admin)
                            <tr id="admin-row-{{ $admin->id }}">
                                <td class="col-bil">{{ $index + 1 }}</td>
                                <td class="col-nama">
                                    {{ $admin->first_name }} {{ $admin->last_name }}<br>
                                    <span class="user-code">Kod: {{ $admin->username ?? 'AD' . str_pad($admin->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="col-email">{{ $admin->email }}</td>
                                <td class="col-peranan">{{ ucfirst($admin->role) }}</td>
                                <td class="col-status">
                                    @php
                                        // Tentukan waktu terakhir login. Jika null, gunakan waktu pembuatan akun.
                                        $last_login_time = \Carbon\Carbon::parse($admin->last_login_at ?? $admin->created_at);
                                        // Hitung jumlah hari sejak terakhir login
                                        $days_since_last_login = $last_login_time->diffInDays(\Carbon\Carbon::now());
                                    @endphp
                                    @if($days_since_last_login <= 30)
                                        <span class="badge badge-active">Active</span>
                                    @else
                                        <span class="badge badge-inactive">Non-Active</span>
                                    @endif
                                </td>
                                <td class="col-tindakan">
                                    <a href="{{ route('admin.admins.show', $admin->id) }}" class="btn btn-view">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <button type="button" class="btn btn-delete" onclick="showDeleteModal('admin', '{{ $admin->id }}', '{{ route('admin.admins.delete', $admin->id) }}')">
                                        <i class="fas fa-trash-alt"></i> Delete
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

<div id="deleteModal" class="modal-overlay d-none">
    <div class="modal-content">
        <h5 class="mb-4">Adakah anda pasti?</h5>
        <p>Anda tidak boleh mengundurkan tindakan ini.</p>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-secondary me-2" onclick="hideDeleteModal()">Batal</button>
            <button id="confirmDeleteBtn" class="btn btn-danger">Padam</button>
        </div>
    </div>
</div>

<script>
    // Pembolehubah global untuk menyimpan butiran item yang hendak dipadam
    let itemToDelete = {
        type: null,
        id: null,
        url: null
    };

    const btnUser = document.getElementById('btnUser');
    const btnAdmin = document.getElementById('btnAdmin');
    const userTable = document.getElementById('userTable');
    const adminTable = document.getElementById('adminTable');
    const deleteModal = document.getElementById('deleteModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

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

    // Menunjukkan modal pengesahan
    function showDeleteModal(type, id, url) {
        itemToDelete.type = type;
        itemToDelete.id = id;
        itemToDelete.url = url;
        deleteModal.classList.remove('d-none');
    }

    // Menutup modal pengesahan
    function hideDeleteModal() {
        deleteModal.classList.add('d-none');
        // Reset itemToDelete
        itemToDelete.type = null;
        itemToDelete.id = null;
        itemToDelete.url = null;
    }

    // Menangani tindakan padam apabila butang "Padam" dalam modal ditekan
    confirmDeleteBtn.addEventListener('click', () => {
        if (!itemToDelete.id || !itemToDelete.url) {
            console.error('Tiada item untuk dipadam.');
            return;
        }

        fetch(itemToDelete.url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Berjaya, padam baris dari DOM
                const rowId = `${itemToDelete.type}-row-${itemToDelete.id}`;
                document.getElementById(rowId)?.remove();
                
                // Menutup modal
                hideDeleteModal();
                
                // Memaparkan mesej kejayaan (boleh diganti dengan toast notification)
                alert(data.success);
                
                // Menombor semula baris
                renumberRows(itemToDelete.type === 'user' ? 'userTable' : 'adminTable');
            } else {
                // Gagal, paparkan mesej ralat
                alert(data.error || 'Gagal memadam item.');
            }
        })
        .catch(error => {
            console.error('Ralat:', error);
            alert('Terjadi ralat ketika memadam item.');
        });
    });
    
    // Fungsi untuk menombor semula baris
    function renumberRows(tableId) {
        const table = document.getElementById(tableId);
        if (!table) return;

        const rows = table.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            const firstCell = row.querySelector('td.col-bil');
            if (firstCell) {
                firstCell.textContent = index + 1;
            }
        });
    }
</script>
@endsection