<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Story;
use App\Models\UserStory;
use App\Models\Wereyword;
use App\Models\Wordgroup;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\Facades\Image;
use CyrildeWit\EloquentViewable\Views;
use CyrildeWit\EloquentViewable\Support\Period;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminController extends Controller
{
    public function dashboard()
    {
       //$storyView = Story::orderByViews('asc', Period::pastDays(3))->get();
       //dd($storyView);

        $data = [
            'totalStories' => Story::count(),
            'totalWordgroups' => Wordgroup::count(),
            'totalWereywords' => Wereyword::count(),
            'totalUserStories' => UserStory::count(),
            'totalViewsStories' => views()->countByType(Story::class),
            'totalViewsUserStories' => views()->countByType(UserStory::class)
        ];

        $story_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Story',
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'line',

            'filter_field' => 'created_at',
            'filter_days' => 30, // show only transactions for last 30 days
            'filter_period' => 'week', // show only transactions for this week
        ];

        $story_chart = new LaravelChart($story_options);

    	return view('admin.dashboard', [
            'data' => $data,
            'story_chart' => $story_chart
        ]);
    }

    public function manageAds(Request $request)
    {

        if($request->isMethod('POST')){

            $messages = [
                'destination_url.required' => 'The destination URL is required',
                'title.required' => 'The title is required'
            ];

            $validator = Validator::make($request->all(), [
                'destination_url' => 'required',
                'ad_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'title' => 'required'
            ], $messages);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

           $ad = Ad::create([
                'title' => $request->input('title'),
                'placement' => $request->input('placement'),
                'destination_url' => $request->input('destination_url')
           ]);

            if ($request->hasFile('ad_image')) {
                $banner = $request->file('ad_image');
                $randomKey = sha1(time() . microtime());
                $extension = $banner->getClientOriginalExtension();
                $fileName = $randomKey . '.' . $extension;

                $destinationPath = public_path() . '/uploads/ads/';

                $bannerImage = Image::make($banner->getRealPath());

                //Save the Banner Image
                $upload_success = $bannerImage->save($destinationPath . '/' . $fileName);

                if ($upload_success) {
                    $ad->banner_image = $fileName;
                }

                $ad->save();
            }

            return redirect()->back()->with('success', 'Ads successfully created');
        }

        $ads = Ad::orderBy('created_at', 'desc')->get();

        return view('admin.manage-ads', [
            'ads' => $ads
        ]);
    }

     public function deleteAd($id)
    {
        $ad = Ad::find($id);

        $adImagePath = public_path() . '/uploads/ads/'. $ad->banner_image;

        if(file_exists($adImagePath)){
            @unlink($adImagePath);
        }

        $ad->delete();

        return redirect()->back()->with('error', 'Ad Successfully deleted');
    }
}
