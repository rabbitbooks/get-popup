<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use App\Services\UrlService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GeneratorController extends Controller
{
    public function makePreloader(Popup $popup)
    {
        $host = UrlService::getHostWithHttp();
        $directory = 'popups/' . Str::random(15);
        $contents = ";(function () {
        let script = document.createElement('script');
        const now = new Date();
        script.src = '{$host}/storage/{$directory}/gp-popup.js?' + now.getTime();
        document.body.appendChild(script);
        })();";

        Storage::disk('public')->put($directory . '/gp-preloader.js', $contents);

        return "{$directory}";
    }

    public function makeScript(Popup $popup, $path)
    {
        $is_enabled = $popup->is_enabled ? 1 : 0;
        $host = UrlService::getHostWithHttp();
        $popupData = ";(function () {
        const variables = {
            text: '{$popup->text}',
            popup_id: {$popup->id},
            is_enabled: {$is_enabled},
            host: '{$host}',
        };";

        $js_template = Storage::disk('local')->get('js_templates/template.js');
        Storage::disk('public')->put($path . '/gp-popup.js', $js_template);
        Storage::disk('public')->prepend($path . '/gp-popup.js', $popupData);
    }

    public function deleteScript($path)
    {
        Storage::disk('public')->delete($path . '/gp-popup.js');
    }
}
