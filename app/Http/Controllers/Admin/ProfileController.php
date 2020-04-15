<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでprofile Modelが扱えるようになる
use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
      return view('admin.profile.create');
    }

    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);

      $profiles = new Profile;
      $form = $request->all();

      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $profiles->image_path = basename($path);
      } else {
          $profiles->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);

      $profiles->fill($form);
      $profiles->save();

      return redirect('admin/profile/create');
    }
    public function edit(Request $request)
    {
      $profiles = Profile::find($request->id);
      if (empty($profiles)) {
        abort(404);
      }
        return view('admin.profile.edit',['profile_form' => $profiles]);
      }
    public function update(Request $request)
    {
      $this->validate($request, Profile::$rules);

      $$profiles = Profile::find($request->id);

      $profiles_form = $request->all();
      if (isset($profiles_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $profiles->image_path = basename($path);
        unset($profiles_form['image']);
      } elseif (0 == strcmp($request->remove, 'true')) {
        $profiles->image_path = null;
      }
        unset($news_form['_token']);
        unset($news_form['remove']);

      $news->fill($profiles_form)->save();

      return redirect('admin/profiles');
    }
  }
?>
