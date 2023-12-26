<?php

namespace App\Http\Controllers\Admin;

use App\Models\PodcastCategory;
use App\PodcastCategory as AppPodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WebPodcatCategCotroller extends MainAdminController
{

    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
        check_verify_purchase();

    }
    public function podcastcats_list()    {

        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');

        }

        $page_title= "Categorie Podcats"; //trans('words.genres_text');

        $genres_list = AppPodcastCategory::orderBy('category_name')->paginate(10);

        return view('admin.pages.ext.cat_podcats_list',compact('page_title','genres_list'));
    }

    public function addCat()    {

        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');

        }

        $page_title="nouvelle categuorie";//trans('words.add_genre');

        return view('admin.pages.ext.addeditcatpodcast',compact('page_title'));
    }

    public function addnew(Request $request)
    {

        $data =  \Request::except(array('_token')) ;

        $rule=array(
                'genre_name' => 'required'
                );

        $validator = Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }
        $inputs = $request->all();

        if(!empty($inputs['id'])){

            $genre_obj = AppPodcastCategory::findOrFail($inputs['id']);

        }else{

            $genre_obj = new AppPodcastCategory();

        }

        $genre_slug = Str::slug($inputs['genre_name'], '-');

        $genre_obj->category_name = addslashes($inputs['genre_name']);
        $genre_obj->category_slug = $genre_slug;
        $genre_obj->status = $inputs['status'];

        $genre_obj->save();


        if(!empty($inputs['id'])){

            Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }


    }

    public function editCat($genre_id)
    {
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');

        }

        $page_title="MODIFIER LA CATEGuorie";//trans('words.edit_genre');

        $genre = AppPodcastCategory::findOrFail($genre_id);

        return view('admin.pages.ext.addeditcatpodcast',compact('page_title','genre'));

    }

    public function delete($genre_id)
    {
        //dd($genre_id); die;
        if(Auth::User()->usertype=="Admin" OR Auth::User()->usertype=="Sub_Admin")
        {

        $genre = AppPodcastCategory::findOrFail($genre_id);

        $genre->delete();

        Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
        }
        else
        {
            Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');


        }
    }

}
