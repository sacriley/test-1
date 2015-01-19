<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//後台顯示之功能
$admin['ac_father_online'] = array(
	'service', 'marketing', 'server', 'flow', 'database',
	'websiteset', 'webcontent', 'note', 'activity', 'showroom', 'brand', 'pic','ad'
);
$admin['sidebox_display_array'] = array('fanswoo', 'websiteset');//此值為預設顯示之大分類
$admin['ac_father_display'] = 'hidden';//此值若為display則會顯示不能使用之功能

$admin['admin_sidebox'] = array(
	array(
		'title' => '網站系統',
		'name' => 'websiteset',
		'ac_father' => array(
			array(
				'title' => '網站設置', 'name' => 'websiteset',
				'ac_child' => array(
					array('title' => '基本設置', 'name' => 'set'),
					array('title' => 'SEO標籤設置', 'name' => 'seometa'),
					array('title' => '第三方外掛', 'name' => 'plugin')
				)
			),
			array(
				'title' => '內容管理', 'name' => 'webcontent',
				'ac_child' => array(
					array('title' => '首頁內容', 'name' => 'home'),
					array('title' => '品牌故事', 'name' => 'story')
				)
			),
			array(
				'title' => '文章管理', 'name' => 'note',
				'ac_child' => array(
					array('title' => '新增文章', 'name' => 'postnote'),
					array('title' => '文章列表', 'name' => 'notelist'),
					array('title' => '新增分類標籤', 'name' => 'postclass'),
					array('title' => '分類標籤列表', 'name' => 'classlist')
				)
			),
			array(
				'title' => '活動管理', 'name' => 'activity',
				'ac_child' => array(
					array('title' => '新增活動', 'name' => 'postactivity'),
					array('title' => '活動列表', 'name' => 'activitylist'),
					array('title' => '新增活動標籤', 'name' => 'postclass'),
					array('title' => '活動標籤列表', 'name' => 'classlist')
				)
			),
			array(
				'title' => '廣告管理', 'name' => 'ad',
				'ac_child' => array(
					array('title' => '新增廣告', 'name' => 'postad'),
					array('title' => '廣告列表', 'name' => 'adlist')
				)
			),
			array(
				'title' => '照片管理', 'name' => 'pic',
				'ac_child' => array(
					array('title' => '新增照片', 'name' => 'postpic'),
					array('title' => '照片列表', 'name' => 'piclist')
				)
			),
			array(
				'title' => '展示藝廊', 'name' => 'showroom',
				'ac_child' => array(
					array('title' => '新增展示藝廊', 'name' => 'postshowroom'),
					array('title' => '新增風格分類', 'name' => 'poststyleclass'),
					array('title' => '新增房間分類', 'name' => 'postroomclass'),
					array('title' => '展示藝廊列表列表', 'name' => 'showroomlist'),
					array('title' => '風格分類列表', 'name' => 'styleclasslist'),
					array('title' => '房間分類列表', 'name' => 'roomclasslist')
				)
			),
			array(
				'title' => '品牌管理', 'name' => 'brand',
				'ac_child' => array(
					array('title' => '新增品牌', 'name' => 'postbrand'),
					array('title' => '新增品牌分類', 'name' => 'postclass'),
					array('title' => '品牌列表', 'name' => 'brandlist'),
					array('title' => '品牌分類列表', 'name' => 'classlist')
				)
			),
			array(
				'title' => '商品展示', 'name' => 'showpiece',
				'ac_child' => array(
					array('title' => '新增展示品', 'name' => 'postshowpiece'),
					array('title' => '新增分類', 'name' => 'postmeta'),
					array('title' => '展示品列表', 'name' => 'showpiecelist'),
					array('title' => '分類列表', 'name' => 'metalist'),
					array('title' => '展示品設置', 'name' => 'set')
				)
			),
			array(
				'title' => '聯繫單', 'name' => 'contact',
				'ac_child' => array(
					array('title' => '聯繫單列表', 'name' => 'contactlist'),
					array('title' => '聯繫單設置', 'name' => 'set')
				)
			),
			array(
				'title' => '留言管理', 'name' => 'comment',
				'ac_child' => array(
					array('title' => '留言列表', 'name' => 'commentlist'),
					array('title' => '留言設置', 'name' => 'set')
				)
			),
			array(
				'title' => '會員管理', 'name' => 'showpiece',
				'ac_child' => array(
					array('title' => '新增會員', 'name' => 'postuser'),
					array('title' => '會員列表', 'name' => 'userlist'),
					array('title' => '會員權限列表', 'name' => 'competencelist'),
					array('title' => '會員設置', 'name' => 'set')
				)
			),
			array(
				'title' => '電子報', 'name' => 'email',
				'ac_child' => array(
					array('title' => '新增電子報', 'name' => 'postemail'),
					array('title' => '電子報列表', 'name' => 'emaillist'),
					array('title' => '發送名單列表', 'name' => 'sendlist'),
					array('title' => '電子報設置', 'name' => 'set')
				)
			),
			array(
				'title' => '動態頁面', 'name' => 'pabe',
				'ac_child' => array(
					array('title' => '新增動態頁面', 'name' => 'postpage'),
					array('title' => '動態頁面列表', 'name' => 'pagelist'),
					array('title' => '動態頁面設置', 'name' => 'set')
				)
			),
			array(
				'title' => '廣告系統', 'name' => 'advertisement',
				'ac_child' => array(
					array('title' => '新增廣告', 'name' => 'postad'),
					array('title' => '廣告列表', 'name' => 'adlist'),
					array('title' => '廣告設置', 'name' => 'set')
				)
			)
		)
	),
	array(
		'title' => '購物系統',
		'name' => 'shop',
		'ac_father' => array(
			array(
				'title' => '商店設置', 'name' => 'shop',
				'ac_child' => array(
					array('title' => '基本設置', 'name' => 'postproduct')
				)
			),
			array(
				'title' => '產品銷售', 'name' => 'productsell',
				'ac_child' => array(
					array('title' => '新增產品', 'name' => 'postproduct'),
					array('title' => '產品列表', 'name' => 'productlist'),
					array('title' => '產品設置', 'name' => 'set')
				)
			),
			array(
				'title' => '產品租賃', 'name' => 'productlease',
				'ac_child' => array(
					array('title' => '新增產品', 'name' => 'postproduct'),
					array('title' => '產品列表', 'name' => 'productlist'),
					array('title' => '產品設置', 'name' => 'set')
				)
			),
			array(
				'title' => '訂貨單', 'name' => 'orders',
				'ac_child' => array(
					array('title' => '新增訂貨單', 'name' => 'postproduct'),
					array('title' => '訂貨單列表', 'name' => 'productlist'),
				)
			),
			array(
				'title' => '退貨單', 'name' => 'returnsingle',
				'ac_child' => array(
					array('title' => '新增退貨單', 'name' => 'postproduct'),
					array('title' => '退貨單列表', 'name' => 'productlist'),
				)
			)
		)
	),
	array(
		'title' => '進銷存系統',
		'name' => 'invoicing',
		'ac_father' => array(
			array(
				'title' => '綜合報表', 'name' => 'reportform',
				'ac_child' => array(
					array('title' => '毛利分析', 'name' => 'mysql'),
					array('title' => '銷售分析', 'name' => 'mysql')
				)
			),
			array(
				'title' => '進貨管理', 'name' => 'goods',
				'ac_child' => array(
					array('title' => '新增進貨', 'name' => 'index'),
					array('title' => '進貨列表', 'name' => 'fanswoo')
				)
			),
			array(
				'title' => '庫存管理', 'name' => 'instock',
				'ac_child' => array(
					array('title' => '新增庫存', 'name' => 'googleadwords'),
					array('title' => '庫存列表', 'name' => 'facebookfans')
				)
			),
			array(
				'title' => '銷售管理', 'name' => 'goodssell',
				'ac_child' => array(
					array('title' => '新增銷售', 'name' => 'host'),
					array('title' => '銷售列表', 'name' => 'cloud')
				)
			)
		)
	),
	array(
		'title' => '財務管理系統',
		'name' => 'financial',
		'ac_father' => array(
			array(
				'title' => '財務報表', 'name' => 'financial',
				'ac_child' => array(
					array('title' => '財務報表', 'name' => 'mysql')
				)
			),
			array(
				'title' => '收入管理', 'name' => 'g1',
				'ac_child' => array(
					array('title' => '新增收入', 'name' => 'mysql'),
					array('title' => '收入列表', 'name' => 'mysql')
				)
			),
			array(
				'title' => '支出管理', 'name' => 'g2',
				'ac_child' => array(
					array('title' => '新增支出', 'name' => 'mysql'),
					array('title' => '支出列表', 'name' => 'mysql')
				)
			),
			array(
				'title' => '薪資管理', 'name' => 'salary',
				'ac_child' => array(
					array('title' => '新增薪資', 'name' => 'index'),
					array('title' => '薪資列表', 'name' => 'fanswoo')
				)
			),
			array(
				'title' => '員工管理', 'name' => 'staff',
				'ac_child' => array(
					array('title' => '新增員工', 'name' => 'googleadwords'),
					array('title' => '員工列表', 'name' => 'facebookfans'),
					array('title' => '階級列表', 'name' => 'facebookfans')
				)
			)
		)
	)
);