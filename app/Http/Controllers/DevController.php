<?php
namespace App\Http\Controllers; use App\System; use Illuminate\Http\Request; use Illuminate\Support\Facades\Log; use Illuminate\Support\Facades\Mail; class DevController extends Controller { private function check_readable_r($sp15ad25) { if (is_dir($sp15ad25)) { if (is_readable($sp15ad25)) { $sp4119b1 = scandir($sp15ad25); foreach ($sp4119b1 as $sp18736a) { if ($sp18736a != '.' && $sp18736a != '..') { if (!self::check_readable_r($sp15ad25 . '/' . $sp18736a)) { return false; } else { continue; } } } echo $sp15ad25 . '   ...... <span style="color: green">R</span><br>'; return true; } else { echo $sp15ad25 . '   ...... <span style="color: red">R</span><br>'; return false; } } else { if (file_exists($sp15ad25)) { return is_readable($sp15ad25); } } echo $sp15ad25 . '   ...... 文件不存在<br>'; return false; } private function check_writable_r($sp15ad25) { if (is_dir($sp15ad25)) { if (is_writable($sp15ad25)) { $sp4119b1 = scandir($sp15ad25); foreach ($sp4119b1 as $sp18736a) { if ($sp18736a != '.' && $sp18736a != '..') { if (!self::check_writable_r($sp15ad25 . '/' . $sp18736a)) { return false; } else { continue; } } } echo $sp15ad25 . '   ...... <span style="color: green">W</span><br>'; return true; } else { echo $sp15ad25 . '   ...... <span style="color: red">W</span><br>'; return false; } } else { if (file_exists($sp15ad25)) { return is_writable($sp15ad25); } } echo $sp15ad25 . '   ...... 文件不存在<br>'; return false; } private function checkPathPermission($sp112ad7) { self::check_readable_r($sp112ad7); self::check_writable_r($sp112ad7); } public function install() { $spa5169d = array(); @ob_start(); self::checkPathPermission(base_path('storage')); self::checkPathPermission(base_path('bootstrap/cache')); $spa5169d['permission'] = @ob_get_clean(); return view('install', array('var' => $spa5169d)); } public function test(Request $spaa0004) { } }