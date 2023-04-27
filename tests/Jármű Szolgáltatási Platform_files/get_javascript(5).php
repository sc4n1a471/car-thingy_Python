$("body").on("init", function() {
var prependedText = '';
prependedText += '<nav id="gyorslink" aria-label="ugrólinkek" role="navigation"> <ul> <li><a href="#" title="Ugrás az oldalsávhoz" aria-label="Ugrás az oldalsávhoz" onClick="document.getElementsByName(\'L\')[0].contentWindow.document.getElementById(\'Logo_ikon\').focus(); return false;">Ugrás az oldalsávhoz</a></li> <li><a href="#" title="Ugrás a tartalomhoz" aria-label="Ugrás a tartalomhoz" onClick="document.getElementsByName(\'M\')[0].contentWindow.document.getElementById(\'navbar_contact\').focus(); return false;">Ugrás a tartalomra</a></li> <li><a href="#" title="Ugrás a lábléchez" aria-label="Ugrás a lábléchez" onClick="document.getElementsByName(\'M\')[0].contentWindow.document.getElementById(\'footer-ugro-linkek-vissza_oldal_tetejere\').focus(); return false;">Ugrás a lábléchez</a></li> </ul> </nav>';
var indexBody = window.top.$("body");
if (indexBody.children("#covering").length > 0 && indexBody.children("#gyorslink").length < 1) {
	indexBody.prepend(prependedText);
}
  
  // nyelvváltás
  var mFrameHtml = document.getElementsByTagName("html")[0];
  indexBody.find("#gyorslink a").on("focus", function() {
    var $gyorslink = indexBody.find("#gyorslink");
    var lang = mFrameHtml.lang;
    var texts = {
      "hu": ["Ugrás az oldalsávhoz", "Ugrás a tartalomhoz", "Ugrás a lábléchez"],
      "en": ["Jump to sidebar", "Jump to content", "Jump to footer"]
    };
    var loctexts = texts[lang];
    if (!loctexts) return;
    for (var i = 0; i < loctexts.length; i++)
      $gyorslink.find("a").eq(i).attr("aria-label", loctexts[i]).text(loctexts[i]);
  });
});