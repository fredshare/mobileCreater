<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="utf-8" />
	<title>无线端营销系统</title>
	<link rel="stylesheet" href="/mobile/web/css/jquery-ui.css" />
	<link rel="stylesheet" href="/mobile/web/css/bootstrap.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/mobile/web/css/codemirror.css">
	<link rel="stylesheet" href="/mobile/web/css/monokai.css">
	<script src="/mobile/web/js/jquery-1.9.1.js"></script>
	<script src="/mobile/web/js/jquery-ui.js"></script>
	<script src="/mobile/web/js/jquery.cookie.js"></script>
	<script src="/mobile/web/js/bootstrap.min.js"></script>
	<script src="/mobile/web/js/codemirror.js"></script>
	<script src="/mobile/web/js/codemirror-javascript.js"></script>
	<script src="/mobile/web/js/loadmode.js"></script>
	<script src="/mobile/web/js/matchbrackets.js"></script>
  	<script src="/mobile/web/js/continuecomment.js"></script>
</head>
<style>
	body{font-family: \5FAE\8F6F\96C5\9ED1}
	.navbar-inverse .navbar-search .search-query{padding: 5px 10px;}
	.bs-docs-sidenav {
		width: 228px;
		margin: 0px 0 0;
		padding: 0;
		background-color: #fff;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		border-radius: 6px;
		-webkit-box-shadow: 0 1px 4px rgba(0,0,0,.065);
		-moz-box-shadow: 0 1px 4px rgba(0,0,0,.065);
		box-shadow: 0 1px 4px rgba(0,0,0,.065);
	}
	.bs-docs-sidenav > li:first-child > a {
		-webkit-border-radius: 6px 6px 0 0;
		-moz-border-radius: 6px 6px 0 0;
		border-radius: 6px 6px 0 0;
	}
	.bs-docs-sidenav > .active > a {
		position: relative;
		z-index: 2;
		padding: 9px 15px;
		border: 0;
		text-shadow: 0 1px 0 rgba(0,0,0,.15);
		-webkit-box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
		-moz-box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
		box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
	}
	.bs-docs-sidenav > li > a {
		display: block;
		width: 190px 9;
		margin: 0 0 -1px;
		padding: 8px 14px;
		border: 1px solid #e5e5e5;
	}
	.pages {
		float: right;
		padding: 15px 20px;
		height: 27px;
	}
	.pages a,.pages strong{
		float: left;
		color: #666;
		text-align: center;
		border: 1px solid #E6E6E6;
		margin-left: -1px;
		padding: 0 10px;
		height: 25px;
		line-height: 25px;
		display: inline;
	}
	.menu_box{left: 11986px; top: 38px;position: absolute;z-index: 99;border: 1px solid #979797;box-shadow: 2px 2px 2px #8E8E8E;min-width: 216px;}
	.menu_li{display: block;height: 22px;position: relative;text-decoration:none;}
	.menu_li a{text-decoration:none;}
	/*add NEW popup*/
	.popup{display:none;position:absolute;left:50%;top:20%;z-index:99;background:#fff;margin-left:-250px;width:580px;border:2px solid #ddd;padding-top: 2px;}
	.popup .nav li{margin:0 2px -1px 2px;}
	.popup .tab-pane{padding: 6px;}
	.popup .att{display: block;height:30px;line-height: 30px;float: left;width:180px;text-align: right;}

	.view{margin-bottom: 10px;}
	.popup .cls{width:14px;height:14px;position: absolute;top:10px;right:10px;opacity: 0.5;filter:alpha(opacity=50);}
	.popup .cls:hover{opacity: 0.9;filter:alpha(opacity=90);}
	.cover-zhezhao{display:none;width:100%;height:150%;background: #333;opacity: 0.8;filter:alpha(opacity=50);position: absolute;top:0;left:0;z-index: 9}

	.ui-state-highlight2 { border: 1px dotted black; visibility: visible !important; height: 80px !important;width:180px; }
	.att{margin-bottom:0px }
	.template{background-color:#46bbcf;padding:10px;cursor: pointer;margin-bottom: 10px; text-align: center;}
	.template:hover,.template.cur{background-color:#2c9fb3;}
	.template span{vertical-align: middle; line-height: 1.5em; color: #FFF;}
	.bu{margin-bottom: 10px;}
	.bu h2{font-size: 16px; cursor: pointer; margin: 0; line-height: 34px;font-weight: 300; margin-top: 0; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAIzSURBVEhLtZYhSENRFIb3HgaDwWA0LAgaBBcMggu2DTQYFwwG44JBsE6MBpOwIhO0iahYJgoqBoNhFjEqaDAIBsOCsvn99509mXub080f/t33/nPuOfedd+7d82ItUK1W++AslykYh4PSwTN8gsee5x3AF6dGIDKBAjMsMS4zKpCC3DI+QNmVaBjOwFGYx77SKlGISqUyDh+NaZObAp8JeAdff/THIQPLsMAq+03+Efj2MmfN5i6aXA8MWrkc5kz6NUg0xfx3qNJ9AUMfokpSMOnPIFaOOG+w1hCh+MjYtCzY5mENOZMbgK2HWKVwsQhavUrT8gXh11YCAXuCeCrVkM+N+vzJ9/1iYO4ctOsNwznM+PxoEx3AbuMQpjwe45KMm3Ar0APwZPN26cD9JD4Ldq2NpwAhIuZPwW21571uTA+B9ivYtBBIcekqUQ/8cOo/QCW6YtzgJe8EUgCS13UK92OUQQ2h63OuL5zBwP13/yTcVYl24arpTYFz220qEHMBXqtEx7B+a3cH07Do82hq0VGyjTu5C+AJ9d+RJvaeEugMz8NtDL1y6BTE0TFxSmxtOCcM8AQ6z9ec0AGIkYXvxBwxKQBiGpYxNOyJdqGgxNBJ6jZkAzAsQWXPQe2PtsE8rVzB102KBg4z5lgiScLkpsAnju8Z1OkZvfLvwHEQFqCO8ROYJZDOFm1/MYmmPt83nyO0+pobWn62MHGIIQPdZwtd4f6lCFb7bCmqFcNuaUAs9glLFQdwvFGvGQAAAABJRU5ErkJggg%3D%3D); background-position: 5px 5px; background-repeat: no-repeat; background-color: #666; color: #FFF; height: 36px;padding-left: 36px;}
	.bu .bd{ padding: 10px 5px 0; display: none;}
	.show .bd{display: block; border: 1px dotted #CCC; margin-top: 5px;}
	.show h2{background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHpSURBVEhLtZavT8JRFMXBGQgEg5FAYNNgIBAMBhpsEowEIpFgYLMYMBsMFht/gRNHgRn8EzDoCBY2CAQ3g4GAAz/ncUW+ym++nu3swnn3nfu47/se32BgDobDYRie8DEFozAiHXRhB9aDwWAFvjl1CqYWkDGhSDwjykgmL8QW1LgK7cEMPIA3jF/MKzTGYDBIwLYxbfJMkHMIm/B9YT4JWdiDZVa5Y/JCkBtizqXNPTXZCwa0ciXkTFoZFEoyvw/Vuh8wEEZUS8omrQ28Svh8wO8HYiy2iUu3ZRbw2MarMV6srV6tWbihywLPOH5qVUy9z8FXG/MNeD7A8y0+6xBVnOov7mFKBaJ2iHwFns+EqApot90JnQR9XAk2bRItikRUYBt+OukfoAIdFqCLzAOqrwSbNokIvl1XAOri8hWY7xM6KlCH3qPtD45hTZV2eV51KBIjfXOo5fj1iHEn8OUaNhFCTtgQeD3Cqn11FfUrdJ9fmrQ28CjAPp7agx8gpqF+VtKklSFTPHST5k3ygoEiVPUS1PlYGszTymV+ZdJ0kJCxxAZFRps0B+RoQ9VzPSjTV/4bJEZgGeoa161YwCgpM+MRWh7eWU4Vzdtzw9zXFibGCFnoXls4sO5fCrPv15Ya2i18kv4XgcAXTr+7IYi7bgIAAAAASUVORK5CYII%3D); background-color: #333;}
	.bu h2:hover{background-color: #333;}

	.menu-com{position: relative;height:50px;padding:15px;cursor:move; margin-bottom: 10px; color: #FFF; line-height: 50px; text-align: center; background-color: #9871A6}
	.menu-com .btn-close{color: #FFF; font-size: 14px;display: block; position: absolute; right: 5px; top: 5px; width: 20px; height: 20px; line-height: 20px; font-family: Arial; font-weight: 700;}
	.menu-com .btn-close:hover{background-color: #72507f; color: #FFF; text-decoration: none;}
	.menu-components{margin-bottom:10px;padding:10px;cursor:move;background-color:#94c06b; text-align: center; background-color: #94C06B;}
	.menu-components span{color: #FFF;}
	.menu{height:800px;padding-top:20px;}
	.pre{background-color:f6f6f6;height:;width:381px;padding:117px 0px 120px 31px;overflow:auto;background-image:url('http://ppms.paipaioa.com/img/iphone.png')}
	.iframe{width:320px;height:533px;border:none}
	.oper{background-color:#d8188c;height:48px;margin-bottom:10px;color: #FFF; line-height: 47px; text-align: center; cursor: pointer;}
	.oper:hover{background-color: #be0e78;}

	.lock {
		background: url("http://ppms.paipaioa.com/img/lock.png") 0px 2px no-repeat;
		display: inline-block;
		text-indent: 10px;
		padding: 0px 5px;
		white-space: nowrap;
	}
	.unlock {
		background: url("http://ppms.paipaioa.com/img/lock.png") 0px -15px no-repeat;
		display: inline-block;
		text-indent: 10px;
		padding: 0px 5px;
		white-space: nowrap;
	}
</style>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
  		<div class="navbar-inner">
		    <div class="container">
				<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar">1</span>
					<span class="icon-bar">2</span>
					<span class="icon-bar">3</span>
				</a>
				<ul class="nav">
					<li><a href="/mobile/index.php/mobile/index/1">活动列表</a></li>
					<li><a href="/mobile/index.php/template/templateList">模版管理</a></li>
			    </ul>
				<div class="nav-collapse collapse">
				</div>
				<form class="navbar-search pull-left" action="/mobile/index.php/mobile/search" method="post" onsubmit="return checkSearch()">
					<input type="text" class="search-query" placeholder="Search" name="search" id="search">
					<input type="hidden" class="" placeholder="" name="business" id="business">
					<script type="text/javascript">
						function checkSearch(){
							$("#business").val(location.pathname.split("/")[6]?location.pathname.split("/")[6]:1);
							$("form").attr("action","/mobile/index.php/mobile/search/"+$("#business").val()+"/"+$("#search").val());
							$("form").submit();
						}
						
					</script>
				</form>
			</div>
		</div>
	</div>