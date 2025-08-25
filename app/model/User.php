<?php
declare (strict_types=1);

namespace app\model;

use think\Model;

/**
 * @mixin Model
 */
class User extends Model
{
    // 设置json类型字段
    protected $json = ['certification'];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;
}
