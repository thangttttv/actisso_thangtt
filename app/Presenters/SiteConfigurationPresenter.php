<?php

namespace App\Presenters;

use App\Models\Image;
use Illuminate\Support\Facades\Redis;

class SiteConfigurationPresenter extends BasePresenter
{
    /**
     * @return \App\Models\Image
     * */
    public function ogpImage()
    {
        $cached = Redis::hget(\CacheHelper::generateCacheKey('hash_images'), $this->entity->ogp_image_id);
        if( $cached ) {
            $image = new Image(json_decode($cached, true));
            $image['id'] = json_decode($cached, true)['id'];
            return $image;
        } else {
            $image = $this->entity->ogpImage;
            Redis::hsetnx(\CacheHelper::generateCacheKey('hash_images'), $this->entity->ogp_image_id, $image);
            return $image;
        }
    }

    /**
     * @return \App\Models\Image
     * */
    public function twitterCardImage()
    {
        $cached = Redis::hget(\CacheHelper::generateCacheKey('hash_images'), $this->entity->twitter_card_image_id);
        if( $cached ) {
            $image = new Image(json_decode($cached, true));
            $image['id'] = json_decode($cached, true)['id'];
            return $image;
        } else {
            $image = $this->entity->twitterCardImage;
            Redis::hsetnx(\CacheHelper::generateCacheKey('hash_images'), $this->entity->twitter_card_image_id, $image);
            return $image;
        }
    }
}
