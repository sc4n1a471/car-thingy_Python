initScrollbars = function() {
  jQuery('.sidebar').niceScroll({
    cursorcolor: "rgba(102, 102, 102, 0.4)",
    background: "transparent",
    autohidemode: "scroll",
    bouncescroll: false
  }
                               );
}
$(document).ready(function(){
  $('#Icons_menu_container a').on('click',function(){ $(this).trigger('blur') })
})
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
function setBadge(icon_id) {
  var el = document.getElementById(icon_id + '_ikon');
  var content = '';
  if (icon_id == 'Profile') {
  	content = WebStorage_get(sessionStorage, 'GET', icon_id);
  }
  else {
    content = GetFieldOfObject(GetLanguage(), JSON.parse(WebStorage_get(sessionStorage, 'GET', icon_id)), false);
  }
  if (content != "0" && content != null) {
    el.innerHTML = '<span class="badge">' + content + '</span>' + el.innerHTML;
  }
  else {
    el.innerHTML = el.innerHTML.replace(/<span(.+?)<\/span>/, '');
  }
} 
function closeMenu()
{
  //mobil eszközökön a 'say' hatására is be kell csukjuk a menüt
  window.parent.RevealMidPanel();
}
function getPathName()
{
  return window.top.location.href.replace(window.top.location.hostname, "").replace(window.top.location.protocol + '//', "");
}
function checkIfReferrerISTarhely()
{
  var ref = document.referrer;
  console.log(ref);
  return ref.match("/^https:\/\/tarhely\.(.*)gov\.hu(\/|$)/i");
}
recalculateIconsMenuContainer = function() {
  var sidebarHeight = jQuery('.sidebar').height();
  var sidebarHeaderHeight = jQuery('.sidebarHeader').height();
  var storageContHeight = jQuery('.storage-content').height() || 0;
  var thePageHeight = jQuery('#thePage').height();
  var sidebarContentHeight = sidebarHeaderHeight + jQuery('#Sidebar_navigation_container').height();
  //    var height = sidebarHeight + sidebarHeaderHeight + storageContHeight;
  //    var height = thePageHeight - sidebarHeaderHeight - 15;
  // console.log("thePage magassága:", thePageHeight);
  // console.log("sidebarContent magassága:", sidebarContentHeight);
  var height = Math.max(thePageHeight, sidebarContentHeight);
  jQuery('.iconsMenuContainer').height(height);
  //    console.log("ikon menü magassága:", height);
}
initPanel = function() {
  var sidebarHeight = jQuery('.sidebar').height();
  var footerWidth = jQuery('footer').width();
  var contentWrapperHeight = jQuery('.content-wrapper').height();
  var contentWrapperWidth = jQuery('.content-wrapper').width();
  var sidebarHeaderHeight = jQuery('.sidebarHeader').height();
  var iconsMenuContainer = jQuery('.iconsMenuContainer').height();
  var windowHeight = jQuery(window).height();
  var storageContHeight = jQuery('.storage-content').height();
  recalculateIconsMenuContainer();
  var panelToggle = jQuery('.panelToggle > button');
  var sidebar = jQuery('.sidebar');
  var contentWrapper = jQuery('.content-wrapper');
  var body = jQuery('body');
  var sidebarWidth = jQuery('.sidebar').width();
  var bodyWidth = jQuery('body').width();
  var iconsMenuContainerWidth = jQuery('.iconsMenuContainer').width();
  var footerWidthToggle = bodyWidth - iconsMenuContainerWidth;
  var footerWidthMetric = function() {
    jQuery('.sidebar').getNiceScroll().remove();
  };
  var sidebarIcons = jQuery('.iconsMenuContainer ul.icons');
  var sidebar = jQuery('.sidebar');
  /*sidebarIcons.hover(function () {
    if (!$("#"+"Icons_menu_container").hasClass('altWidth')) {
      $("#"+"Icons_menu_container").addClass('altWidth');
    }
    //jQuery('.iconsMenuContainer').toggleClass('altWidth');
    //sidebar.toggleClass('toggle');
  }, function () {
    if ($("#"+"Icons_menu_container").hasClass('altWidth')) {
      $("#"+"Icons_menu_container").removeClass('altWidth');
    }
  }
  );*/
  panelToggle.on('click', function() {
    body.toggleClass('toggle');
    sidebar.toggleClass('toggle fadeInLeft');
    contentWrapper.toggleClass('toggle');
    if (body.hasClass('toggle')) {
      jQuery('.sidebar').getNiceScroll().remove();
      jQuery('.selectable.fixed').width(footerWidthToggle - 15);
      jQuery('.navbar-inverse.fixed').width(footerWidthToggle - 15);
      jQuery('.navbar-inverse.fixed').css('left', '60px')
    }
    else(
      jQuery('.selectable.fixed').width(contentWrapperWidth + 15),
      jQuery('.navbar-inverse.fixed').width(contentWrapperWidth + 15),
      jQuery('.navbar-inverse.fixed').css('left', sidebarWidth + 30),
      jQuery('.sidebar').niceScroll({
        cursorcolor: "rgba(102, 102, 102, 0.4)",
        background: "transparent",
        autohidemode: "scroll"
      }
                                   )
    );
  }
                );
  if (jQuery(window).width() < 768) {
    //     jQuery('.sidebar').getNiceScroll().remove();
    //    body.toggleClass('toggle');
    //    sidebar.toggleClass('toggle fadeInLeft');
    //   contentWrapper.toggleClass('toggle');
    //   jQuery('.selectable.fixed').width(contentWrapperWidth);
  };
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
  setAccessibilityFocus();
  setDarkMode();
  setUnderlineHrefFocus();
  /*setTabIndex_LayoutList();*/
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
  //DATEPICKER
  /*  jQuery('.datepickerCont').datepicker({
        format: "yyyy-mm-dd",
        language: "hu",
        todayHighlight: "true",
    });
*/
  //TÁBLÁZAT - KIJELÖLÉSEK
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
  /*
    jQuery('.editable').inputEditable({
        action: {
            edit: '<span><i class="fa fa-pencil" aria-hidden="true"></span>',
            cancel: '<span><i class="fa fa-times" aria-hidden="true"></i></span>',
            submit: '<span><i class="fa fa-check" aria-hidden="true"></i></span>'
        },
        toggleAtRight: true,
        submit: function(value, resolve, reject) {
            resolve();
        }
    });
*/
}
      );
/*
function setTabIndex_LayoutList(){
/*document.body.innerHTML = document.body.innerHTML.replace(/ctrl_type="listitem">/g, 'ctrl_type="listitem" tabindex="0">');*/
/*document.body.innerHTML = document.body.innerHTML.replace(/<li class="list-group-item" a/g, '<li class="list-group-item"  tabindex="0" a');*/
/*document.body.innerHTML = document.body.innerHTML.replace(/" layout_record_field_name="SubMenuItem">(.+?)<\/span>/, '"tabindex="0" layout_record_field_name="SubMenuItem">(.+?)</span>');
}
*/

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


function setAccessibilityFocus(){
  var akadalymentes = WebStorage_get(localStorage,'GET','szuf_akadalymentes');
  if(akadalymentes == '1'){
    jQuery('.container').addClass('accessibility-focus');
  } else {
    jQuery('.container').removeClass('accessibility-focus');

  }
}

$("body").on("say_AccessibilityFocus", function(aEvent, message, from){
  setAccessibilityFocus();
});

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
    } else {
      $('html').removeClass('darkmode');

    }
}
 $("body").off("say_DarkMode").on("say_DarkMode", function(aEvent, message, from){
  setDarkMode();
});

function hideMenu(){
  parent.document.getElementById('left').className = '';
  parent.document.getElementById('covering').className = '';
}