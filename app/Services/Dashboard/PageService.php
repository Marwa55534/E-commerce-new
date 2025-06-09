<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PageRepository;
use App\Utils\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Models\Page;

class PageService
{
    /**
     * Create a new class instance.
     */
    protected $pageRepository , $image;
    public function __construct(PageRepository $pageRepository , Image $image)
    {
        $this->pageRepository = $pageRepository;
        $this->image = $image;
    }

    
    public function getPages(){
        return $this->pageRepository->getPages();
    }

    public function getAll(){
        $pages = $this->getPages();

        return DataTables::of($pages)
        ->addIndexColumn()
        ->addColumn('title', function ($page) {
            return $page->getTranslation('title', app()->getLocale());
        })
        ->addColumn('content', function ($page) {
            // return $page->getTranslation('content', app()->getLocale());
            return view('dashboard.pages.datatables.content', compact('page'));
        })
        ->addColumn('image', function ($page) {
            return $page->image != null ? view('dashboard.pages.datatables.image', compact('page')) : 'no image';
        })
        ->addColumn('action', function ($page) {
            return view('dashboard.pages.datatables.actions', compact('page'));
        })
        ->rawColumns(['action', 'image'])
        ->make(true);
    }

    public function getPage($id){
        return $this->pageRepository->getPage($id);
    }

    public function createPage($data){
        if(array_key_exists('image',$data) && $data['image'] != null){ // يعني فيه صوره 
            $file_name = $this->image->uploadSingleImage('/' , $data['image'] , 'pages');
            $data['image'] = $file_name;
        }
        $data['slug'] = Str::slug($data['title']['en']);
        return $this->pageRepository->createPage($data);
    }

    public function updatePage($data , $id){ 
        // select one
        $page = $this->getPage($id);  

        // تحقق من وجود "الشعار" في مصفوفة البيانات
        if(array_key_exists('image',$data) && $data['image'] != null){ // asset
            // Delete old image if a new one is provided
            $this->image->deleteImageFromLocal('uploads/pages/'. $page->image);

            $file_name = $this->image->uploadSingleImage('/' , $data['image'],'pages');
            $data['image'] = $file_name;
        }
        $data['slug'] = Str::slug($data['title']['en']);
        return $this->pageRepository->updatePage($page , $data);
    }

    public function deletePage($id){
        // select one
        $page = $this->getPage($id);
        if(!$page) {
            return false;
        }
        // check if has file_name
        if($page->image != null){ // يعني فيه صوره 
            $this->image->deleteImageFromLocal('uploads/pages/'. $page->image);
        }
        return $this->pageRepository->deletePage($page);
    } 

    public function deleteImage($id){
        // select one
        $page = $this->getPage($id);
        if(!$page) {
            return false;
        }
        // check if has file_name
        if($page->image != null){ // يعني فيه صوره 
            $this->image->deleteImageFromLocal('uploads/pages/'. $page->image);

            $page->image = null;
            $page->save();
        }
        return $page;
    }

}
