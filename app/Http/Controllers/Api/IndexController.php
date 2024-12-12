<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormSubmit;
use App\Models\Category;
use App\Models\Country;
use App\Models\Enquiry;
use App\Models\Event;
use App\Models\Maintain;
use App\Models\News;
use App\Models\Product;
use App\Models\Question;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeDietType;
use App\Models\RecipeMealType;
use App\Models\RecipeProductType;
use App\Models\Region;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function categories(){
        return response()->json(Category::latest()->get());
    }
    public function recipeCategories(){
        return response()->json(RecipeCategory::orderby('id','asc')->get());
    }
    public function recipeSubCategories(){
        $data['productType']=RecipeProductType::all();
        $data['mealType']=RecipeMealType::all();
        $data['dietType']=RecipeDietType::all();
        return response()->json($data);
    }
    public function recipes(){
        $recipes = Recipe::with('recipeCategory','recipeMealType','recipeProductType','recipeDietType');
        if ($recipe_categories_uuid = request('recipe_categories_uuid')) {
            $recipes->where('recipe_categories_uuid', $recipe_categories_uuid);
        }
        if ($recipe_meal_types_uuid = request('recipe_meal_types_uuid')) {
            $recipes->where('recipe_meal_types_uuid', $recipe_meal_types_uuid);
        }
        if ($recipe_product_types_uuid = request('recipe_product_types_uuid')) {
            $recipes->where('recipe_product_types_uuid', $recipe_product_types_uuid);
        }
        if ($recipe_diet_types_uuid = request('recipe_diet_types_uuid')) {
            $recipes->where('recipe_diet_types_uuid', $recipe_diet_types_uuid);
        }
        $take =null;
        if($newTake = request('take')){
            $take = $newTake;
        }
        if($take){
            $recipes = $recipes->paginate($take);
        }else{
            $recipes = $recipes->paginate(40);
        }
        return response()->json($recipes);
    }
    public function recipeIndex($slug){
        return response()->json(Recipe::with('recipeCategory','recipeMealType','recipeProductType','recipeDietType')->where('title_slug',$slug)->first());
    }
    public function regionMap(){
        return response()->json(Region::all());
    }
    public function countries(){
        return response()->json(Country::select('id','name')->get());
    }
    public function products(Request $request){
        $products = Product::with('manufacturer', 'countryImport', 'countryMadeIn', 'category');

        if ($countryImportId = request('country_import_id')) {
            $products->where('country_import_id', $countryImportId);
        }

        if ($manufacturerId = request('manufacturer_id')) {
            $products->where('manufacturer_id', $manufacturerId);
        }

        if ($categoryId = request('category_id')) {
            $products->where('category_id', $categoryId);
        }
        if ($lead = request('lead')) {
            $products->where('lead', $lead);
        }
        $order = request('order', 'desc');
        $products->orderBy('created_at', $order);
        $take =null;
        if($newTake = request('take')){
            $take = $newTake;
        }
        if($take){
            $products = $products->paginate($take);
        }else{
            $products = $products->paginate(40);
        }
       
        return response()->json($products);
    }
    public function productIndex($slug){
        
        return response()->json(Product::with('manufacturer','countryImport','countryMadeIn','category')->where('title_slug', $slug)->firstOrFail());
    }
    public function services(){
        return response()->json(Maintain::latest()->paginate(40));
    }
    public function serviceIndex($slug){
        return response()->json(Maintain::where('title_slug', $slug)->firstOrFail());
    }
    public function faqs(){
        $question = Question::orderby('order','asc');
        if ($categoryID = request('category')) {
            $question->where('category', $categoryID);
        }
        return response()->json($question->get());
    }

    public function events(){
        
        if (request('category')) {
            $events = Event::where('category', request('category'))->paginate(40);
        }else{
            $events = Event::paginate(40);
        }
        return response()->json($events);
    }
    public function eventsSimilar($slug){
        $event = Event::where('title_slug', $slug)->first();
       
        if($event){
            $similars = Event::where('category',$event->category )->where('id','!=',$event->id)->latest()->take(3)->get();
            return response()->json($similars);
        }else{
            return response()->json([]);
        }

    }
    public function eventsIndex($slug){
        return response()->json(Event::where('title_slug', $slug)->firstOrFail());
    }

    public function news(){
        
       
            $news = News::with('tags')->latest()->paginate(40);
       
        return response()->json($news);
    }
    public function newsSimilar($slug){
        $news = News::where('title_slug', $slug)->first();
       
        if($news){
            $new = News::where('type',$news->type )->where('id','!=',$news->id)->latest()->take(3)->get();
            return response()->json($new);
        }else{
            return response()->json([]);
        }

    }
    public function newsIndex($slug){
        return response()->json(News::with('tags')->where('title_slug', $slug)->firstOrFail());
    }
    public function formSubmit(FormSubmit $request){
        $data = $request->validated();
        $enquiry = new Enquiry();
        $enquiry->name = $data['name'];
        $enquiry->email = isset($data['email'])? $data['email'] : null;
        $enquiry->message = $data['message'];
        $enquiry->type = $data['type'];
        $enquiry->phone =isset( $data['phone'])?  $data['phone'] : null;
        $enquiry->save();
        return response()->json($enquiry,201);
    }
}
