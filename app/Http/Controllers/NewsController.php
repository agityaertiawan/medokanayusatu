<?php

namespace App\Http\Controllers;
use App\Models\News;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class NewsController extends Controller
{
    public function show($id){
        // Cari data berita berdasarkan ID (Ganti 'News' dengan nama Model Anda jika berbeda, misal 'Berita')
        $news = \App\Models\News::findOrFail($id);
        return view('news.show', compact ('news'));
    }
    
    public function downloadPdf(News $news){
        If(!$news->pdf_attachment || !Storage::disk('public')->exists($news->pdf_attachment)){
            abort(404, 'Maaf, dokumen PDF lampiran tidak ditemukan.');
        }

        //Ambil lokasi file asli
        $filePath = storage_path('app/public/'. $news->pdf_attachment);

        //Buat nama file rapi saat didownload (contoh: lomba-pramuka-lampiran.pdf)
        $downloadFileName = Str::slug($news->title). '-lampiran.pdf';
        return response()->download ($filePath, $downloadFileName);
    }
}
