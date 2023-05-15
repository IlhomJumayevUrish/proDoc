<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

Route::get('/qr', function () {
        $writer = new PngWriter();
        $qrCode = QrCode::create('Life is too short to be generating QR codes')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $result = $writer->write($qrCode);
        $result->saveToFile('code.png');
});

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('doc', [DocumentController::class, 'index']);
    Route::post('doc', [DocumentController::class, 'create'])->name('document');
    Route::post('document/{id}', [DocumentController::class, 'file'])->name('file');
    Route::get('template/', [TemplateController::class, 'index']);
    Route::get('template/{id}', [TemplateController::class, 'show'])->name('temp');
    Route::get('temp/{id}', [TemplateController::class, 'temp'])->name('temps');
    Route::post('temp/{id}', [TemplateController::class, 'temp'])->name('template-delete');
    Route::post('template/{id}', [TemplateController::class, 'generate'])->name('generate');
    Route::post('template/', [TemplateController::class, 'create'])->name('template');

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
});
