<?php

namespace App\Jobs;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class trade implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data ;
    public $tries = 2;
    public $timeout = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $status = 0;
        $data =  $this->data->data;
        $sno = (string)$data[0]['sno'];
        $class = (string)$data[0]['class'];
        $id = $data[0]['id'];
        $shetuan = $data[0]['shetuan'];

        $result = objectToArray(DB::table('astrict')->where('shetuan',$id)->where("class",$class)->first());
        if ($result['count'] >= $result['sum']){
            $status = -1;
        }else{

            DB::beginTransaction();
            try{
                $checkA =  DB::table('student')->where('sno',$sno)->update(['shetuan' => $result['shetuan']]);
                $checkB =  DB::table('astrict')->where('shetuan',$id)->where("class",$class)->update(['count' => $result['count']+1]);

                if ($checkA && $checkB){
                    DB::commit();
                    $status = 1;
                }
            } catch (Exception $e) {
                Db::rollback();//捕捉异常后回滚事务
                $status = -2;
            }
        }
        dump($status);
        dump($sno);
        dump(DB::table('student')->where('sno',$sno)->update(['status' =>$status]));

    }

    public function fail(Exception $exception)
    {



    }
}
