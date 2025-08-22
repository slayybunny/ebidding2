@extends('layouts.admin.app')

@section('page-title', 'MANAGE USERS')

@section('content')
    <style>
        /* Definisi warna kustom */
        :root {
            --custom-brown-dark: #A57C4F;
            --custom-brown: #B78D5B;
            --custom-brown-light: #CFB79A;
            --custom-brown-subtle: rgba(183, 141, 91, 0.15);
            --gradient-start: #D8A561;
            --gradient-end: #A57C4F;
        }

        /* Existing CSS */
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
            color: var(--custom-brown);
            border: 1px solid var(--custom-brown);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
            transition: 0.3s;
        }

        .btn-view:hover {
            background-color: var(--custom-brown);
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

        .btn-view i,
        .btn-delete i {
            margin-right: 4px;
        }

        .table thead {
            background-color: #f3f4f6;
            font-size: 14px;
        }

        .table td,
        .table th {
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

        /* Button Print dan Download */
        .btn-custom-brown {
            color: white;
            background-image: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(183, 141, 91, 0.3);
            transition: all 0.3s ease;
        }

        .btn-custom-brown:hover {
            box-shadow: 0 6px 20px rgba(183, 141, 91, 0.5);
            transform: translateY(-2px);
            background-position: right center;
        }

        .btn-outline-custom-brown {
            color: var(--custom-brown-dark);
            border-color: var(--custom-brown-dark);
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-custom-brown:hover {
            background-color: var(--custom-brown);
            color: white;
            border-color: var(--custom-brown);
        }

        .tab-button {
            margin-right: 10px;
            font-size: 14px;
            padding: 6px 16px;
        }

        .tab-button.active {
            color: white;
            font-weight: bold;
            border: none;
            background-image: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            box-shadow: 0 4px 15px rgba(183, 141, 91, 0.3);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .tab-wrapper {
            display: flex; /* Mengubah tab-wrapper menjadi flex container */
            justify-content: space-between; /* Menempatkan elemen di ujung-ujung */
            align-items: center; /* Menyusun elemen di tengah secara vertikal */
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }
        
        .tab-buttons {
            display: flex;
            gap: 10px;
        }

        .col-bil {
            width: 5%;
        }

        .col-nama {
            width: 20%;
        }

        .col-email {
            width: 25%;
        }

        .col-peranan {
            width: 10%;
        }

        .col-status {
            width: 10%;
        }

        .col-tindakan {
            width: 30%;
        }

        /* Style for confirmation modal */
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
            <div class="card-header bg-white border-bottom-0">
                <h5 class="mb-0 fw-semibold text-dark">E-Bidding User List</h5>
            </div>
            <div class="card-body">
                <div class="tab-wrapper">
                    <div class="tab-buttons">
                        <button id="btnUser" class="btn tab-button active">User</button>
                        <button id="btnAdmin" class="btn tab-button">Admin</button>
                    </div>
                    
                    {{-- Tombol Print dan Download dipindahkan ke sini --}}
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-custom-brown" onclick="printReport()">
                            <i class="fas fa-print me-1"></i> Print
                        </button>
                        <button class="btn btn-sm btn-custom-brown" onclick="downloadReport()">
                            <i class="fas fa-download me-1"></i> Download
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" id="userTable">
                        <thead>
                            <tr>
                                <th class="col-bil">No.</th>
                                <th class="col-nama">Name</th>
                                <th class="col-email">Email</th>
                                <th class="col-peranan">Role</th>
                                <th class="col-status">Status</th>
                                <th class="col-tindakan">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr id="user-row-{{ $user->id }}">
                                    <td class="col-bil">{{ $index + 1 }}</td>
                                    <td class="col-nama">
                                        {{ $user->name ?? $user->first_name . ' ' . $user->last_name }}<br>
                                        <span class="user-code">
                                            Code: {{ $user->user_code ?? 'US' . str_pad($user->id, 3, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="col-email">{{ $user->email }}</td>
                                    <td class="col-peranan">{{ ucfirst($user->role ?? 'user') }}</td>
                                    <td class="col-status">
                                        @php
                                            $last_login_time = \Carbon\Carbon::parse(
                                                $user->last_login_at ?? $user->created_at,
                                            );
                                            $days_since_last_login = $last_login_time->diffInDays(
                                                \Carbon\Carbon::now(),
                                            );
                                        @endphp
                                        @if ($days_since_last_login <= 30)
                                            <span class="badge badge-active">Active</span>
                                        @else
                                            <span class="badge badge-inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="col-tindakan">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-view">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-delete"
                                            onclick="showDeleteModal('user', '{{ $user->id }}', '{{ route('admin.users.delete', $user->id) }}')">
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
                                <th class="col-bil">No.</th>
                                <th class="col-nama">Name</th>
                                <th class="col-email">Email</th>
                                <th class="col-peranan">Role</th>
                                <th class="col-status">Status</th>
                                <th class="col-tindakan">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $index => $admin)
                                <tr id="admin-row-{{ $admin->id }}">
                                    <td class="col-bil">{{ $index + 1 }}</td>
                                    <td class="col-nama">
                                        {{ $admin->first_name }} {{ $admin->last_name }}<br>
                                        <span class="user-code">Code:
                                            {{ $admin->username ?? 'AD' . str_pad($admin->id, 3, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="col-email">{{ $admin->email }}</td>
                                    <td class="col-peranan">{{ ucfirst($admin->role) }}</td>
                                    <td class="col-status">
                                        @php
                                            $last_login_time = \Carbon\Carbon::parse(
                                                $admin->last_login_at ?? $admin->created_at,
                                            );
                                            $days_since_last_login = $last_login_time->diffInDays(
                                                \Carbon\Carbon::now(),
                                            );
                                        @endphp
                                        @if ($days_since_last_login <= 30)
                                            <span class="badge badge-active">Active</span>
                                        @else
                                            <span class="badge badge-inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="col-tindakan">
                                        <a href="{{ route('admin.admins.show', $admin->id) }}" class="btn btn-view">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <button type="button" class="btn btn-delete"
                                            onclick="showDeleteModal('admin', '{{ $admin->id }}', '{{ route('admin.admins.delete', $admin->id) }}')">
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
            <h5 class="mb-4">Are you sure?</h5>
            <p>You cannot undo this action.</p>
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-secondary me-2" onclick="hideDeleteModal()">Cancel</button>
                <button id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        // Global variable to store details of the item to delete
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

        let currentTableId = 'userTable';

        btnUser.addEventListener('click', () => {
            btnUser.classList.add('active');
            btnAdmin.classList.remove('active');
            userTable.classList.remove('d-none');
            adminTable.classList.add('d-none');
            currentTableId = 'userTable';
        });

        btnAdmin.addEventListener('click', () => {
            btnAdmin.classList.add('active');
            btnUser.classList.remove('active');
            adminTable.classList.remove('d-none');
            userTable.classList.add('d-none');
            currentTableId = 'adminTable';
        });

        // Show confirmation modal
        function showDeleteModal(type, id, url) {
            itemToDelete.type = type;
            itemToDelete.id = id;
            itemToDelete.url = url;
            deleteModal.classList.remove('d-none');
        }

        // Close confirmation modal
        function hideDeleteModal() {
            deleteModal.classList.add('d-none');
            itemToDelete.type = null;
            itemToDelete.id = null;
            itemToDelete.url = null;
        }

        // Handle delete action when "Delete" button in modal is clicked
        confirmDeleteBtn.addEventListener('click', () => {
            if (!itemToDelete.id || !itemToDelete.url) {
                console.error('No item to delete.');
                return;
            }

            fetch(itemToDelete.url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const rowId = `${itemToDelete.type}-row-${itemToDelete.id}`;
                        document.getElementById(rowId)?.remove();
                        hideDeleteModal();
                        alert(data.success);
                        renumberRows(currentTableId);
                    } else {
                        alert(data.error || 'Failed to delete item.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the item.');
                });
        });

        // Function to renumber rows
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
        
        // Fungsi untuk mencetak laporan (print)
        function printReport() {
            const currentTable = document.getElementById(currentTableId).cloneNode(true);
            const tableTitle = currentTableId === 'userTable' ? 'User List' : 'Admin List';

            // Menghapus kolom "Action" dari tabel sebelum dicetak
            const headerRow = currentTable.querySelector('thead tr');
            const headers = headerRow.querySelectorAll('th');
            let actionColumnIndex = -1;
            headers.forEach((header, index) => {
                if (header.textContent.trim() === 'Action') {
                    actionColumnIndex = index;
                }
            });
            if (actionColumnIndex !== -1) {
                headers[actionColumnIndex].remove();
                currentTable.querySelectorAll('tbody tr').forEach(row => {
                    row.querySelectorAll('td')[actionColumnIndex].remove();
                });
            }

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>${tableTitle} Report</title>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        h1 { text-align: center; color: #333; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    <h1>${tableTitle} Report</h1>
                    ${currentTable.outerHTML}
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        // Fungsi untuk mengunduh laporan (download)
        function downloadReport() {
            const currentTable = document.getElementById(currentTableId);
            const tableName = currentTableId === 'userTable' ? 'User_List' : 'Admin_List';
            const filename = tableName + '_' + new Date().toLocaleDateString('en-CA') + '.xlsx';

            // Clone the table to manipulate without affecting the original display
            const clonedTable = currentTable.cloneNode(true);

            // Remove 'Action' column from the cloned table
            const headerRow = clonedTable.querySelector('thead tr');
            let actionColumnIndex = -1;
            headerRow.querySelectorAll('th').forEach((th, index) => {
                if (th.textContent.trim() === 'Action') {
                    actionColumnIndex = index;
                }
            });
            if (actionColumnIndex !== -1) {
                clonedTable.querySelectorAll('th')[actionColumnIndex].remove();
                clonedTable.querySelectorAll('tr').forEach(row => {
                    if (row.children[actionColumnIndex]) {
                        row.children[actionColumnIndex].remove();
                    }
                });
            }

            const wb = XLSX.utils.table_to_book(clonedTable, {
                sheet: "Sheet1"
            });
            XLSX.writeFile(wb, filename);
        }
    </script>
@endsection