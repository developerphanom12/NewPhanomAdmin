<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTriggerSeeder extends Seeder
{
    public function run(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS trg_generate_transaction_number;

            CREATE TRIGGER trg_generate_transaction_number
            BEFORE INSERT ON transactions
            FOR EACH ROW
            BEGIN
                SET NEW.transaction_number = CONCAT(
                    'TXN',
                    DATE_FORMAT(NOW(), '%Y%m%d%H%i%s'),
                    LPAD(FLOOR(RAND() * 1000), 3, '0')
                );
            END
        ");
    }
}

