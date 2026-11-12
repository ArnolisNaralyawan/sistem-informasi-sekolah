<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pesan::orderBy('created_at', 'desc');
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by tipe
        if ($request->has('tipe') && $request->tipe) {
            $query->where('tipe', $request->tipe);
        }
        
        $pesan = $query->paginate(15);
        
        // Hitung statistik
        $stats = [
            'total' => Pesan::count(),
            'unread' => Pesan::where('status', 'unread')->count(),
            'read' => Pesan::where('status', 'read')->count(),
            'masuk' => Pesan::where('tipe', 'masuk')->count(),
        ];
        
        return view('admin.pesan.index', compact('pesan', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pesan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
            'tipe' => 'required|in:masuk,keluar'
        ]);

        $validated['status'] = 'unread';

        Pesan::create($validated);

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesan = Pesan::findOrFail($id);
        
        // Mark as read when viewing
        if ($pesan->status == 'unread') {
            $pesan->markAsRead();
        }
        
        return view('admin.pesan.show', compact('pesan'));
    }
    /**
 * Store message from website (public access)
 */
        public function storeFromWebsite(Request $request)
        {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subjek' => 'required|string|max:255',
                'pesan' => 'required|string',
            ]);

            $validated['status'] = 'unread';
            $validated['tipe'] = 'masuk';

            Pesan::create($validated);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan membalasnya segera.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }

    /**
     * Mark as read
     */
    public function markAsRead($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->markAsRead();

        return back()->with('success', 'Pesan ditandai sebagai sudah dibaca');
    }

    /**
     * Mark all as read
     */
    public function markAllAsRead()
    {
        Pesan::where('status', 'unread')->update(['status' => 'read']);

        return back()->with('success', 'Semua pesan ditandai sebagai sudah dibaca');
    }

    /**
     * Get unread messages count for navbar
     */
    public function getUnreadCount()
    {
        return Pesan::where('status', 'unread')->count();
    }
}