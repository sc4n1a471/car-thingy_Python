"use strict";var g_userInfo={};function GetUserInfo(){return g_userInfo}function SetUserInfo(a){g_userInfo=a}var g_SessionValues={};function SetSessionValue(a,b){g_SessionValues[a]=JSON.parse(JSON.stringify(b))}function IncludeSessionValue(a,b){if(!(a in g_SessionValues)){g_SessionValues[a]=b}}var g_webStorage=[];function WebStorage_set(b,a,c){a+=g_storageTag;if(b){b.setItem(a,c)}else{g_webStorage[a]=c}}function WebStorage_get(d,b,c){var a;c+=g_storageTag;if(d){switch(b){case"CLEAR":d.clear();break;case"GET":return d.getItem(c);case"GET_REMOVE":a=d.getItem(c);d.removeItem(c);return a;case"REMOVE":d.removeItem(c);break}}else{switch(b){case"CLEAR":g_webStorage=[];break;case"GET":return g_webStorage[c];case"GET_REMOVE":a=g_webStorage[c];delete g_webStorage[c];return a;case"REMOVE":delete g_webStorage[c];break}}}var g_FrameLoaded={};function GetIFrameLoaded(a){return g_FrameLoaded[a]}function SetFrameLoaded(b,c,a){g_FrameLoaded[b]=a||c||""}function DoSetFrame(g,e,b,a,c){if(g){var d=g.indexOf("/")>=0;if(b&&d){e.contentWindow.location.replace(g+(c?(g.indexOf("?")>=0?"&":"?")+$.param(c):""))}else{var f="?page_"+(b?"name":"id")+"="+g+"&panel="+e.id+(c?"&"+$.param(c):"");SetFrameLoaded(e.id,g,a);if(f!=decodeURI(e.contentWindow.location.search)){e.contentWindow.location.replace("../snut/get_page.php"+f+"#")}else{e.contentWindow.location.reload(true)}}}else{e.contentWindow.location.replace("about:blank")}}var g_original_userInfo,g_original_SessionValues;function BackupSessionData(){g_original_userInfo=JSON.stringify(g_userInfo);g_original_SessionValues=JSON.stringify(g_SessionValues)}function RestoreSessionData(){g_userInfo=JSON.parse(g_original_userInfo);g_SessionValues=JSON.parse(g_original_SessionValues)}function PlainTextOfValue(a){return typeof a==="string"?a.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;"):a}function RenderDatatableCell(a,e,d,g,c,f){var b;switch(a){case"text":default:b=RenderDatatableCellText(e);break;case"bool":b='<img src="get_image.php?img='+(e?"213":"212")+'" class="snap-checkbox-'+(e?"on":"off")+'">';break;case"image":if(typeof e==="number"){e+=""}b='<img class="'+d+(g=="justify"?" align-center":"")+'"'+(typeof e==="string"&&e.match(/^[0-9]+$/)?' src="get_image.php?img='+e+'"':"")+">";break;case"button":b='<button class="ui-btn ui-corner-all '+d+(g=="justify"?" btn-block":"")+'">'+PlainTextOfValue(e)+"</button>";break;case"zulu_to_local_dt":b=e?(new Date(e)).toLocaleString():"";break;case"zulu_to_local_date":b=e?(new Date(e)).toLocaleDateString():"";break;case"zulu_to_local_time":b=e?(new Date(e)).toLocaleTimeString():"";break}if(c&&(c.is(".snap-card-table-sm")||c.is(".snap-card-table-md")||c.is(".snap-card-table-lg")||c.is(".snap-card-table-xl"))){b="<label>"+c.DataTable().column(f).header().innerHTML+"</label>"+(b==null?"":b)}return b}var g_previousState=window.location.hash.replace(/^#/,"");window.onhashchange=function(){var a=window.location.hash.replace(/^#/,"");$("iframe").each(function(c,d){var b=d.contentWindow;if(b&&b.ShowSubpage){b.ShowSubpage(a.replace(/,.*$/,""))}if(b&&b.$){b.$("body").trigger("hashchange",[g_previousState,a])}});g_previousState=a};var g_ServerClockDifference=0;function GetServerDatetime(){return new Date((new Date()).getTime()-g_ServerClockDifference)}var g_UseHistory=0;
var g_assertMode = "error";
var g_AlertOnError = false;
var g_sendErrorsToServer = false;
var g_defaultLanguage = "hu";
var g_Localization = {"en":{"COLLATOR_LOCALE":"en_US","REQUIRED_FIELD":"This is a required field!","NUMBER_INPUT_INVALID":"Invalid value. Value must be between {min} and {max}.","PERIODS":["AM","PM"],"MONTH_LONG_NAMES":["January","February","March","April","May","June","July","August","September","October","November","December"],"MONTH_SHORT_NAMES":["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"],"DAY_LONG_NAMES":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"DAY_SHORT_NAMES":["SUN","MON","TUE","WED","THU","FRI","SAT"],"PROCESS_NOT_AUTHORIZED_TITLE":"","PROCESS_NOT_AUTHORIZED_CONTENT":"","PROCESS_NOT_AUTHORIZED_BUTTON":"","LAYOUT_SEARCH":"Search in the list","LAYOUT_PREV_PAGE":"Jump to previous page","LAYOUT_NEXT_PAGE":"Jump to next page","LAYOUT_CURRENT_PAGE":"This is the current page","LAYOUT_PAGE_NO":"Jump to page number #","SELECTMENU_PLACEHOLDER":"Nothing selected","SELECTMENU_NO_RESULTS":"No results matched {0}","CAL_PREV_BUTTON":"Jump to the previous page in the calendar","CAL_NEXT_BUTTON":"Jump to the next page in the calendar","CAL_TODAY_BUTTON":"Jump to the page of today in the calendar","CAL_MONTH_BUTTON":"Switch to monthly view in the calendar","CAL_WEEK_BUTTON":"Switch to weekly view in the calendar","CAL_DAY_BUTTON":"Switch to daily view in the calendar","CAL_LIST_BUTTON":"Switch to list view in the calendar"},"hu":{"COLLATOR_LOCALE":"hu_HU","REQUIRED_FIELD":"K\u00f6telez\u0151 kit\u00f6lteni!","NUMBER_INPUT_INVALID":"Nem megfelel\u0151 \u00e9rt\u00e9k. Az \u00e9rt\u00e9knek {min} \u00e9s {max} k\u00f6z\u00f6tt kell lennie!","PERIODS":["de.","du."],"MONTH_LONG_NAMES":["janu\u00e1r","febru\u00e1r","m\u00e1rcius","\u00e1prilis","m\u00e1jus","j\u00fanius","j\u00falius","augusztus","szeptember","okt\u00f3ber","november","december"],"MONTH_SHORT_NAMES":["jan","febr","m\u00e1rc","\u00e1pr","m\u00e1j","j\u00fan","j\u00fal","aug","szept","okt","nov","dec"],"DAY_LONG_NAMES":["vas\u00e1rnap","h\u00e9tf\u0151","kedd","szerda","cs\u00fct\u00f6rt\u00f6k","p\u00e9ntek","szombat"],"DAY_SHORT_NAMES":["V","H","K","Sze","Cs","P","Szo"],"PROCESS_NOT_AUTHORIZED_TITLE":"","PROCESS_NOT_AUTHORIZED_CONTENT":"","PROCESS_NOT_AUTHORIZED_BUTTON":"","LAYOUT_SEARCH":"Keres\u00e9s a list\u00e1ban","LAYOUT_PREV_PAGE":"Ugr\u00e1s az el\u0151z\u0151 oldalra","LAYOUT_NEXT_PAGE":"Ugr\u00e1s a k\u00f6vetkez\u0151 oldalra","LAYOUT_CURRENT_PAGE":"Az aktu\u00e1lis oldal","LAYOUT_PAGE_NO":"Ugr\u00e1s az # sz\u00e1m\u00fa oldalra","DATETIMEPICKER_TOOLTIPS":{"today":"Ugr\u00e1s m\u00e1ra","clear":"T\u00f6rl\u00e9s","close":"Bez\u00e1r\u00e1s","selectMonth":"H\u00f3nap kiv\u00e1laszt\u00e1sa","prevMonth":"El\u0151z\u0151 h\u00f3nap","nextMonth":"K\u00f6vetkez\u0151 h\u00f3nap","selectYear":"\u00c9v kiv\u00e1laszt\u00e1sa","prevYear":"El\u0151z\u0151 \u00e9v","nextYear":"K\u00f6vetkez\u0151 \u00e9v","selectDecade":"\u00c9vtized kiv\u00e1laszt\u00e1sa","prevDecade":"El\u0151z\u0151 \u00e9vtized","nextDecade":"K\u00f6vetkez\u0151 \u00e9vtized","prevCentury":"El\u0151z\u0151 \u00e9vsz\u00e1zad","nextCentury":"K\u00f6vetkez\u0151 \u00e9vsz\u00e1zad","pickHour":"\u00d3ra kiv\u00e1laszt\u00e1sa","incrementHour":"\u00d3ra n\u00f6vel\u00e9se","decrementHour":"\u00d3ra cs\u00f6kkent\u00e9se","pickMinute":"Perc kiv\u00e1laszt\u00e1sa","incrementMinute":"Perc n\u00f6vel\u00e9se","decrementMinute":"Perc cs\u00f6kkent\u00e9se","pickSecond":"M\u00e1sodperc kiv\u00e1laszt\u00e1sa","incrementSecond":"M\u00e1sodperc n\u00f6vel\u00e9se","decrementSecond":"M\u00e1sodperc cs\u00f6kkent\u00e9se","togglePeriod":"Id\u0151szak v\u00e1lt\u00e1sa","selectTime":"Id\u0151 kiv\u00e1laszt\u00e1sa"},"SELECTMENU_PLACEHOLDER":"K\u00e9rem v\u00e1lasszon","SELECTMENU_NO_RESULTS":"Nincs tal\u00e1lat","CAL_PREV_BUTTON":"Ugr\u00e1s az el\u0151z\u0151 oldalra a napt\u00e1rban","CAL_NEXT_BUTTON":"Ugr\u00e1s az k\u00f6vetkez\u0151 oldalra a napt\u00e1rban","CAL_TODAY_BUTTON":"Ugr\u00e1s a mai naphoz a napt\u00e1rban","CAL_MONTH_BUTTON":"Havi n\u00e9zetre v\u00e1lt\u00e1s a napt\u00e1rban","CAL_WEEK_BUTTON":"Heti n\u00e9zetre v\u00e1lt\u00e1s a napt\u00e1rban","CAL_DAY_BUTTON":"Napi n\u00e9zetre v\u00e1lt\u00e1s a napt\u00e1rban","CAL_LIST_BUTTON":"Lista n\u00e9zetre v\u00e1lt\u00e1s a napt\u00e1rban"}};
var g_log_load_times = false;
var g_sys_home = "155";
var g_sys_item_properties_dialog = "171";
g_UseHistory = 2;
var g_IndexTitle = "\u00dcgyint\u00e9z\u00e9s szabadon";
var g_storageTag = "";
var g_secureToken = "YL56hiFp4BCbAw3GTy_EMYThFwcvsjzW";

var cAnyoneGroupID = "194";
var cGuestGroupID = "191";
var cTimeoutLogoutPageID = "7129991075114268";
var cTimeoutWarningPageID = "7452147826548564";
var cClientTimeout = 600;
var cTimeoutWarningBefore = 60;

var g__sys_test_report_page_ID = "900";
var g__sys_test_results_value_ID = "909";

function GetSessionValue(aValueID) {
	switch (aValueID) {
	case '400':
		return "SNAP 3.1 built at 2022-07-20 10:57:22 CEST";
	case '402':
		return [];
	case '404':
		return g_Localization[document.getElementsByTagName('html')[0].getAttribute('lang') || g_defaultLanguage || 'en'];
	case '406':
		return window.location.hostname;
	case '410':
		return "3";
	case '420':
		return {"1":{"version":"1","path":"repo01","notes":"Version 2.1","released":false,"name":"2.1.0"},"2":{"version":"1","path":"repo02","notes":"Version 2.2\nCodeMirror 2019 may.","released":false,"name":"2.2.0"},"3":{"version":"1","path":"repo03","notes":"Version 3.1\nBlockly 2020 summer.\nEditors lock the edited item.\nHistory of the item is saved and can be reverted.\nItem description and save comments.\nRoles.\n","released":false,"name":"3.1.0"}};
	case '143':
		return false;
	default:
		g_SessionValues = JSON.parse(JSON.stringify(g_SessionValues));
		return g_SessionValues[aValueID];
	}
}

function SetWindowOnError(aWindow)
{
}

function DoConsoleLog(aTitle, aData) {
}

function DoConsoleTable(aTitle, aData, aColumns) {
}

g_userInfo = {"user_id":0,"user_name":"VbeeNRKaIyG8COKYpldl6g==","groups":["7104536905148071","194","191"],"groupnames":["szuf_user_tsz_group","_sys_anyone_group","_sys_guest_group"],"values":{"tsz4T":{"viseltNev":{"vezetekNev":"TERHES","keresztNev":"MARTIN"},"szuletesiNev":{"vezetekNev":"TERHES","keresztNev":"MARTIN"},"anyjaNeve":{"vezetekNev":"KIR\u00c1LY","keresztNev":"KORN\u00c9LIA"},"szuletesiHely":"SZEGED","szuletesiDatum":"2001-09-12","nem":"1"},"tsz4T_XML":"<SzemelyLakcimAdatok xmlns:ns2=\"http:\/\/kekkh.gov.hu\/ulx\/tuap\/onyp\/types\/v1\"><ns2:SzemelyAdat><ns2:Nevek><ns2:ViseltNev><ns2:NevJelzo>V<\/ns2:NevJelzo><ns2:BontottNev><ns2:VezNev>TERHES<\/ns2:VezNev><ns2:UtoNev>MARTIN<\/ns2:UtoNev><\/ns2:BontottNev><\/ns2:ViseltNev><ns2:SzuletesiNev><ns2:NevJelzo>S<\/ns2:NevJelzo><ns2:BontottNev><ns2:VezNev>TERHES<\/ns2:VezNev><ns2:UtoNev>MARTIN<\/ns2:UtoNev><\/ns2:BontottNev><\/ns2:SzuletesiNev><\/ns2:Nevek><ns2:Anyaneve><ns2:NevJelzo>S<\/ns2:NevJelzo><ns2:BontottNev><ns2:VezNev>KIR\u00c1LY<\/ns2:VezNev><ns2:UtoNev>KORN\u00c9LIA<\/ns2:UtoNev><\/ns2:BontottNev><\/ns2:Anyaneve><ns2:SzuletesiIdo><ns2:SzulDatum>2001-09-12<\/ns2:SzulDatum><\/ns2:SzuletesiIdo><ns2:SzuletesiHely><ns2:Szulhely1>SZEGED<\/ns2:Szulhely1><ns2:Szulhely2><\/ns2:Szulhely2><\/ns2:SzuletesiHely><ns2:Nem>1<\/ns2:Nem><\/ns2:SzemelyAdat><\/SzemelyLakcimAdatok>","audiences":["urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"],"level":1,"viseltNevTotal":"TERHES MARTIN","szuletesiNevTotal":"TERHES MARTIN","anyjaNeveTotal":"KIR\u00c1LY KORN\u00c9LIA"},"full_name":"TERHES MARTIN"};

g_ServerClockDifference = (new Date()).getTime() - 1682600007302.5;

var g_tabId = "0FoEN3S4WonTW-5snFiXDA";

function RenderDatatableCellText(aValue) {
	return PlainTextOfValue(aValue);
}

var g_PushPublicKey = null;
var g_WindowTitlePrefix = "";
