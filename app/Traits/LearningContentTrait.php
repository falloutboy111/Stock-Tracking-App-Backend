<?php

namespace App\Traits;

use App\Models\LearningChapter;
use App\Models\LearningContent;
use Illuminate\Support\Str;

trait LearningContentTrait
{
   /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $learning_chapter = LearningContent::where(["learning_chapter_uuid" => $model->learning_chapter_uuid])->orderBy("order", "desc")->first();

            $order = $learning_chapter->order ?? 0;

            $model->order = $order + 1;


            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

   /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

   /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}