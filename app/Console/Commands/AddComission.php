<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AddComission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AddComission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adding daily comissions';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $totalComissions = DB::table('transactions')
            ->select(DB::raw('sum(monto) as total'))
            ->where('state',1)
            ->where('users_id', Auth::user()->id)
            ->where('transactions_types_id',"!=",1)
            ->first();
        // el $total es el que se incrementara
        $total = $totalComissions->total * 0.015;    

        DB::table('users')
            ->where('id', 105)
            ->increment('renta_temporal', 1);
            //una vez incremente, decrementar los remaining days
            //recorrer todas las transacciones del usuario y la que remainingDays este en 0 cambiar el estado a 0 
    }
}
