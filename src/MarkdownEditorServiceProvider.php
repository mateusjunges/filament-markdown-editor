<?php

namespace Spatie\FilamentMarkdownEditor;

use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MarkdownEditorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-markdown-editor')
            ->hasAssets()
            ->hasViews();
    }

    public function bootingPackage()
    {
        if (class_exists(FilamentAsset::class)) {
            FilamentAsset::register([
                Js::make('spatie-markdown-editor', __DIR__.'/../resources/dist/editor.js'),
                Css::make('font-awesome', 'https://pro.fontawesome.com/releases/v5.15.4/css/all.css'),
                Css::make('spatie-markdown-editor', __DIR__.'/../resources/css/editor.css')
            ]);
        } else {
            Filament::registerScripts([
                'spatie-markdown-editor' => __DIR__.'/../resources/dist/editor.js',
            ], true);

            Filament::registerStyles([
                'https://pro.fontawesome.com/releases/v5.15.4/css/all.css',
                'https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css',
                'spatie-markdown-editor' => __DIR__.'/../resources/css/editor.css',
            ]);
        }
    }
}
