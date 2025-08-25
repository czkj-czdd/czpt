<?php

declare(strict_types=1);
namespace app\command;
use app\model\User as UserModel;
use app\model\Cache as CacheModel;
use app\model\Config as ConfigModel;
use app\model\TransactionOrder;
use app\model\Order;
use app\model\Recharge;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\db\exception\DbException;
use Yurun\Util\HttpRequest;


class Cron extends Command
{
    

    protected function configure(): void
    {
        $this->setName('cron')
            ->addOption('data', null, Option::VALUE_NONE, '数据统计')
            ->setDescription('系统数据处理');
    }


    protected function execute(Input $input, Output $output): void
    {
        while (true) {
            if ($input->hasOption('data')) {
                try {
                    // 执行交易订单
                    $TransactionOrder_list = TransactionOrder::where('status', 0)->where('create_time', '<', date('Y-m-d H:i:s', strtotime('-20 minutes')))->select();
                    foreach($TransactionOrder_list as $key => $vo) {
                        $TransactionOrder_info = TransactionOrder::find($vo['id']);
                        $TransactionOrder_info->status = 2;
                        $TransactionOrder_info->cancel_time = date("Y-m-d H:i:s");
                        $TransactionOrder_info->save(); 
                    }

                    //执行充值订单
                    $Recharge_list = Recharge::where('status', 0)->where('create_time', '<', date('Y-m-d H:i:s', strtotime('-20 minutes')))->select();
                    foreach($Recharge_list as $key => $vo) {
                        $Recharge_list = Recharge::find($vo['id']);
                        $Recharge_list->status = 2;
                        $Recharge_list->cancel_time = date("Y-m-d H:i:s");
                        $Recharge_list->save(); 
                    }
                    
                    //执行审核池订单
                    $Order_list = Order::where('status', 2)->where('confirm_status', 1)->where('complete_time', '<', date('Y-m-d H:i:s', strtotime('-10 minutes')))->select();
                    foreach($Order_list as $key => $vo) {
                        $Order_list = Order::find($vo['id']);
                        $Order_list->confirm_status = 2;
                        $Order_list->save(); 
                    }
                    
                    // //删除30天后的订单数据
                    // $Order_destroy_list = Order::where('complete_time', '<', date('Y-m-d H:i:s', strtotime('+30 days')))->select();
                    // foreach($Order_destroy_list as $key => $vo) {
                    //     Order::destroy($vo['id']);
                    // }
                    $output->writeln('执行完毕' );
                } catch (DbException $e) {
                    $output->writeln('错误信息：' . $e->getMessage());
                }
                sleep(5);
            }
        }
    }
}
