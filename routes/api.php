<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Buyers
 */
Route::resource('buyers','Buyer\BuyerController')->only(['index','show']);

Route::resource('buyer.transactions','Buyer\BuyerTransactionsController')->only(['index']);

Route::resource('buyer.products','Buyer\BuyerProductsController')->only(['index']);

Route::resource('buyer.seller','Buyer\BuyerSellerController')->only(['index']);

Route::resource('buyer.categories','Buyer\BuyerCategoriesController')->only(['index']);

/**
 * Sellers
 */
Route::resource('sellers','Seller\SellerController')->only(['index','show']);

Route::resource('seller.transactions','Seller\SellerTransactionsController')->only(['index']);

Route::resource('seller.categories','Seller\SellerCategoriesController')->only(['index']);

Route::resource('seller.buyers','Seller\SellerBuyersController')->only(['index']);

/**
 * Categories
 */
Route::resource('categories','Category\CategoryController')->except(['create','edit']);

Route::resource('category.products','Category\CategoryProductController')->only(['index']);

Route::resource('category.sellers','Category\CategorySellersController')->only(['index']);

Route::resource('category.transactions','Category\CategoryTransactionsController')->only(['index']);

Route::resource('category.buyers','Category\CategoryBuyersController')->only(['index']);

/**
 *Products
 */
Route::resource('products','Product\ProductController')->only(['index','show']);

/**
 *Transactions
 */
Route::resource('transactions','Transaction\TransactionController')->only(['index','show']);

Route::resource('transactions.categories','Transaction\TransactionCategoryController')->only(['index']);

Route::resource('transactions.seller','Transaction\TransactionSellerController')->only(['index']);

/**
 *Users
 */
Route::resource('users','User\UserController')->except(['create','edit']);


