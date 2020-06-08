// JavaScript Document
$(document).ready(function(e) {
    $(".mainmu").mouseover(
		function()
		{
			$(this).children(".mw").stop().show()
		}
	)
	$(".mainmu").mouseout(
		function ()
		{
			$(this).children(".mw").hide()
		}
	)
});
function lo(x)
{
	location.replace(x)
}
function op(x,y,url)
{
	// $(裡面放的是[選擇器])...如果x存在的話執行fadeIn(),如果y存在的話也執行fadeIn(),如果y和url都存在的話就載入url
	$(x).fadeIn()
	if(y)
	$(y).fadeIn()
	if(y&&url)
	// 用GET傳資料的
	$(y).load(url)
}
function cl(x)
{
	$(x).fadeOut();
}