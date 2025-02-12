<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addProductModal extends Model
{
    use HasFactory;
    protected $table="newproduct";
    public $timestamps = false;
    protected $casts = [
        'variation_offer_description' => 'array',
        'variation_key_benefits_question' => 'array',
        'variation_product_feature_title' => 'array',
        'variation_pdf_title' => 'array',
    ];
    protected $fillable = [
        'product_name',
        'product_image',
        'product_category',
        'product_description',
        'variation_offer_gallery',
        'variation_offer_description',
        'variation_key_benefits_question',
        'variation_key_benefits_answer',
        'variation_product_feature_title',
        'variation_product_feature_gallery',
        'variation_product_feature_description',
        'variation_pdf_title',
        'variation_product_pdf_gallery',
        'service_contact',
        'spares_contact',
        'blog_cat',
        'article_cat',
    ];
}
