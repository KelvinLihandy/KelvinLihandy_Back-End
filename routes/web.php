<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/view', [ItemController::class, 'getItems'])->name('viewItemsPage');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cartPage');
    Route::post('/add-cart', [CartController::class, 'addCart'])->name('addCart');
    Route::get('/invoice', [InvoiceController::class, 'viewInvoice'])->name('invoicePage');
    Route::post('/invoice', [InvoiceController::class, 'viewInvoice'])->name('addInvoice');
    Route::patch('/save-invoice/{invoiceNumber}', [InvoiceController::class, 'saveInvoice'])->name('saveInvoice');
});

Route::middleware('admin')->group(function(){
    Route::get('/create', [ItemController::class, 'getCreatePage'])->name('createItemPage');
    Route::post('/create-item', [ItemController::class, 'createItem'])->name('createItem');
    Route::get('/update/{id}', [ItemController::class, 'getItemByID'])->name('updateItemPage');
    Route::patch('/update-item/{id}', [ItemController::class, 'updateItem'])->name('updateItem');
    Route::delete('/delete-item/{id}', [ItemController::class, 'deleteItem'])->name('deleteItem');
});

require __DIR__.'/auth.php';
