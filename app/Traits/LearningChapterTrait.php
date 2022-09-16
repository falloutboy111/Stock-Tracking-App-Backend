<?php

namespace App\Traits;

use App\Models\LearningChapter;
use Illuminate\Support\Str;

trait LearningChapterTrait
{
   /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $learning_chapter = LearningChapter::where(["learning_module_uuid" => $model->learning_module_uuid])->orderBy("chapter", "desc")->first();

            $chapter = $learning_chapter->chapter ?? 0;

            $model->chapter = $chapter + 1;

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