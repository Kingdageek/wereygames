<?php

namespace App\Services;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class PageSeoService
{
    use SEOToolsTrait;

    public function index()
    {
        $this->seo()->setTitle('The funniest word-game you\'ve ever played');
        $this->seo()->setDescription('The funniest word-game you\'ve ever played');

        $this->seo()->opengraph()->setTitle('The funniest word-game you\'ve ever played');
        $this->seo()->opengraph()->setDescription('The funniest word-game you\'ve ever played.');
        $this->seo()->opengraph()->setUrl(route('front.index'));
        $this->seo()->opengraph()->addProperty('type', 'article');
        $this->seo()->opengraph()->addImage(asset('assets/app/img/spotlight/front.jpg'));

        $this->seo()->twitter()->setTitle('The funniest word-game you\'ve ever played');
        $this->seo()->twitter()->setDescription('The funniest word-game you\'ve ever played');
        $this->seo()->twitter()->setUrl(route('front.index'));
        $this->seo()->twitter()->addImage(asset('assets/app/img/spotlight/front.jpg'));
    }

    public function preview($story, $formedStory)
    {
        $this->seo()->setTitle($story->title);
        $this->seo()->setDescription(str_limit(strip_tags($formedStory->content),225,'...'));

        $this->seo()->opengraph()->setTitle($story->title);
        $this->seo()->opengraph()->setDescription(str_limit(strip_tags($formedStory->content),225,'...'));
        $this->seo()->opengraph()->setUrl(route('story.preview', $formedStory->slug));
        $this->seo()->opengraph()->addProperty('type', 'article');
        $this->seo()->opengraph()->addImage($story->featured_image);

        $this->seo()->twitter()->setTitle($story->title);
        $this->seo()->twitter()->setDescription(str_limit(strip_tags($formedStory->content),225,'...'));
        $this->seo()->twitter()->setUrl(route('story.preview', $formedStory->slug));
        $this->seo()->twitter()->addImage($story->featured_image);
    }

}
