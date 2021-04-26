<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AssetMaster extends Model
{
    use LogsActivity;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asset_master';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['material_number', 'brand', 'category', 'material_description', 'asset_group_id', 'sub_asset_group_id'];

    public function foreign_asset_group()
    {
        return $this->belongsTo(AssetGroup::class, 'asset_group_id');
    }

    public function foreign_sub_asset_group()
    {
        return $this->belongsTo(SubAssetGroup::class, 'sub_asset_group_id');
    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
