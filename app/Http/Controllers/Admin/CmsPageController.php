<?php

namespace App\Http\Controllers\Admin;

use App\Models\CmsPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'cms_pages');

        $cmsPages = CmsPage::all();

        return view('admin.cms_pages.index', compact('cmsPages'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add CMS Page";
           // $cmsPage = new CmsPage();
           // $message = "CMS Page added successfully!";
        } else {
            $title = "Edit CMS Page";
         //   $cmsPage = CmsPage::find($id);
           // $message = "CMS Page updated successfully!";
        }

        return view('admin.cms_pages.edit', compact('title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
    
            // change status based on the current value
            $status = ($data['status'] == "Active") ? 0 : 1;
    
            // update the status in the database
            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
    
            // return the response in JSON format
            return response()->json(['status' => $status, 'page_id' => $data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CmsPage $cmsPage)
    {
        //
    }
}
