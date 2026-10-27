<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Fungsi AI untuk Generate Berita
     */
    public function generateAiContent(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:500'
        ]);

        $apiKey = env('GEMINI_API_KEY');
        
        $systemInstruction = "Anda adalah asisten jurnalis profesional untuk website SDN Medokan Ayu I. 
Tugas Anda: Buatkan judul dan isi berita berdasarkan topik dari user. 
Syarat:
1. Bahasa Indonesia yang baik, ramah, dan formal khas sekolah.
2. Tulis isi berita HANYA dalam teks biasa (plain text). Gunakan baris baru (Enter) untuk memisahkan paragraf dan list. DILARANG KERAS menggunakan tag HTML apapun (seperti <p>, <strong>, <br>, dll).
3. WAJIB balas HANYA dalam format JSON dengan struktur: {\"title\": \"Judul Disini\", \"content\": \"Isi Disini\"}. Jangan tambahkan teks apapun di luar JSON.";

        // Pastikan Anda sudah "use Illuminate\Support\Facades\Http;" di bagian paling atas file
        $response = \Illuminate\Support\Facades\Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $systemInstruction . "\n\nTopik Berita: " . $request->prompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $result = $response->json();
            $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
            
            $text = str_replace(['```json', '```'], '', $text);
            $data = json_decode(trim($text), true);

            if ($data) {
                return response()->json([
                    'success' => true,
                    'data' => $data 
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal terhubung ke AI. Silakan coba lagi.'.$response->body()
        ], 500);
    }
    public function index()
    {
        $news = News::latest()->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     return view('admin.news.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'pdf_attachment' => 'nullable|mimes:pdf|max:10000', // Maks 10MB
    ]);

    $data = $request->all();
    $data['slug'] = Str::slug($request->title);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('news/images', 'public');
    }
    
    if ($request->hasFile('pdf_attachment')) {
        $data['pdf_attachment'] = $request->file('pdf_attachment')->store('news/pdfs', 'public');
    }

    News::create($data);
    return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
       $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_attachment' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Update gambar (Hapus gambar lama jika ada yang baru)
        if ($request->hasFile('image')) {
            if ($news->image) Storage::disk('public')->delete($news->image);
            $data['image'] = $request->file('image')->store('news/images', 'public');
        }

        // Update PDF (Hapus PDF lama jika ada yang baru)
        if ($request->hasFile('pdf_attachment')) {
            if ($news->pdf_attachment) Storage::disk('public')->delete($news->pdf_attachment);
            $data['pdf_attachment'] = $request->file('pdf_attachment')->store('news/pdfs', 'public');
        }

        $news->update($data);
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
       if ($news->image) Storage::disk('public')->delete($news->image);
        if ($news->pdf_attachment) Storage::disk('public')->delete($news->pdf_attachment);
        
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
