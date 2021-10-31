<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Status;

class AddStatuses extends Migration
{
    private array $statuses = [
        Status::STATUS_PAYED,
        Status::STATUS_PAYMENT_EXPIRED,
        Status::STATUS_PENDING,
        Status::STATUS_SUCCESS,
        Status::STATUS_WAIT_FOR_PAYMENT,
        Status::STATUS_CANCEL,
    ];

    public function up()
    {
        foreach ($this->statuses as $status) {
            $this->storeStatus($status);
        }
    }

    public function down()
    {
        foreach ($this->statuses as $status) {
            $this->deleteStatus($status);
        }
    }

    private function storeStatus($status)
    {
        DB::table('statuses')->insertOrIgnore([
            'title' => $status,
        ]);
    }

    private function deleteStatus($status)
    {
        DB::table('statuses')
            ->where('title', $status)
            ->delete();
    }
}
