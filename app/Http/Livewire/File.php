<?php

namespace App\Http\Livewire;

use App\Models\File as ModelsFile;
use App\Services\FileService;
use App\Services\ImportPeopleService;
use App\Services\ImportShipOrdersService;
use App\Services\UploadService;
use App\Services\XmlPeopleService;
use App\Services\XmlService;
use App\Services\XmlShipOrdersService;
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

    const STATUS_UPLOADING = 'uploading';
    const STATUS_WAITING = 'waiting';
    const STATUS_PROGRESS = 'progress';
    const STATUS_PROCESSED = 'processed';

    const TYPE_PEOPLE = 'people';
    const TYPE_SHIP_ORDERS = 'shiporders';

    public $status_uploading = self::STATUS_UPLOADING;
    public $status_waiting = self::STATUS_WAITING;
    public $status_progress = self::STATUS_PROGRESS;
    public $status_processed = self::STATUS_PROCESSED;

    public $attachment;
    public $naTela;

    public function render()
    {
        $files = ModelsFile::where('status', '!=', self::STATUS_UPLOADING)
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


            //XmlProcess::dispatch($file);

            $items = XmlService::process(storage_path('app/'.$upload));

            if (self::TYPE_PEOPLE == $xsdType) {
                $total = ImportPeopleService::import($items, $file->id);
            } else {
                $total = ImportShipOrdersService::import($items, $file->id);
            }

            $this->updateStatusToProcessed($file->id, $total);

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
            'status' => self::STATUS_WAITING
        ];

        return ModelsFile::create($data);
    }

    private function updateStatusToProcessed($fileId, $total)
    {
        return ModelsFile::whereId($fileId)->update([
            'status' => self::STATUS_PROCESSED,
            'records' => $total
        ]);
    }

    public function typeXsd($value)
    {
        $objDom = new DOMDocument;

        $objDom->load(storage_path('app/'.$value));

        $schemaPeople = @$objDom->schemaValidate(app_path('Rules/people.xsd'));
        //$schemaShipOrders = @$objDom->schemaValidate(app_path('Rules/shiporders.xsd'));

        return ($schemaPeople) ? self::TYPE_PEOPLE : self::TYPE_SHIP_ORDERS;
    }

}
