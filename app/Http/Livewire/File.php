<?php

namespace App\Http\Livewire;

use App\Jobs\XmlProcess;
use App\Models\File as ModelsFile;
use App\Services\FileService;
use App\Services\UploadService;
use DOMDocument;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class File extends Component
{
    use WithPagination, WithFileUploads;

    public $status_uploading = XmlProcess::STATUS_UPLOADING;
    public $status_waiting = XmlProcess::STATUS_WAITING;
    public $status_progress = XmlProcess::STATUS_PROGRESS;
    public $status_processed = XmlProcess::STATUS_PROCESSED;

    public $attachment;
    public $naTela;

    public function render()
    {
        $files = ModelsFile::where('status', '!=', XmlProcess::STATUS_UPLOADING)
                            ->orderBy('id', 'DESC')
                            ->paginate(10);

        return view('livewire.file', [
            'files' => $files
        ]);
    }

    public function upload()
    {
        $this->validate([
            'attachment' => [
                'required', 
                'mimes:xml'
            ]
        ]);

        $fileName = FileService::fileName($this->attachment);

        try {
            $upload = UploadService::upload($this->attachment, $fileName);

            $xsdType = $this->typeXsd($upload);

            $file = $this->save($xsdType, $upload);


            XmlProcess::dispatch($file);


        } catch (Exception $e) {
            Log::error('Upload error. '. $e->getMessage() .' > ' . ' File '.$e->getFile() . ' LINE '.$e->getLine());
        }
    }

    private function save($xsdType, $upload)
    {
        $data = [
            'user_id' => Auth::id(),
            'original_name' => $this->attachment->getClientOriginalName(),
            'stored_path' => $upload,
            'size'=> FileService::fileSize($this->attachment),
            'type' => $xsdType,
            'status' => XmlProcess::STATUS_WAITING
        ];

        return ModelsFile::create($data);
    }

    public function typeXsd($value)
    {
        $objDom = new DOMDocument;

        $objDom->load(storage_path('app/'.$value));

        $schemaPeople = @$objDom->schemaValidate(app_path('Rules/people.xsd'));
        //$schemaShipOrders = @$objDom->schemaValidate(app_path('Rules/shiporders.xsd'));

        return ($schemaPeople) ? XmlProcess::TYPE_PEOPLE : XmlProcess::TYPE_SHIP_ORDERS;
    }
}
