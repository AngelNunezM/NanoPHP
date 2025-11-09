<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\Authentication;
use App\Models\Document;
use App\Services\EvidenceService;
use Exception;

class EvidenceController {
    
    use HTTP;

    private EvidenceService $evidenceService;

    public function __construct(){
        $this->evidenceService = new EvidenceService();
    }

    public function index(int $stageId): void
    {
        try {
            $documents = $this->evidenceService->getDocumentsForStage($stageId);

            $this->response([
                "success" => true,
                "documents" => $documents
            ], 200);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    public function publish(): void  
    {
        Authentication::verify();
        $request = $this->request();

        try {
            $document = new Document([
                'stage_id' => $request['stage_id'] ?? 0,
                "file_name" => $request['_files']['document']['name'] ?? '',
                "file_tmp"  => $request['_files']['document']['tmp_name'] ?? '',
                'name_document' => $request['name'] ?? '',
                'description_document' => $request['description'] ?? ''
            ]);

            $createdDocument = $this->evidenceService->submitEvidence($document);

            $this->response([
                'success' => true,
                'data' => $createdDocument,
                'message' => 'Documento subido exitosamente.'
            ], 200);
        } catch (Exception $ex) {
            $this->response([
                'success' => false,
                'message' => $ex->getMessage()
            ], 500);
        } 
    }

    public function download(int $documentId)
    {
        Authentication::verify();
        $document = $this->evidenceService->getDocument($documentId);

        if (!$document) {
            http_response_code(404);
            exit("Documento no encontrado");
        }

        $filePath = __DIR__ . '/../../' . ltrim($document->file_path, '/');
        
        // Normalizar la ruta
        $filePath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $filePath);
        $filePath = realpath($filePath);

        if (!$filePath || !file_exists($filePath)) {
            http_response_code(404);
            exit("Archivo no encontrado en la ruta: " . $document->file_path);
        }

  
        $fileName = $document->file_name;

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        if (ob_get_level()) {
            ob_clean();
        }
        flush();

        readfile($filePath);
        exit;
    }


    public function delete(int $documentId): void
    {
        Authentication::verify();

        try {
            $this->evidenceService->deleteDocument($documentId);

            $this->response([
                'success' => true,
                'message' => 'Documento eliminado exitosamente.'
            ], 200);
        } catch (Exception $ex) {
            $this->response([
                'success' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

}