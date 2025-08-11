<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Member;

class ManageUsersController extends Controller
{
    /**
     * Paparkan senarai semua pengguna (members) dan admin.
     * Mengambil semua rekod dari kedua-dua model dan menghantarnya ke view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua admin dari model Admin
        $admins = Admin::all();

        // Mengambil semua pengguna (members) dari model Member
        $users = Member::all();

        // Menghantar data ke view 'admin.manage_users'
        return view('admin.manage_users', compact('admins', 'users'));
    }

    /**
     * Paparkan butiran untuk pengguna (member) tertentu.
     * Menggunakan Route Model Binding untuk mendapatkan model Member.
     *
     * @param  \App\Models\Member  $user
     * @return \Illuminate\View\View
     */
    public function showUser(Member $user)
    {
        return view('admin.user_details', compact('user'));
    }

    /**
     * Paparkan butiran untuk admin tertentu.
     * Menggunakan Route Model Binding untuk mendapatkan model Admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\View\View
     */
    public function showAdmin(Admin $admin)
    {
        return view('admin.admin_details', compact('admin'));
    }

    /**
     * Padamkan pengguna (member) dari pangkalan data melalui permintaan AJAX.
     * Menggunakan try-catch untuk mengendalikan sebarang ralat semasa proses padam.
     *
     * @param  \App\Models\Member  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyUser(Member $user)
    {
        try {
            $user->delete();
            return response()->json(['success' => 'Pengguna berjaya dipadamkan.']);
        } catch (\Exception $e) {
            // Log ralat untuk tujuan penyahpepijatan
            \Log::error('Ralat memadam pengguna: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memadam pengguna.'], 500);
        }
    }

    /**
     * Padamkan admin dari pangkalan data melalui permintaan AJAX.
     * Menggunakan try-catch untuk mengendalikan sebarang ralat semasa proses padam.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAdmin(Admin $admin)
    {
        try {
            $admin->delete();
            return response()->json(['success' => 'Admin berjaya dipadamkan.']);
        } catch (\Exception $e) {
            // Log ralat untuk tujuan penyahpepijatan
            \Log::error('Ralat memadam admin: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memadam admin.'], 500);
        }
    }
}
