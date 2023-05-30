<?php

namespace App\Http\Controllers;

use TCPDF;
use TCPDF2DBarcode;
use \setasign\Fpdi\Fpdi;
use App\Models\Backup;
use Illuminate\Http\Request;
use setasign\Fpdi\PdfParser\StreamReader;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                // Chemin vers le fichier PDF à signer
                $pdfPath = public_path('/img/sample.pdf');

                // Charger l'image de signature
                $signatureImage = public_path('/img/86304d84-eca3-48b1-97ea-b12de55fbba0.png');
                        // Chemin vers le fichier PDF signé
        $signedPDFPath = public_path('documents/signed-report.pdf');
        $pdfFilePath = 'chemin/vers/votre/rapport.pdf';


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Backup $backup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Backup $backup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Backup $backup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Backup $backup)
    {
        //
    }
}
