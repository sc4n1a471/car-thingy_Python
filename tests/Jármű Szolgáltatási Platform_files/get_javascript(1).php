//hamburger menu
var menuButton = function() {
  if(window.orientation === undefined){
    $('.menu-button').css('display',(window.top.innerWidth < 769 ? 'inline-block' : 'none') );
    /* $('#Navbar_nav').css('display',(window.top.innerWidth < 769 ? 'none' : 'block') ); */
    $('#fooldal_szuf_logo').css('display',(window.top.innerWidth < 900 ? 'none' : 'block') );
    $('#SZUF').css('display',(window.top.innerWidth < 769 ? 'none' : 'block') );
    $('#SZUF-SM').css('display',(window.top.innerWidth < 769 ? 'block' : 'none') );
    (window.top.innerWidth < 769 ? $('.nav-container').addClass('nav-container-blue') : $('.nav-container').removeClass('nav-container-blue'));
  }
  else {
    if(window.orientation === 90 || window.orientation === -90){
      $('.menu-button').css('display',(screen.height < 769 ? 'inline-block' : 'none') );
      /* $('#Navbar_nav').css('display',(screen.height < 769 ? 'none' : 'block') ); */
      $('#fooldal_szuf_logo').css('display',(window.top.innerWidth < 900 ? 'none' : 'block') );
      $('#SZUF').css('display',(screen.height < 769 ? 'none' : 'block') );
      $('#SZUF-SM').css('display',(screen.height < 769 ? 'block' : 'none') );
      (screen.height  < 769 ? $('.nav-container').addClass('nav-container-blue') : $('.nav-container').removeClass('nav-container-blue'));
    }
    else {
      $('.menu-button').css('display',(screen.width < 769 ? 'inline-block' : 'none') );
      /* $('#Navbar_nav').css('display',(screen.width < 769 ? 'none' : 'block') ); */
      $('#fooldal_szuf_logo').css('display',(window.top.innerWidth < 900 ? 'none' : 'block') );
      $('#SZUF').css('display',(screen.width < 769 ? 'none' : 'block') );
      $('#SZUF-SM').css('display',(screen.width < 769 ? 'block' : 'none') );
      (screen.width  < 769 ? $('.nav-container').addClass('nav-container-blue') : $('.nav-container').removeClass('nav-container-blue'));
    }
  }
}

/* material input miatt módosítás*/

function materialEmeles(){
  if  (!$("#S_search_div").hasClass('input-focused')) {
      $("#S_search_div").addClass('input-focused');
  }   
    else if (!IsNullOrEmpty(GetControlProp('search', "value"))){
    $("#S_search_div").addClass('input-focused');
  } else {
    if ($("#S_search_div").hasClass('input-focused')) {
      $("#S_search_div").removeClass('input-focused');
    }
  }
}

function material_input_click(){
  if  (!$("#S_search_div").hasClass('input-focused')) {
      $("#S_search_div").addClass('input-focused');
  }   
    else if (!IsNullOrEmpty(GetControlProp('search', "value"))){
    $("#S_search_div").addClass('input-focused');
  } else {
    if ($("#S_search_div").hasClass('input-focused')) {
      $("#S_search_div").removeClass('input-focused');
    }
  }
}


$(document).ready(function(){
  $('body').on('setHeights',function(){
    fixInputLabels();
  })
  
  $('.fixed-material-input, .fixed-material-input-2').each(function(k,elem){
    var aInput = $(elem).find('input');
    var aLabel = $(elem).find('label');
    if(aInput.attr('disabled'))
      $(elem).addClass('input-disabled');
    if(aInput.prop('readonly'))
      $(elem).addClass('input-readonly');
  }
                                 );
  $('.material-input, .material-input-2').each(function(k,elem){
    var aInput = $(elem).find('input');
    var aLabel = $(elem).find('label');
    if(aInput.val() || aInput.attr('placeholder'))
      $(elem).addClass('input-has-value');
    else 
      $(elem).removeClass('input-has-value');
    
    if(aInput.prop('disabled')){
      $(elem).addClass('input-disabled');

    }
    if(aInput.prop('readonly')){
      $(elem).addClass('input-readonly');

    }


    aInput.on('change control_valuechanged dp.change control_change',function(e){
      var _that = this;
      var t = setTimeout(function(){
        if($(_that).val().length != 0)
          $(elem).addClass('input-has-value');
        else 
          $(elem).removeClass('input-has-value');
      }
                         ,30);
    }
             );
    if(!$(this).hasClass('snap-disabled') && !$(this).hasClass('input-readonly')){
    aInput.on('focus',function(e){
      $(this).parent().parent().addClass('input-focused');
    });

    }
    aInput.on('blur',function(e){
      var _that = this;
      var t = setTimeout(function(){
        if($(_that).val().length != 0  || $(_that).attr('placeholder'))
          $(elem).addClass('input-has-value');
        else 
          $(elem).removeClass('input-has-value');
        $(_that).parent().parent().removeClass('input-focused');
      }
                         ,30);
    }
             );
    if(aInput.attr('data-inputmask')){
      aInput.mouseover(function(e){
        $(elem).addClass('input-has-value-mask');
      }
                      );
      aInput.on('mouseout', function(e){
        $(elem).removeClass('input-has-value-mask');
      }
               );
      aLabel.mouseover(function(e){
        $(elem).addClass('input-has-value-mask');
      }
                      );
      aLabel.on('mouseout', function(e){
        $(elem).removeClass('input-has-value-mask');
      }
               );
    }
  }
                           );
  $('select').each(function(){
    $(this).attr('title','');
  }
                  );

 
  var t3 = setTimeout("fixInputLabels()",100);
}
                 )

function fixInputLabels(){
  $('.material-input .form-group.vcenter, .fixed-material-input .form-group.vcenter').each(function(k,elem){
    var aInput = $(elem).find('input');
    var aLabel = $(elem).find('label');
    var aHelp = $(elem).find('a._sys_help');
    if(aInput.is('[maxlength]') && aLabel.width() > aInput.width()){
      aInput.css('max-width',(aLabel.width()+55));
      if(aHelp){
        $(aHelp).css('left',aLabel.width()+65);
      }
    }
  }
                                 );

  $('.fixed-material-input-2 .form-group.vcenter').each(function(k,elem){
    var aInput = $(elem).find('input');
    var aLabel = $(elem).find('label');
    var aHelp = $(elem).find('a._sys_help');
    if(aInput[0]){
      if(aInput.is('[maxlength]') && aLabel.width() > aInput.width()){
        aInput.css('max-width',(aLabel.width()+55));
        if(aHelp){
          $(aHelp).css('left',aLabel.width()+65);
        }
      }
      
    }
  }
                                 )
}








/* material vége*/

function setTitle_SZUF(title)
{
  window.parent.document.title = title;
}
function checkCookie_SZUF(c_name)
{
  var consent = getCookie_SZUF(c_name);
  if (consent == null || consent == "" || consent == undefined) return false;
  else return true;
}
function setCookie_SZUF(c_name,value,exp)
{
  var expdate = new Date();
  expdate.setDate(expdate.getDate() + exp);
  var c_value = escape(value) + ((exp==null) ? "" : "; expires="+expdate.toUTCString());
  document.cookie = c_name + "=" + c_value+"; path=/";
}
function getCookie_SZUF(c_name)
{
  var i,x,y,cookies=document.cookie.split(";");
  for (i=0;i<cookies.length;i++)
  {
    x=cookies[i].substr(0,cookies[i].indexOf("="));
    y=cookies[i].substr(cookies[i].indexOf("=")+1);
    x=x.replace(/^\s+|\s+$/g,"");
    if (x==c_name)
    {
      return unescape(y);
    }
  }
}
function checkIfReferrerISTarhely()
{
  /*var ref = document.referrer;*/
  var ref = window.location.origin;
  //console.log(ref);
  return ref.match("/^https:\/\/tarhely\.(.*)gov\.hu(\/|$)/i");
}
function pushRight(pKep)
{
  var el = document.getElementById(pKep).parentElement;
  if (el) {
    el.className += el.className ? ' col-lg-push-6' : 'col-lg-push-6';
    el.className += ' col-md-push-6 col-sm-push-6';
  }
}
function pullLeft(pSzoveg)
{
  var el = document.getElementById(pSzoveg).parentElement;
  if (el) {
    el.className += el.className ? ' col-lg-pull-6' : 'col-lg-pull-6';
    el.className += ' col-md-pull-6  col-sm-pull-6';
  }
}
function getHostName()
{
  return window.location.hostname;
}
function getTopLocationURLParameter($paramName){
 $ret="";
 var $array=window.top.location.search.replace(/^\?/, '').split('&');
 $paramName=$paramName+'=';
 $.each($array, function(i, item) {
    if(item.startsWith($paramName)){
        $ret=item.substring($paramName.length);
       return false;
    }
 });
// DoConsoleLog("ret", decodeURIComponent($ret));
 return decodeURIComponent($ret);
}
function checkCTIN(ctin) {
  ctin = ctin.substr(0, 8);
  cdv = String((parseInt(ctin[0]) * 9 + parseInt(ctin[1]) * 7 + parseInt(ctin[2]) * 3 + parseInt(ctin[3]) * 1 + parseInt(ctin[4]) * 9 + parseInt(ctin[5]) * 7 + parseInt(ctin[6]) * 3));
  return ((10 - cdv[cdv.length - 1])) == ctin[7];
} 
//function for validate file size 
var maxSize = '20971520';
function fileSizeValidate(fdata) {
  if (fdata && fdata[0]) {
    var fsize = fdata[0].size;
    if (fsize > maxSize) return false;
    else return true;
  }
}
function removeHTMLTags(pHTMLCode) {
  return pHTMLCode.replace(/<("[^"]*"|'[^']*'|[^'">])*>/gi, '').replace(/^\s+|\s+$/g, '');
}
function removeHTMLEntities(pText) {
  return pText.replace(/&[a-z]+;/gi, '#');
}

window.addEventListener("resize", menuButton);
$(function(){
  $(window.top.document).find('#navbutton').css('visibility','hidden');
  menuButton();
}
); 
function setupSearch() {
  document.getElementById("search").addEventListener("focus", myFocusFunction, true);
  document.getElementById("search").addEventListener("blur", myBlurFunction, true);
  $("#search").on("input", javaslatok_adasa);
}
function adjustSearchSuggestions() {
  $('#javaslatok li').on('click', function() {
    var $this = $(this);
    var s = $this.find('p').text();
    $('#search').val(s);
    submit_search();
  });
}
function onSearchKeydown(e) {
  var selected = $('#javaslatok>li.active');
  if (e.keyCode == 13) {
    if (selected.length) {
      $('#search').val(selected.text());
      submit_search();
      $('#javaslatok').addClass('hidden');
    }
    else
      $('#search_button').click();
  }
  if (e.keyCode == 27) {
    selected.removeClass('active');
      $('#javaslatok').addClass('hidden');    
  }
  if (e.keyCode == 38) {
    if (!selected.length)
      $('#javaslatok>li').last().addClass('active');
    else
      selected.removeClass('active').prev().addClass('active');
  }
  if (e.keyCode == 40) {
    if (!selected.length)
      $('#javaslatok>li').first().addClass('active');
    else
      selected.removeClass('active').next().addClass('active');
  }
}
function myFocusFunction() {
  $('#search').on('keydown', onSearchKeydown);
}
function myBlurFunction() {
  $('#search').off('keydown', onSearchKeydown);
  window.setTimeout(function() {
    $('#javaslatok').addClass('hidden');
  }, 200);  // legyen idő kitölteni a keresőmezőt
}
function blurSearch() {
  $('#search').blur();
  myBlurFunction();
}

function showDimensionsOfThePage() {
  DoConsoleLog("theHTML scrollHeight:", $("#theHTML")[0].scrollHeight);
//  DoConsoleLog("thePage scrollHeight:", $("#thePage")[0].scrollHeight);
  DoConsoleLog("thePage scrollTop:", $("#thePage")[0].scrollTop);
  DoConsoleLog("thePage height:", $("#thePage").height());
//  DoConsoleLog("ha ez igaz, akkor nem csinálunk semmit:", "if (" + $("#theHTML")[0].scrollHeight + "-" + $("#thePage")[0].scrollTop + ">2*" + $("#thePage").height() + ")");
  //console.log('Bal oldalt: ' + ($("#theHTML")[0].scrollHeight-$("#thePage")[0].scrollTop));
  //console.log('Jobb oldalt: ' + 2*$("#thePage").height());
//  if ($("#theHTML")[0].scrollHeight-$("#thePage")[0].scrollTop>2*$("#thePage").height()) return;
//  DoConsoleLog("elértük az oldal végét...:", 'alcsoport_betoltes');
//  alcsoport_betoltes();
}

initSearchPanel = function() {
  var searchPanelToggle = jQuery('.searchPanelToggle');
  var searchPanel = jQuery('.searchPanel');
  //searchPanel.removeClass('animated fadeInDown');
  jQuery('.close-btn').on('click', function(e) {
    if (searchPanel.hasClass('animated')) {
      setTimeout(function() {
        searchPanel.addClass('fadeOutUp');
      }, 50);
      setTimeout(function() {
        searchPanel.removeClass('animated fadeInDown fadeOutUp');
      }, 500);
    }
    else {
      searchPanel.removeClass('animated fadeInDown fadeOutUp');
    }
  }
                         );
  searchPanelToggle.on('click', function() {
    searchPanel.addClass('animated fadeInDown');
    jQuery('.navbar-form .input-group>.form-control').focus();
  }
                      );
}
initBackOnTop = function() {
}
initScrollbars = function() {
}
initFooter = function() {
  var contentWrapperWidth = jQuery('.content-wrapper').width();
}
initPanel = function() {
  var footerWidth = jQuery('footer').width();
  var contentWrapperHeight = jQuery('.content-wrapper').height();
  var contentWrapperWidth = jQuery('.content-wrapper').width();
  var windowHeight = jQuery(window).height();
  var contentWrapper = jQuery('.content-wrapper');
  var body = jQuery('body');
  var bodyWidth = jQuery('body').width();
  var footerWidthToggle = bodyWidth;
  jQuery(window).scroll(function() {
    var navTop = jQuery('.navbar-fixed-top');
    var scroll = jQuery(window).scrollTop();
    var selectable = jQuery('.selectable');
    var navTopH = jQuery('.navbar-inverse').height();
    var navTopHeight = jQuery('.navbar-inverse.fixed').height();
    var selectableWidth = jQuery('.selectable.fixed').width();
    var tableInboxWidth = jQuery('table.inbox').width();
    var tableInbox = jQuery('table.inbox > thead');
    var tableInboxTH1 = jQuery('table.inbox > thead th').eq(0).width();
    var tableInboxTH2 = jQuery('table.inbox > thead th').eq(1).width();
    var tableInboxTH3 = jQuery('table.inbox > thead th').eq(2).width();
    var tableInboxTH4 = jQuery('table.inbox > thead th').eq(3).width();
    if (scroll > navTopH + 10) {
      navTop.addClass('fixed');
      selectable.addClass('fixed');
      tableInbox.addClass('fixed');
      jQuery('.navbar-inverse.fixed').width(contentWrapperWidth + 15);
      jQuery('.selectable.fixed').width(contentWrapperWidth + 15);
      jQuery('table.inbox > thead.fixed').width(tableInboxWidth);
      jQuery('.selectable.fixed').css('top', navTopHeight);
      var tableInboxTop = navTopHeight + jQuery('.selectable.fixed').height();
      jQuery('table.inbox > thead.fixed').css('top', tableInboxTop);
      jQuery('.navbar-inverse.fixed').css('left', sidebarWidth + 30)
      jQuery('table.inbox > thead.fixed th').eq(0).width(tableInboxTH1);
      jQuery('table.inbox > thead.fixed th').eq(1).width(tableInboxTH2);
      jQuery('table.inbox > thead.fixed th').eq(2).width(tableInboxTH3);
      jQuery('table.inbox > thead.fixed th').eq(3).width(tableInboxTH4);
      if (body.hasClass('toggle')) {
        jQuery(navTop).width(1000);
        jQuery('.selectable.fixed').width(footerWidthToggle - 15);
        jQuery('.navbar-inverse.fixed').width(footerWidthToggle - 15);
        jQuery('.navbar-inverse.fixed').css('left', '60px')
      }
    }
    else(
      navTop.removeClass('fixed'),
      selectable.removeClass('fixed'),
      tableInbox.removeClass('fixed'),
      navTop.css('width', '100%'),
      navTop.css('left', '0'),
      selectable.css('width', 'auto')
    );
  }
                       );
}
jQuery(function() {
  //ACCORDION MENÜ
  jQuery('.accordion-section-title').on('click', function(e) {
    var currentTitle = jQuery(this);
    var currentIcon = currentTitle.children('i');
    var nextContent = currentTitle.parents('ul').parent('div').next('.accordion-section-content');
    var currentAccordion = currentTitle.parents('ul').parent('div').parent('.accordionmenuItem');
    if (currentAccordion.hasClass('active')) {
      currentAccordion.removeClass('active');
      currentIcon.removeClass('fa-minus').addClass('fa-plus');
      nextContent.slideUp(300).removeClass('open');
    }
    else {
      nextContent.slideDown(300).addClass('open');
      currentAccordion.addClass('active');
      currentIcon.removeClass('fa-plus').addClass('fa-minus');
    }
    e.preventDefault();
  }
                                       );
  //FILTER SUBMENÜ
  jQuery('.dropdownCont .relative .submenu-ul').click(function() {
    var thisElement = jQuery(this);
    var nextDropDown = thisElement.parent('li.relative').children('.dropdown-menu');
    nextDropDown.toggleClass('open');
  }
                                                     );
  //PANEL TOGGLE
  initPanel();
  //DETAILS MODAL
  jQuery('.openmsgDetails').on('click', function() {
    jQuery('.msgDetails').modal();
  }
                              );
  jQuery('.openSettings').on('click', function() {
    jQuery('.settings').modal();
  }
                            );
  jQuery('.openIdent').on('click', function() {
    jQuery('.ident').modal();
  }
                         );
  //POPOVER
  jQuery('[data-toggle="popover"]').popover();
  //SCROLLBARS
  initScrollbars();
  //TÁBLÁZAT - KIJELŐLÉSEK
  var assign = jQuery('.assign');
  var assignDropDown = assign.next('.dropdown-menu');
  assign.on('click', function() {
    if (assign.prop('checked')) {
      assignDropDown.css('display', 'block');
    }
    else(
      assignDropDown.css('display', 'none')
    )
      }
           );
  var tableCheckBox = jQuery('.inbox tbody input[type=checkbox]');
  tableCheckBox.on('click', function() {
    var thisCheckbox = jQuery(this);
    var tableCheckBoxTr = thisCheckbox.parent('th').parent('tr');
    if (thisCheckbox.prop('checked')) {
      tableCheckBoxTr.css('background-color', '#F5F7F6');
    }
    else(
      tableCheckBoxTr.css('background-color', 'transparent')
    )
      }
                  );
  jQuery('.dropdown-menu').click(function(event) {
    event.stopPropagation();
  }
                                );
  var searchOverlay = jQuery('.searchOverlay');
  var searchPanel = jQuery('.searchPanel').height();
  searchOverlay.css('top', searchPanel);
  //CHARACTER COUNTER
  jQuery('textarea#uzenet').keyup(function() {
    var count = jQuery('textarea#uzenet').val().length;
    var charCounter = jQuery('.maxchar');
    charCounter.html(5000 - count);
    var charNumber = 5000 - count;
    if (charNumber < 200) {
      charCounter.removeClass('text-success');
      charCounter.addClass('text-danger');
    }
    else {
      charCounter.removeClass('text-danger');
      charCounter.addClass('text-success');
    }
  }
                                 );
  setAccessibilityFocus();
  setDarkMode();
  setUnderlineHrefFocus();
  /*setTabIndex();*/
 

}
      );

/*  $("#footer-linkek a").on("click", function() {* by.LM*/
function addOnClickEvent_ugrolinkek() {
	$("#footer-ugro-linkek-vissza_oldal_tetejere").on("click", function(){
  SetFocusAndShow("Nav");
});
}
/*  $("#footer-linkek a").on("click", function() {*/
function addOnClickEvent() {
  var lang = GetLanguage();
  $("#footer-linkek li").on("click", function() {
    var sorszam = parseInt(this.id.replace('footer-linkek-listitem-',''));
    DoGetPage(footer_links[lang][sorszam], "M", true, {});
  }
                       );
}
function addOnClickEvent_Fooldal_Focsoportok() {
  $("#listview-1 a").on("click", function() {
    sayToSzolgLista(1, 1+parseInt(this.id.replace('listview-1-listitem-','')));
  }
                       );
  $("#listview-2 a").on("click", function() {
    sayToSzolgLista(2, 1+parseInt(this.id.replace('listview-2-listitem-','')));
  }
                       );
  $("#listview-3 a").on("click", function() {
    sayToSzolgLista(3, 1+parseInt(this.id.replace('listview-3-listitem-','')));
  }
                       );
}

function setAccessibilityFocus(){
  var akadalymentes = WebStorage_get(localStorage,'GET','szuf_akadalymentes');
  if(akadalymentes == '1'){
    jQuery('.container').addClass('accessibility-focus');
    dialogFocus();
  } else {
    jQuery('.container').removeClass('accessibility-focus');
    dialogFocus();
  }
}


$("body").on("say_AccessibilityFocus", function(aEvent, message, from){
  setAccessibilityFocus();
});



function setUnderlineHrefFocus(){
  var hivatkozasok = WebStorage_get(localStorage,'GET','szuf_hivatkozasainak');
  if(hivatkozasok == '1'){
    jQuery('.container').addClass('underline-href');
  } else {
    jQuery('.container').removeClass('underline-href');

  }
}

$("body").on("say_UnderlineHrefFocus", function(aEvent, message, from){
  setUnderlineHrefFocus();
});
/*
function setTabIndex(){
  
  document.body.innerHTML=document.body.innerHTML.replace(/ctrl_type="listitem>"/g, 'ctrl_type="listitem" tabindex="0">');

}*/
/*function setTabIndex_LayoutList(){
/*document.body.innerHTML = document.body.innerHTML.replace(/ctrl_type="listitem">/g, 'ctrl_type="listitem" tabindex="0">');*/
/*document.body.innerHTML = document.body.innerHTML.replace(/<li class="list-group-item" a/g, '<li class="list-group-item"  tabindex="0" a');
/*document.body.innerHTML = document.body.innerHTML.replace(/" layout_record_field_name="SubMenuItem"(.+?)<\/span>/, '" layout_record_field_name="SubMenuItem"(.+?)</span> tabindex="0"');*/
/*}*/




function setDarkMode(){
  var darkmode = WebStorage_get(localStorage,'GET','szuf_darkmode');
  $(GetTopFrame().document).find('iframe').each(function(k){
    if(darkmode == '1'){
      $(this).addClass('darkmode');
      $(this).find('html').addClass('darkmode');
      $('html').addClass('darkmode');
    } else {
      $(this).removeClass('darkmode');
      $(this).find('html').removeClass('darkmode');
      $('html').removeClass('darkmode');
    }
  })
   if(darkmode == '1'){
      $('html').addClass('darkmode');
      $(GetTopFrame().document).find('body').css('background-color','#2c2c2c').addClass('darkmode');
      $(GetTopFrame().document).find('.modal-content').css('background-color','#2c2c2c');
    } else {
      $('html').removeClass('darkmode');
      $(GetTopFrame().document).find('body').css('background-color','#fff').removeClass('darkmode');
      $(GetTopFrame().document).find('.modal-content').css('background-color','#fff');
    }
}
$("body").on("say_DarkMode", function(aEvent, message, from){
  setDarkMode();
});

function dialogFocus(){
   var akadalymentes = WebStorage_get(localStorage,'GET','szuf_akadalymentes');
  $(GetTopFrame().document).find('iframe').each(function(k){
    if(akadalymentes == '1'){
      $(this).find('#dialog').addClass('yellow_outline');
      $('#dialog').addClass('yellow_outline');
    } else {
      $(this).find('#dialog').removeClass('yellow_outline');
      $('#dialog').removeClass('yellow_outline');
    }
  })
   if(akadalymentes == '1'){
      $(GetTopFrame().document).find('#dialog').addClass('yellow_outline');
      $(GetTopFrame().document).find('body').addClass('accessibility-focus');
    } else {
      $(GetTopFrame().document).find('#dialog').removeClass('yellow_outline');
      $(GetTopFrame().document).find('body').removeClass('accessibility-focus');
    }
}



