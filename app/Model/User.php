<?php

declare(strict_types=1);

namespace App\Model;



use App\Enum\UserEnum;
use Qbhy\HyperfAuth\Authenticatable;

/**
 * @property int $id 
 * @property string $nickname 昵称
 * @property string $email 邮箱
 * @property string $password 密码
 * @property string $avatar 头像
 * @property \App\Enum\UserEnum $status 状态 0=冻结 1= 正常
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class User extends Model implements Authenticatable
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'users';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime', 'status' => UserEnum::class];

    public function getId()
    {
       return $this->id;
    }

    public static function retrieveById($key): ?Authenticatable
    {
       return  self::query()->find($key);
    }
}
