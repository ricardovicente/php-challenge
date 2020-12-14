<?php

namespace App\Jobs;

use App\Models\File;
use App\Services\ImportPeopleService;
use App\Services\ImportShipOrdersService;
use App\Services\XmlService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class XmlProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const STATUS_UPLOADING = 'uploading';
    const STATUS_WAITING = 'waiting';
    const STATUS_PROGRESS = 'progress';
    const STATUS_PROCESSED = 'processed';

    const TYPE_PEOPLE = 'people';
    const TYPE_SHIP_ORDERS = 'shiporders';

    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $items = XmlService::process(storage_path('app/'.$this->file->stored_path));

        if (self::TYPE_PEOPLE == $this->file->type) {
            $total = ImportPeopleService::import($items, $this->file->id);
        } else {
            $total = ImportShipOrdersService::import($items, $this->file->id);
        }

        $this->updateStatusToProcessed($this->file->id, $total);
    }

    private function updateStatusToProcessed($fileId, $total)
    {
        return File::whereId($fileId)->update([
            'status' => self::STATUS_PROCESSED,
            'records' => $total
        ]);
    }
}
