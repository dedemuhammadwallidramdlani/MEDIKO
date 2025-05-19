<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Obat;

use App\Models\Transaksi;

use App\Models\Bahanbaku; // Import the User model



class DashboardController extends Controller

{

public function index()

{

$users = User::count();
$dataobat = Obat::count();

$bahanbaku = Bahanbaku::count();

 $transaksi = Transaksi::count();

return view('dashboard.index', compact('users', 'dataobat', 'transaksi', 'bahanbaku'));

 }

}