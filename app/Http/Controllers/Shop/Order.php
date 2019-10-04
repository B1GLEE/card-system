<?php
namespace App\Http\Controllers\Shop; use Carbon\Carbon; use Illuminate\Database\Eloquent\Relations\Relation; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use App\Library\Response; use App\Library\Geetest; use Illuminate\Support\Facades\Cookie; class Order extends Controller { function get(Request $spaa0004) { if ((int) \App\System::_get('vcode_shop_search') === 1) { $sp4e109c = Geetest\API::verify($spaa0004->post('geetest_challenge'), $spaa0004->post('geetest_validate'), $spaa0004->post('geetest_seccode')); if (!$sp4e109c) { return Response::fail('系统无法接受您的验证结果，请刷新页面后重试。'); } } $sp3b6564 = \App\Order::where('created_at', '>=', (new Carbon())->addDay(-\App\System::_getInt('order_query_day', 30))); $sp8480f1 = $spaa0004->post('type', ''); if ($sp8480f1 === 'cookie') { $spfed1c8 = Cookie::get('customer'); if (strlen($spfed1c8) !== 32) { return Response::success(); } $sp3b6564->where('customer', $spfed1c8); } elseif ($sp8480f1 === 'order_no') { $spef6915 = $spaa0004->post('order_no', ''); if (strlen($spef6915) !== 19) { return Response::success(); } $sp3b6564->where('order_no', $spef6915); } elseif ($sp8480f1 === 'contact') { $spba1d62 = $spaa0004->post('contact', ''); if (strlen($spba1d62) < 6) { return Response::success(); } $sp3b6564->where('contact', $spba1d62); } else { return Response::fail('请选择查询类型'); } $sp25ff1b = array('id', 'created_at', 'order_no', 'contact', 'status', 'send_status', 'count', 'paid'); if (1) { $sp25ff1b[] = 'product_name'; $sp25ff1b[] = 'contact'; $sp25ff1b[] = 'contact_ext'; } $sp94fc94 = $sp3b6564->orderBy('id', 'DESC')->get($sp25ff1b); $sp673a2b = ''; return Response::success(array('list' => $sp94fc94, 'msg' => count($sp94fc94) ? $sp673a2b : '')); } }