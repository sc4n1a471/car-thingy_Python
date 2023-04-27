@import url('../font-awesome/css/font-awesome.min.css');
@import url('../font/css/open-sans.css');

/*-----------------------
COMMON
-------------------------*/

html {
    font-family: 'Open Sans', sans-serif !important;
    font-size: 1em;
}

body {
    font-family: 'Open Sans', sans-serif !important;
    color: #000 !important;
}

body.grey {
    background-color: #ECEBEA;
    height: 100%;
    width: 100%;
}

h1, h2, h3, h4, h5 {
    color: #000;
}
h1, h2, h3, h4 {
    font-weight: 700;
}
h1 {
  	font-size: 1.4rem;
    /*font-size: 1.8rem;
    line-height: 1.2;*/
}
h2 {
    font-size: 1.4rem;
}
h3 {
    font-size: 1.4rem;
}
h4 {
    font-size: 1.2rem;
}
h5 {
    font-size: 1rem;
}

.serviceSection h2 {
    margin-top: 0 !important;
}
.cursor-pointer:hover{
	cursor: pointer;
}
label{
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 400;
}
.starred-label label:after{
    content: '*';
    color: red;
    font-size: 16px;
    margin-left: 2px;
}
input.form-control:focus, textarea.form-control:focus {
    -webkit-box-shadow: none;
    box-shadow: none;
    border-color: #50B5E6!important;
}

hr {
  border-top: 1px solid #58585a !important;
}

.container-inner {/*padding: 0 30px 0 0;*/ margin: 0 auto; padding-left: 25px; padding-right: 25px;}
.container-inner-no-padding {padding: 0;}
/*.fooldal .navbar-inverse .navbar-nav > li:last-child {padding-top: 2px !important;}*/
#footer_container {min-height: 25px; padding: 0 !important;}

@media (max-width: 767px) {
    #S_search_div, #search_div {clear: both; max-width: 100% !important;}
    .iconsMenuContainer.altWidth {width: 100%;}
    .sidebar .iconsMenuContainer .list-group-item {width: 100%;}
    #top-nav-RNY #Sidebar_header {display: none;}
}
@media all and (min-width:768px) {
    .container{width:auto}
    .navbar-collapse{padding-left: 0px !important; padding-right: 0px !important;}
    #top-nav_Search{width: 100% !important; padding: 20px 0 5px 0 !important;}
    #top-nav_Search_80{width: 80% !important; padding: 20px 0 5px 0 !important;}
    .iconsMenuContainer.altWidth, .sidebar .iconsMenuContainer .list-group-item {width: 150px !important;}
}
@media all and (min-width:769px) {
    #fooldal #elrendezes_kiemelt > div {display: table-cell; vertical-align: middle;}
    .navbar-default-nisz-footer ul.links a p {margin-left: 10px !important;}
}
@media all and (min-width:992px) {
    .container{width:auto}
    #fooldal .col-sm-4 img, #fooldal .col-md-4 img {object-fit: cover; height: 150px;}
    #fooldal .col-md-8 img {object-fit: cover; height: 350px;}
}
@media all and (max-width:991px) {
    #S_search_div, #search_div {max-width: calc(100% - 200px);}
    #container-top10 {width: 100% !important; padding: 0 15px 0 15px !important;margin: 0 !important;}
    /* #fooldal_szuf_logo {display: none !important;} */
}
@media all and (min-width: 992px) and (max-width: 1199px) {
    .container{width:auto}
    .container-inner {margin: 0 auto; max-width: 900px;}
    .container-inner-no-padding {margin: 0 0px; max-width: 900px;}
    #S_search_div, #search_div {max-width: calc(100% - 300px);}
    #fooldal .container-inner, #fooldal .container-inner-no-padding, .fooldal .container-inner, .fooldal .container-inner-no-padding, .fooldal .navbar {margin: 0 0px; width: calc(100% - 270px);}
    /* #fooldal_szuf_logo {width: 240px; padding: 0 0 0 15px; float: right;} */
    #container-top10 {width: 240px !important; float: right;}
    #top10_list p {line-height: normal !important;} 
}
@media all and (min-width:1200px) {
    .container{width:auto}
    .container-inner {margin: 0 auto; max-width: 946px;}
    .container-inner-no-padding {margin: 0px; max-width: 946px;}
    #S_search_div, #search_div {max-width: 1000px;}
    #fooldal .container-inner, #fooldal .container-inner-no-padding, .fooldal .container-inner, .fooldal .container-inner-no-padding, .fooldal .navbar {width: calc(100% - 330px); max-width: 1200px !important;} 
    /* #fooldal_szuf_logo {width: 315px; padding: 0 0 0 15px; float: right;} */
    #container-top10 {width: 300px !important; float: right;}
    #fooldal .col-sm-4 img, #fooldal .col-md-4 img {object-fit: cover; height: 227px; margin-bottom: 5px;}
    #fooldal .col-md-8 img {object-fit: cover; height: 500px;}
    #fooldal #elrendezes_kiemelt > div {display: table-cell; vertical-align: middle;}
}
@media all and (min-width:1565px) {
    #fooldal .container-inner, #fooldal .container-inner-no-padding, .fooldal .container-inner, .fooldal .container-inner-no-padding, .fooldal .navbar {max-width:1200px;}
    #container-top10 {float: left !important;}
}

#Navbar_nav {
  text-align: right;
}

#keresesi_javaslatok .form-group {
  margin: 0 !important;
}

#nav_div {
     width: 300px; 
}
#fooldal #nav_div, .fooldal #nav_div {
    /* width: 100% !important; */
}

div#fooldal.container {flex: 0 !important; padding-left: 25px; padding-right: 25px;}

#fooldal .row {
    margin-right: 0 !important;
}

#fooldal_hirek {
    width: 100%;
    padding-left: 10px;
}

.szuf_container{padding:15px 10px}
@media all and (min-width:768px){.szuf_container{width:auto}}
@media all and (min-width:992px){.szuf_container{width:auto}}
@media all and (min-width:1200px){.szuf_container{width:auto}}

#container-top10 {
    width: 300px;
    margin: 0 0 0 15px;
}
.iconsMenuContainer.altWidth {
    width: 170px;
    box-shadow: 0 0 30px 0px rgba(102, 102, 102, 0.4);
}
.iconsMenuContainer.altWidth, .sidebar .iconsMenuContainer .list-group-item {
    width: 50px !important;
}/* -----akadálymentesítés miatt kikapcsolva*/
/*a,
.btn,
.form-control {
   /* -webkit-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
}*/
.kapcsolat_szoveg {
  height: 200px !important;
}
#elo_chat i {
  margin-top: .3em;
}
.btn {
    font-weight: 600;
    border-radius: 8px;
    text-transform: uppercase;
}
.btn:hover,
.btn:focus,
.btn:active,
.btn.active,
.btn:active:hover,
.btn:focus:hover {
    outline: none;
}

.btn:hover {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
    filter: alpha(opacity=80);
    opacity: 0.8;
}

 #logo:hover {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
    opacity: 0.5;
}

.ABC_button {
    width: 150px;
}
#intez-1:after, #intez-2:after, #intez-3:after {
    content: '\00A0\00BB';
}
a, .serviceSection .snap_clickable_text {
    color: #004b88; 
    font-weight: 700;
    border-bottom: 1px solid transparent;
    padding-bottom: 2px;
}
a:hover {
    text-decoration: none;
}
a:focus{
    outline: 1px solid #50B5E6;
}
a:focus,
a:active {
    outline: none;
    outline: 0;
    outline-offset: 0;
    text-decoration: none;
}
a:hover,
a:focus,
a:active,
.serviceSection .snap_clickable_text:hover,
.serviceSection .snap_clickable_text:focus,
.serviceSection .snap_clickable_text:active{
    border-bottom: 1px solid #004b88;
    cursor: pointer;
}
.hr_grey hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid rgb(194, 205, 219) !important;
    margin: 1em 0;
    padding: 0; 
}
.text-white {
    color: #ffffff;
}
.text-green {
    color: #91b74f;
}
.text-yellow {
    color: #ffcc00;
}
.text-red, .text-red h4 {
    color: #EC1F30;
}
.text-blue {
  color: #004b88;
}  
.bg-white {
    background-color: #ffffff !important;
}
.font-weight-bold, .font-weight-bold h4 {
    font-weight: bold;
}
.logout {
    border-bottom-color: #000 !important;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    font-size: 0.9rem;
}
table .label {
    margin-left: 10px;
}
.label-c1 {
    background-color: #3C7C30;
}
.label-c2 {
    background-color: #C9981F;
}
.label-c3 {
    background-color: #83BCDA;
}
.label-c4 {
    background-color: #464998;
}
.label-c5 {
    background-color: #955685;
}
.label-c6 {
    background-color: #d9534f;
}
tr.unread {
    font-weight: 700;
}
tr.unread .openmsgDetails {
    cursor: pointer;
}
table th {
    font-weight: 400;
}
.btn-nobgr {
    color: #333;
    background-color: transparent;
    border-color: transparent;
    outline: none;
    font-weight: 400;
}
/*table.inbox th:nth-child(3) {
    width: 70%;
}*/
#Icons_menu_container button:focus{
  outline: 3px solid #fff; 
  outline-offset: -2px;
}

.btn-blue,
.btn-blue:hover,
.btn-blue:focus,
.btn-blue:active,
.btn-blue.active,
.btn-blue:active:hover,
.btn-blue:focus:hover {
    color: #fff;
    background-color: #004b88 !important;
    border-color: #004b88;
    background-image: none;
    outline: none;
}
.btn-red,
.btn-red:hover,
.btn-red:focus,
.btn-red:active,
.btn-red.active,
.btn-red:active:hover,
.btn-red:focus:hover {
    color: #fff;
    background-color: #c20029 !important;
    border-color: #c20029;
    background-image: none;
    outline: none;
}
.btn-primary,
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary.active,
.btn-primary:active:hover,
.btn-primary:focus:hover {
    color: #fff;
    background-color: #F15736;
    border-color: #F15736;
	background-image: none;
    outline: none;
	margin-left: 0 !important;
	margin-right: 0 !important;
}
.btn-default,
.btn-default:hover,
.btn-default:focus,
.btn-default:active,
.btn-default.active {
    background-color: #fff;
    border-color: #c2cddb;
    background-image: none;
    outline: none;
    text-shadow: none;
}
.btn.disabled,
.btn[disabled],
fieldset[disabled] .btn {
  cursor: not-allowed;
  filter: alpha(opacity=65);
  -webkit-box-shadow: none;
  box-shadow: none;
  opacity: .65;
}
#nav_div {
    display: inline-block;
    float: right;
    margin-bottom: 10px;
    width: 200px !important;
}
#search_div {
    /*margin: 0 auto;*/
    width: 100%;
    max-width: 1000px;
    float: left;
}
#search_div .btn-default {
    height: 35px;
    border-top-right-radius: 4px !important;
    border-bottom-right-radius: 4px !important;
    color: #004b88;
    /*color: #3333FF;*/
    margin-top: 0px;
    border-color: #101010;
}
#hirek_cim, #top10_title {
    font-weight: 700;
    color: #000;
    font-size: 1.4rem;
}
.priorizalt_hir {
    border-radius: 10px !important;
    background-color: #f2f2f2;
    padding: 20px 40px !important;
    border-color: #f2f2f2;
    margin-bottom: 20px !important;
}

.hirek_reszletek {
    text-transform: none !important;
    border-radius: 0 !important;
    padding-left: 32px;
    padding-right: 32px;
}

.uj_mappa,
.uj_mappa:hover,
.uj_mappa:focus,
.uj_mappa:active,
.uj_mappa.active {
    border-color: #004b88;
    background-image: none;
    outline: none;
    font-weight: 700;
    text-transform: uppercase;    
    text-shadow: none;
    text-align: left;
    text-decoration: none;
    color: #004b88;
}

.uj_mappa .fa {
    font-size: 1.333em;
    color: #969696;
    margin-right: 20px;
}
#kedvencek-container .mappa_uj {
    padding: 0px;
    border: none;
    background-image: none;
    outline: none;
    font-weight: 500;
    border-radius: 0px;
    text-transform: none;    
    text-shadow: none;
    text-align: left;
    box-shadow: none;
    color: #004b88;
}
#kedvencek-container .mappa_uj .fa {
    font-size: 1.429em;
    margin-right: 15px;
}
#kedvencek-container hr {
    margin-top: 10px;
    margin-bottom: 10px;
}
.kedvencek-gomb, .idopontfoglalo-gomb {
    text-transform: none; 
    font-weight: 500;
    text-shadow: none;
/*    border: none; */
    border-radius: 4px;
}
.kedvencek-gomb .fa {
    margin-top: 3px;
}
.csatolmanyok_hitelesitese .col-sm-4 {
    text-align: center;
}
.btns {
    text-align: right;
    margin-bottom: 20px;
}
.btns .btn {
    margin-left: 15px !important;
}
.btn-file {
    position: relative;
    overflow: hidden;
    font-size: 1.1rem;
    padding: 15px;
    color: #004b88;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
    outline: none;
    background: #FFF;
    cursor: inherit;
    display: block;
}
.drag-drop {
    height: 140px;
}
.file-list {
    margin: 15px 0 25px 0;
}
.file-list > li {
    margin: 0 0 15px 0;
    padding-bottom: 15px;
    border-bottom: 1px solid #e5e5e5;
}
.file-list > li > a.delFile > i,
.file-list .progressCont .pauseProcess > i {
    color: #004b88;
    font-size: 1.2rem;
}
.file-list > li > i:nth-child(1) {
    margin-right: 15px;
}
.file-list .progress {
    height: 2px;
    width: 90%;
    margin: 35px 0 15px 0;
}
.file-list .progressCont {
    width: 100%;
}
.file-list .progressCont span {
    color: #333;
    display: inline-block;
    position: absolute;
    left: 93%;
    top: -10px;
}
.file-list .progressCont .pauseProcess {
    color: #333;
    display: inline-block;
    position: absolute;
    right: 0;
    top: -10px;
}
.files {
    margin: 7px 0 0 0;
}
.files span {
    font-size: 0.875rem;
    color: #333;
    margin-left: 5px;
}
.files .fa {
    font-size: 1.2rem;
    margin-right: 10px;
}
.open > .dropdown-toggle.btn-primary,
.open>.dropdown-toggle.btn-primary:hover {
    color: #fff;
    background-color: #F15736;
    border-color: #F15736;
    outline: none;
}
.btn-primary[disabled],
.btn-primary[disabled]:hover {
    background-color: #888;
    border-color: #888;
}
.pagination .open>.dropdown-menu {
    min-width: 55px;
}
.pagination>.active>a,
.pagination>.active>a:focus,
.pagination>.active>a:hover,
.pagination>.active>span,
.pagination>.active>span:focus,
.pagination>.active>span:hover {
    background-color: #004b88;
    border-color: #004b88;
}
select.form-control {
    color: #0C0C0C;
}
select.form-control:hover {
    cursor: pointer;
}
select.form-control:focus {
    border: 1px solid #ddd;
    -webkit-box-shadow: none;
    box-shadow: none;
}
#kedvencek .snap-ll-header {
   border-bottom: 0 !important;
   display: none;
}
#kedvencek .list-group {
    margin-bottom: 0 !important;
    min-width: 100px;
}
#kedvencek .list-group-mod {
    min-width: 68px;
    float: right !important;
}
#kedvencek .list-group-table .snap-card-table > .row > .form-group {
    padding: 10px 0 !important;
}
#kedvencek .col-sm-2, #linkek .col-sm-2 {
    float: right;
}
.kedvencek-ugyek .list-group-item .list-group {
    min-width: 0 !important;
}
/*
.kedvencek-ugyek {
    padding: 0 20px !important;
}
*/
.kedvencek-ugyek .list-group-item .list-group .list-group-item, #telepulesek_ABC .list-group-item {
    border: 0 !important;
}
#adoszamok-header {
  display: none;
}
.kedvencek-title {
    position: relative;
    margin-top: 10px;
}
.kedvencek-title .form-group {
    display: inline-block;
    float: left;
    padding-left: 0 !important;
    padding-right: 0 !important;

}
.kedvencek-title .form-group > .form-group {
    width: 100% !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
}
.kedvencek-title .list-group {
    margin: 0 !important;
    font-size: 1.2em;
}
.kedvencek-title .list-group .list-group-item, #mappa_mod_gomb .list-group-item {
    border: 0 !important;
    padding: 0 20px 0 0;
}
.kedvencek-title .list-group .list-group-item:last-child {
    padding-right: 0px;
}
.kedvencek-title .list-group .confirm_icon {
    padding-right: 20px !important;
}
#mappa_mod_gomb .list-group-item {
    padding-right: 5px;
}
input.kedvencek[type=text] {
    color: #000 !important;
    font-size: 1rem;
    font-weight: 700;
}
input.kedvencek[type=text][readonly] {
    border: 1px solid transparent;
    box-shadow: none;
    background: 0 0;
}
div.kedvenc_mappa {
    background-color: #e7e7e7 !important;
}
div.underline {
    border-top: 0;
    border-bottom: 1px solid #c2cddb;
    border-left: 0;
    border-right: 0;
    margin-bottom: 0px;
}
div.underline_dark {
    border-top: 0;
    border-bottom: 1px solid grey;
    border-left: 0;
    border-right: 0;
    margin-bottom: 0px;
}
.kedvencek-ugyek > div > div  {
    border-bottom: 1px solid #ddd !important;
    font-size: 1em;   
}
.kedvencek-ugyek > div:first-child > div {
    border-bottom: 0 !important;   
}
#esemenynaplo_lista .snap_clickable_text, #piszkozat_lista .snap_clickable_text {
    color: #004b88 !important;
}
#esemenynaplo_lista .form-group, #belepes_lista .form-group, #piszkozat_lista .form-group {
    margin-bottom: 0px;
    font-size: 0.9rem;
}
#esemenynaplo_lista .list-group-item, #belepes_lista .list-group-item, #piszkozat_lista .list-group-item {
    border-left: 0px;
    border-right: 0px;
}
.ugyleiras_torol {
    font-weight: 700;
    color: #004b88 !important;
}
.ugyleiras_szerk {
    min-height: 200px;
    border: 1px solid #ddd;
    padding: 10px;
}
.null-height {
    height: 0px;
}
.btn-lblue {
    background-color: #4AAFE3 !important;
    border-color: #4AAFE3;
    outline: none;
    color: #fff;
    background-image: none;
}
.btn-lblue,
.btn-lblue:hover,
.btn-lblue:focus,
.btn-lblue:active,
.btn-lblue.active,
.btn-lblue:active:hover,
.btn-lblue:focus:hover {
    color: #fff;
}
.btn.noborderRadius {
    border-radius: 0;
}
.list-unstyled.files > li {
    margin-bottom: 10px;
    color: #004b88;
}
.files span .fa {
    font-size: 20px;
    color: #333;
    margin-right: 5px;
}
form.details .dropdown-menu {
    left: 50px;
}
form .popover {
    width: 276px;
}
.has-error .form-control {
    border-color: #D82937;
}
.scrolling {}
/*-----------------------
TOP NAVIGATION
-------------------------*/

.submenu a {
    color: #000;
    font-size: 0.9rem;
    padding-bottom: 9px;
    border-bottom: 2px solid transparent;
}
.submenu a.active,
.submenu a:focus {
    color: #004b88;
    border-bottom: 2px solid #004b88;
}
.submenu {
    padding-left: 5px;
}
.submenu>li {
    padding-right: 15px;
}
.borderBottom {
    border-bottom: 2px solid #ddd;
    margin-bottom: 20px;
    padding-bottom: 10px;
}
/*
.navbar-fixed-bottom {
    width: 100%;
}
*/
.navbar-default-nisz-footer {
    box-shadow: none !important;
    background: none !important;
    padding-top: 4px;
    margin: 30px 25px 0 25px;
    border-top: 1px solid #000 !important;
    border-left: 0;
    border-right: 0;
    border-bottom: 0;
    display: block;
    border-radius: 0 !important;
}
            .navbar-default-nisz-footer ul.copy {
                float: left !important;
                width: calc(50% + 25px);
                height: 25px;
            }
            .navbar-default-nisz-footer ul.copy li {
                padding: 0 !important;
                border: 0 !important;
                background: transparent !important;
            }
            .navbar-default-nisz-footer ul.links {
                float: right !important;
                text-align: right !important;
            }
            .navbar-default-nisz-footer ul.links a p,
            .navbar-default-nisz-footer ul.copy a {
                font-size: 0.9rem !important;
                color: #000 !important;
                font-weight: 400 !important;
                padding: 0 !important;
                margin: 0 !important;
                line-height: normal !important;
                vertical-align: top !important;
            }
            .navbar-default-nisz-footer ul.links a:hover p {
                border-bottom: 1px solid #000 !important;
            }
            .navbar-default-nisz-footer ul.links li {
                padding: 0 0 0 5px !important;
                border: 0 !important;
                float: right;
            }
            .navbar-default-nisz-footer ul li {
                margin: 0 !important;
                line-height: normal !important;
                vertical-align: bottom !important;
                padding: 0 !important;
            }
.navbar-default-nisz-footer .cimer {
    width: 50px;
    height: 70px;
    border-left: 10px solid #fff;
    border-right: 10px solid #fff;
    background: #fff url(get_image.php?img=7047812745126488) 0 0 no-repeat;
    background-size: auto;
    background-size: 100%;
    position: absolute;
    top: -41px;
    left: calc(50% - 25px);
}
.navbar-default-nisz-footer .cimer.fooldal {
    width: 35px !important;
    height: 33px !important;
    top: -18px !important;
}
.navbar-inverse {
    background-color: #fff;
    border-color: transparent;
    position: relative;
    z-index: 10;
    margin: 0;
   -webkit-transition: padding 0.3s ease-out;
    -o-transition: padding 0.3s ease-out;
    transition: padding 0.3s ease-out;
    background-image: none;
}
.navbar #SZUF {
    margin: 25px 0 10px 0 !important;
    font-weight: 100;
}
.navbar-inverse.fixed {
    position: fixed;
    margin-top: 0;
    padding: 5px 5px 0 5px;
}
.navbar-inverse.noScroll.fixed {
    position: relative !important;
    margin: 15px 0 0 0;
    width: 100% !important;
    left: 0 !important;
}
.navbar #search_div .form-group {
    margin: 0 !important;
}
.selectable.fixed {
    position: fixed;
    z-index: 10;
    padding-top: 0;
    padding-bottom: 0;
}
.navbar-inverse .navbar-nav > .open > a,
.navbar-inverse .navbar-nav > .open > a:hover,
.navbar-inverse .navbar-nav > .open > a:focus,
.navbar-inverse .navbar-nav .open .dropdown-menu > li > a:hover,
.navbar-inverse .navbar-nav .open .dropdown-menu > li > a:focus,
.navbar-inverse .dropdown-menu>.active>a {
    background-color: transparent;
    color: #0C0C0C;
}
.navbar-inverse .navbar-nav .open .dropdown-menu > li > a {
    color: #000;
}
.navbar-inverse .navbar-brand:hover,
.navbar-inverse .navbar-brand:focus {
    color: #000
}
/*
.navbar-toggle {
    background: #999;
    border-color: #999;
}
*/
.navbar-inverse .navbar-collapse,
.navbar-inverse .navbar-form {
    border-color: transparent;
}
.navbar-inverse .navbar-collapse.in {
    overflow-y: hidden !important;
    padding-left: 0;
    padding-right: 0;
}
.navbar-inverse .navbar-nav .open .dropdown-menu .divider {
    background-color: grey;
    margin: 3px 0;
}
.navbar-nav .panel-title {
    font-weight: bold
}
.navbar-nav .panel-group {
    margin-bottom: 0px;
}
.navbar-form {
    padding-left: 0 !important;
}
.navbar-form .form-group > .form-group, .navbar-form .form-control {
    width: 100%;
}
.dropdown-menu > li > a {
    padding: 5px 0 5px 25px
}
.dropdown-menu.filter > li.active > a {
    padding: 5px 0 5px 10px
}
.navbar-form .input-group {
    width: 100%;
    margin: 0 auto;
    height: auto;
}
.navbar-brand {
    font-size: 2.2rem
}
.navbar-header {
    margin-bottom: 40px
}
.navbar-nav > li > .dropdown-menu, .navbar-nav > .dropdown-menu {
    margin-top: 0;
    font-size: 1rem;
}
.navbar-inverse .navbar-nav {
    box-shadow: none;
    border: none;
    display: inline-block;
    margin-bottom: 0px;
    margin-right: 0px !important;
    /*margin-top: 5px;*/
    /*height: 58px;*/

}
.navbar-inverse .navbar-nav > li {
    border: none;
    display: inline-block;
    font-size: 16px !important;
    font-weight: 700;
    padding: 5px;
    margin-left: 10px;
}
.navbar-inverse .navbar-nav > li > div h4 {
   font-size: 14px !important;
}
.navbar-nav>button.lang {
  margin-top: 2px;
  font-size: 0.8rem !important;
  color: #000;
}

.darkmode .navbar-nav>button.lang {
  color: #fff !important;
}
.navbar-nav>button.active_lang,
.navbar-nav>button.lang:hover,
.navbar-nav>button.lang:focus,
.navbar-nav>button.lang:active {
  background-color: #004b88 !important;
  text-align: center;
  color: #fff;
  border-radius: 50% !important;
}
.navbar-nav>button.lang:focus {
 outline: 1px solid #0781ff;
 outline-offset: 2px;
}
.navbar-inverse .navbar-nav .list-group {
    margin-bottom: 0 !important;
}

.nav-container-blue{
    background-color: #00659f;
    margin: 0 !important;
}
.nav-container-blue .navbar.navbar-inverse{
    background-color: #00659f;
    border:none;
}
.nav-container-blue .navbar.navbar-inverse .navbar-collapse{
    -webkit-box-shadow:none;
    box-shadow: none;
}
.nav-container {
    margin: 1em 0 0 15px;
}
.nav-container h1.visible-xs {
    color: #fff;
}
.btn-lg#upload-btn {
    border-color: #fff;
    margin-top: -2px;
}
.open>.dropdown-menu.selectable {
    left: 100px;
}
.view-setting .checkbox-inline,
.settings .checkbox-inline {
    margin-left: 20px;
}
.view-setting .checkbox-inline label,
.settings .radio-inline label,
.settings .checkbox-inline label {
    font-weight: 400;
}
.view-setting .checkbox-inline.disabled label,
.settings .checkbox-inline.disabled label {
    cursor: not-allowed;
    opacity: 0.4;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
    font-weight: 400;
}
.selectable .dropdown-menu {
    min-width: 200px;
}
.topnav {
    padding-top: 10px;
    padding-bottom: 10px;
}
.navbar-brand>img {
    display: inline-block;
    margin: 10px 10px 0 0;
    width: 189px;
}
.navbar-inverse .navbar-brand {
    font-family: 'Open Sans Condensed', sans-serif;
    color: #57585A;
    vertical-align: middle;
    font-size: 2.5rem;
    font-weight: 700;
}
.navbar-inverse .navbar-form {
    position: relative;
    top: 20px;
}
.navbar-nav.small {} .navbar-inverse .navbar-nav.small > li > a,
.navbar-nav.small > li > .dropdown-menu {
    font-size: 0.75rem;
}
.navbar-right~.navbar-right {
    margin-right: -15px;
}
.border {
    border: 1px solid #c2cddb;
    padding: 20px 30px;
}
.dotted-border {
    width: 100%;
    height: 265px;
    border: 3px dotted #c2cddb;
    padding: 20px 30px;
    background: url(../img/drag-n-drop-bgr.png) no-repeat center center;
    margin: 20px 0;
}
.dropdown-menu>.active>a,
.dropdown-menu>.active>a:focus,
.dropdown-menu>.active>a:hover {
    color: #000;
    font-weight: 700;
    text-decoration: none;
    background-color: transparent;
    outline: 0;
}
.dropdown-menu .submenu-ul + .dropdown-menu {
    display: none;
    left: -200px;
    top: -5px;
}
.dropdown-menu .submenu-ul + .dropdown-menu.open {
    display: block;
}
a.submenu-ul {
    display: inline-block !important;
    width: 100%;
    padding-right: 25px !important;
}
a.submenu-ul > i {
    display: inline-block;
    position: relative;
    bottom: -3px;
}
.searchPanelToggle {
    cursor: pointer;
}
.searchPanelToggle > i {
    cursor: pointer;
    font-size: 1.4rem;
    bottom: 5px;
    position: relative;
}
/*-----------------------
PANEL TOGGLE
-------------------------*/

.sidebar.toggle {
    width: 50px;
    overflow: hidden;
}
.content-wrapper.toggle {
    margin-left: 50px;
}
.panelToggle {
    height: 40px;
    margin: 36px 0 24px 0  !important;
    /*cursor: pointer;*/
}
.panelToggle.non-visible img {
    float: left;
    margin-left: 9px;
    display: none;
}
.panelTogle.visible img {
    display: inline !important;
}
.panelToggle .navbar-toggle {
    display: block;
    margin: 0 15px 0 0;
    background-color: transparent;
    padding: 5px;
border-radius: 4px;
}
.panelToggle .navbar-toggle .icon-bar {
    border: 1px solid #999;
    width: 20px;
}
.sidebar.toggle #logo,
.sidebar.toggle .backToMainLink,
.sidebar.toggle .normalMenuContainer,
.sidebar.toggle .storage-content {
    position: relative;
    left: -500px;
}
.sidebar.toggle .panelToggle .navbar-toggle {
    margin: 0 10px 0 0;
}
.sidebar.toggle .sidebarNavigationContainer {
    border-top: 0;
}
.sidebar.toggle .backToMainLink {
    margin-left: -200px;
}
/*-----------------------
CONTENT
-------------------------*/

#logo {
    display: block;
    text-align: center;
    cursor: pointer;
}
.backToMainLink,
.normalMenuContainer,
.storage-content {
   -webkit-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
}
#Logo_ikon {
    /*margin-bottom: 1px;*/
}
.sidebarNavigationContainer {
    min-height: 100%;
    width: 245px !important;
    float: left;
    margin-left: 60px;
}
.sidebarNavigationContainerRNY {
    min-height: 100%;
    width: 325px !important;
    float: left;
    margin-right: 15px;
}
.normalMenuContainer {
    background: #fff;
    width: 100%;
    z-index: 20;
}
/*
.panel-heading.ViseltNev {
        background-color: #00659f;
}
#bejelentkezes-kijelentkezes a::before {
    padding-right: 10px;
    font-family: "FontAwesome";
    float: right;  
}
.ViseltNev .panel-title a::before {
    content: "\f078";
}
*/
#bejelentkezes-kijelentkezes {
    background-color: #00659f;
    padding: 10px 15px 10px 50px;
    color: #fff;
    line-height: 50px;
    margin: 0 !important;
}
.ikonsorral {
    padding-left: 5px !important;
}
#Felhasznalo {
  font-weight: 700;
  margin: 15px auto;
  margin-top: 20px;
  margin-bottom: 5px;
}
.ViseltNev, .signout {
  text-align: center;
}
#ViseltNev {
    background-color: #00659f;
    padding: 10px 15px 10px 50px;
    color: #fff;
    line-height: 50px;
    margin: 0;
}
.ViseltNev .panel-title a {
    color: #fff;
    line-height: 50px;
}
#ViseltNev .panel-body {
    padding: 0 !important;
}
.iconsMenuContainer {
    position: fixed;
    left: 0;
    top: 0;
    width: 50px !important;
    text-align: center;
    min-height: 100%;
    background: #6D6E72;
    /*overflow: hidden;*/
    -webkit-transition: width 0.5s cubic-bezier(0, 0, 0.7, 0.04);
    -o-transition: width 0.5s cubic-bezier(0, 0, 0.7, 0.04);
    transition: width 0.5s cubic-bezier(0, 0, 0.7, 0.04);
    z-index: 20 !important;
}
.tooltip {
    z-index: 1000;
}
.sidebar {
   position: absolute;
   top: 0;
   bottom: 0;
    width: 315px !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0;
    /*-webkit-box-shadow: 0 -10px 10px 0px rgba(102, 102, 102, 0.4);
    box-shadow: 0 -10px 10px 0px rgba(102, 102, 102, 0.4);*/
    overflow-x: hidden;
    overflow-y: auto;
    z-index: 50;
    -webkit-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
   /* ipad mini menu scroll fix */
   -webkit-overflow-scrolling: touch ;
}
.sidebarHeader {
    background: #fff;
    width: calc(100% - 100px) !important;
    margin: 0 auto;
    height: 80px;
    overflow: hidden;
}
.sidebar-content {
    min-height: 100%;
}
.sidebar #logo {
    /*width: auto;*/
    /*height:90px;*/
    margin: 15px auto;
    cursor: pointer;
    padding-top: 0px;
    margin-top: 10px;
}
.sidebar #logo.fooldal {
    height: 40px !important;
    margin: 32px auto !important;
}
.sidebar .nav {
    margin-bottom: 20px;
}
.sidebar .navbar-nav.small {
    float: left;
    width: 100%;
    text-align: left;
    border-bottom: 1px solid #ddd;
margin: 7.5px 0 20px 0;
}
.sidebar .navbar-nav>a {
    color: #000;
    position: relative;
    padding-left: 50px;
}
.sidebar .navbar-nav>a .profile-icon {
    font-size: 1.6rem;
    position: absolute;
    left: 10px;
    bottom: 20px;
    color: #000;
}
.sidebar .nav>a:focus,
.nav>li>a:hover {
    background-color: #F5F7F6;
}
.sidebar .nav .open>a,
.sidebar .nav .open>a:focus,
.sidebar .nav .open>a:hover {
    background-color: #F5F7F6;
}
.sidebar .dropdown-menu>li>a:focus,
.sidebar .dropdown-menu>li>a:hover,
.sidebar .dropdown-menu>li>a:hover {
    color: #555;
    text-decoration: none;
    background-color: #F5F7F6;
}
.sidebar .dropdown-menu > li > a {
    padding: 10px 0 10px 10px;
}
.sidebar .dropdown-menu .divider {
    margin: 0;
}
.sidebar .dropdown-menu {
    padding: 0;
}
.sidebar .navbar-collapse.in {
    overflow-x: hidden;
}
.sidebar .nav {
    left: 30px;
}
.sidebar .tooltip-inner{
  max-width: 300px;
  min-width: 150px !important;
}
.selectable {
    background: #ECEBEA;
    padding: 10px 20px 10px 10px;
    margin: 15px 0 15px 0;
    -webkit-transition: width 0.5s ease-out;
    -o-transition: width 0.5s ease-out;
    transition: width 0.5s ease-out;
}
.selectable i {
    color: #004b88;
}
.selectable .form-group {
margin-bottom: 0 !important;
}
.editable i.fa-check {
    color: #3C7C30;
}
.editable .form-control {
    width: 100% !important;
}
.sidebar .progress {
    height: 2px;
    width: 90%;
    margin: 0 auto;
}
.sidebar .progress-bar-success {
    background-color: #000;
}
.storage-content {
    position: fixed;
    left: 50px;
    bottom: 0;
    padding-bottom: 0;
    width: 245px;
    background: #fff;
    z-index: 21;
}
p.storage {
    padding-left: 15px;
    color: #004b88;
}
p.storage.text-uppercase {
    color: #000;
}
.storage-content.danger {} .storage-content.danger p.storage {
    color: #D82937;
}
.storage-content.danger p.storage.text-uppercase {
    color: #D82937;
}
.progress-bar-danger {
    background-color: #D82937;
}
span.icon {
    display: block;
}
.head {
    margin: 0;
    line-height: normal;
}
textarea.form-control {
    resize: none;
}
h3 {
    margin-top: 0;
}
a.moreDatasClicked {
    color: #9f4b9b
}
.doc-item h4 {
    margin-top: 0
}
#MainMenuDefault .panel-group {
    /*line-height:1rem !important;*/
    margin-bottom: 0;
}
.panel-default {
    border: none !important;
    box-shadow: none !important;
    background-color: transparent;
}
.panel-default > .panel-heading {
    color: #000 !important;
    background-image: none !important;
    border-bottom:1px solid #ddd !important;
}
.panel-default > .panel-heading > .panel-title > a:hover,
.panel-default > .panel-heading > .panel-title > a:active,
.panel-default > .panel-heading > .panel-title > a:focus{
    text-decoration:none;
    border-bottom: 1px solid transparent;
}
.sidebarTwo .panel-default > .panel-heading {
    padding-left: 50px;
}
#MainMenuDefault, #NaptarMenuDefault {
    text-transform: uppercase;
    border-color: transparent;
    padding: 0;
    position: relative;
    z-index: 0;
}
#MainMenuDefault .panel-default > .panel-heading, #MainMenuDefault button {
    color: #000 !important;
    background-color: transparent;
    background-image: none !important;
    border-bottom: none !important;
    padding: 0 5px 0 0;
    margin-bottom: 5px !important;
}
#MainMenuDefault .list-group-item, #NaptarMenuDefault .list-group-item {
  font-size: 0.9rem !important;
  font-weight: 400 !important;
  text-transform: uppercase;
}
#MainMenuDefault .panel-title {
  font-size: 0.9rem !important;
}
#MainMenuDefault .panel-title a {
  display: block;
  padding: 5px 0;
  border-bottom:none !important;
}
#MainMenuDefault .panel-title a:hover,
#MainMenuDefault .panel-title a:focus,
#MainMenuDefault .panel-title a:active {
    border-bottom: none !important;
}
.panel-title a:after {
  content: '\2212';
  font-weight: bold;
  float: right;
  margin: 0;
}
.panel-title a.collapsed:after {
  content: '\002B';
}
#MainMenuDefault .clickable_text_as_button {
    width: 100% !important;
}  
#MainMenuDefault .panel-title a.collapsed:after, .init_menu .panel-title a:after  {
  content: '';
    width: 9px;
    height: 9px;
    border-left: 2px solid#000;
    border-bottom: 2px solid#000;
    transform: rotate(-45deg) !important;
    margin-top: 3px;
    display: block;
    position: absolute;
    right: 10px;
    top: 4px !important;
    transition: all 0.3s ease-out;
}
#MainMenuDefault .panel-title a:after {
    content: '';
    width: 9px;
    height: 9px;
    border-left: 2px solid #000;
    border-bottom: 2px solid #000;
    transform: rotate(135deg);
    margin-top: 3px;
    display: block;
    position: absolute;
    right: 10px;
    top: 7px;
    transition: all 0.3s ease-out;
}
.uzemeltetes_cim .panel-title a:after, .uzemeltetes_cim .panel-title a.collapsed:after {
  content: "";
}
.uzemeltetes_cim .panel-title a {
  display: block !important;
}
.uzemkieses .panel-body, .csokkentett .panel-body, .karbantartas .panel-body {
  padding: 15px 15px 15px 40px !important;
}
.csokkentett .panel-title a:after  {
  content: "Csökkentett mód" !important;
  color: #000 !important;
  font-size: 1rem !important;
}
.karbantartas .panel-title a:after  {
  content: "Karbantartás" !important;
  color: #000 !important;
  font-size: 1rem !important;
}
.uzemkieses .panel-title a:after  {
  content: "Üzemkiesés" !important;
  color: #000 !important;
  font-size: 1rem !important;
}
.csokkentett_en .panel-title a:after  {
  content: "Reduced mode" !important;
  color: #000 !important;
  font-size: 1rem !important;
}
.karbantartas_en .panel-title a:after  {
  content: "Maintenance" !important;
  color: #000 !important;
  font-size: 1rem !important;
}
.uzemkieses_en .panel-title a:after  {
  content: "Outage" !important;
  color: #000 !important;
  font-size: 1rem !important;
}

.uzemeltetes_cim .panel-heading {
    background-color: #ffffff !important;
    color: #004b88 !important;
    display: inline-block;
    width: 100%;
}
#MainMenuDefault .panel-body {
    padding: 0 14px 20px 6px !important;
    border: none !important;
}
.upload legend {
    margin: 0 0 10px 0
}
.upload .checkbox {
    margin: 0
}
.upload .form-group {
    margin-bottom: 25px
}
.progress-bar-success {
    background-color: #64a350
}
.label-default {
    background-color: #e7e8eb;
    border-color: #e7e8eb;
    color: #555;
}
.status {
    text-align: right;
}
.banner {
    margin-bottom: 30px;
}
#szolgaltatas_lista {
    display: table;
}
.head.underline, #szolgaltatas_lista div.underline, #telepules_lista div.underline {
    display: inline-block;
    padding-bottom: 0;
    border-bottom: 1px solid #c2cddb;
    width: 100%;
    float: left;
}
.ugyleiras_cim {
    position: relative;
    display: inline;
    padding-bottom: 0;
    width: 100%;
    float: left;
    border-bottom: 1px solid #c2cddb;
}
.kedvencek-container{
    width: 200px !important;
    height: auto;
    position: absolute;
    right: 5px;
    margin-top: 15px;
    border: 1px solid #ccc;
    background: #fff;
    border-radius: 4px;
    padding:10px;
    z-index: 10;
}

#kapcsolodo_dokumentumok i {
    line-height: 20px;
}

#kapcsolodo_dokumentumok button {
  color: #004b88;
  border: 0 !important;
  border-radius: 0px;
  padding: 0;
  background-color: transparent !important;
  outline: none;
  text-align: left;
  white-space: normal !important;
  -webkit-box-shadow: none;
  box-shadow: none;
  margin: 0 !important;
  text-transform: none !important; 
  font-weight: normal;
  text-decoration: none !important;
}

.block-container {
    /* margin-bottom: 20px; */
}
.block-container img {
    margin: 20px auto;
    height: 100px;
width: auto;
max-width: 100%;
}
.block-container p {
    font-size: 1.2rem
}
.searchPanel {
    width: 100%;
    position: fixed;
    top: -1100px;
    z-index: 1000;
    left: 15px;
    right: 0;
    background: #fff;
    padding: 15px 25px;
    -webkit-box-shadow: 0 0 30px 0px rgba(102, 102, 102, 0.4);
    box-shadow: 0 0 30px 0px rgba(102, 102, 102, 0.4);
}
.searchPanel.fadeInDown {
    top: 0;
}
.searchPanel .input-group-btn {
    width: 1% !important;
}
.searchPanel h2 {
    text-align: left;
}
.searchPanel .btn-primary {
    padding: 10px 40px;
    border-radius: 5px;
    font-size: 1.12rem;
}
.navbar-form .input-group .form-control {
    border-color: transparent;
    outline-color: transparent;
    -webkit-box-shadow: none;
    box-shadow: none;
    font-size: 1.6rem;
    padding: 0;
    width: 100% !important;
    margin-top: -17px;
}
.close-btn {
    position: absolute;
    top: 10px;
    right: 45px;
    color: #c2cddb;
    font-size: 1.3rem;
    cursor: pointer;
}
.head > small {
    margin-left: 15px;
}
.sidebar .list-unstyled li {
    -webkit-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
}
.sidebar .list-unstyled li > a > img.img-rounded {
    border-radius: 0px !important;
    float: left;
    margin-right: 20px;
}
.sidebar .list-unstyled li > h4 {
    display: block;
    vertical-align: middle;
    margin-left: 5px;
    font-size: 0.9em !important;
    font-weight: 400;
}
.sidebar .list-unstyled li > a > p {
    float: left;
}
.sidebar .list-unstyled li:hover a {
    color: #000;
}
.sidebar .list-unstyled li.active,
.sidebar .list-unstyled li.active:hover,
.sidebar .list-unstyled li.active:focus,
.sidebar .list-unstyled li:hover
{
    background-color: #ECEBEA !important;
    border-color: #ECEBEA !important;
}
.sidebar .list-unstyled li.active > a {
    color: #000;
    font-weight: 600;
}
.sidebar .list-unstyled i {
                font-size: 1rem;
                width: 30px;
                width: auto;
                text-align: center;
            }
.sidebar .iconsMenuContainer .list-unstyled li > a {
    color: #555;
    float: left;
}
.sidebar .iconsMenuContainer .list-unstyled i {
    width: 50px;
}
.nav.list-group > a {
    text-transform: uppercase;
    border-color: transparent;
    padding: 5px 10px;
    margin: 0 auto;
    display: block
}
.list-group-item .badge,
.list-group-item.active .badge,
.nav-pills>.active>a .badge,
.iconsMenuContainer .badge {
    background-color: #D82937;
    color: #fff;
    float: right;
    display: inline-block;
    margin: -3px 10px -10px 5px;
    padding: 3px 5px;
}
.sidebar .list-unstyled {
    margin: 0;
    text-transform: uppercase;
    border-color: transparent;
    padding: 0;
    position: relative;
}
.sidebar .list-group-item {
    background: transparent;
    border: 0;
    margin: 0;
    padding: 0 0 0 15px !important;
}
.sidebar .list-group-item:hover {
	background: none;
}
.sidebar #Profil_section .list-group-item, .sidebar #Uzemeltetes_section .list-group-item, .sidebar #Hirek_section .list-group-item, .sidebar #Hitelesites_section .list-group-item, .sidebar #KEAESZ_section .list-group-item {
    padding: 5px 0 5px 15px !important;
}
.list-group-item:last-child {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
.list-group-item:first-child  {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
}
.sidebar .list-group-item  .list-group-item {
    border: none !important;
    padding: 5px 0 5px 5px !important;
    margin: 0;
    text-transform: none;
    font-size: 1rem !important;
}
.active_submenu > button {
  font-weight: 700 !important;
}
.sidebar .list-group-item  .list-group-item:hover, .sidebar #Profil_section .list-group-item:hover, .sidebar #Uzemeltetes_section .list-group-item:hover, .sidebar #Hirek_section .list-group-item:hover, .sidebar #Hitelesites_section .list-group-item:hover, .sidebar #KEAESZ_section .list-group-item:hover, .sidebar .list-group-item:hover .panel-heading {
    background-color: #F5F5F5 !important;
}
.sidebarTwo .list-group-item {
    border-bottom-color: #ddd;
    padding: 15px 0 15px 50px;
    margin: 0;
}
.sidebarTwo .list-group-item  .list-group-item {
    border: none !important;
    padding: 15px 0 15px 0;
    margin: 0;
}
.sidebar .iconsMenuContainer .list-group-item {
    padding: 0 0 0 0 !important;
    margin-left: 0 !important;
    float: left;
}
a.list-group-item:focus,
a.list-group-item:hover,
button.list-group-item:focus,
button.list-group-item:hover {
    color: #555;
    text-decoration: none;
    background-color: transparent;
}
.sidebar .btn-block {
    width: 60%;
    margin: 15px auto;
    margin-top: 10px;
}
.sidebar .list-group {
    margin: 0;
    box-shadow: none;
}
.bordered-block {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    width: 100%;
    padding-top: 5px;
    padding-bottom: 5px;
}
.head-link {
    font-size: 0.8rem;
    position: relative;
    bottom: -12px;
}
a.head.underline,
a.head.underline:hover,
a.head.underline:focus,
a.head.underline:active {
    font-size: 1.5rem;
    color: #000;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    position: relative;
    z-index: 10;
    margin-bottom: 20px;
}
a.head.underline > i {
    margin: 10px 0 0 0;
    font-size: 1rem;
    color: #969696;
}
.sortby {
    position: relative;
    bottom: -7px;
}
.sortby a {
    padding-bottom: 3px;
    border-bottom: 2px solid transparent;
    color: #000;
}
.sortby a:hover,
.sortby a:hover,
.sortby a:focus,
.sortby a.active {
    color: #004b88;
    text-decoration: none;
    border-bottom: 2px solid #004b88;
}
.block-container .btn-lblue {
    margin-right: 30px;
    padding: 5px 10px;
}
.block-container .btn-lblue:last-child {
    margin-right: 0;
}
.dropdownCont {
    position: relative;
    display: inline-block;
}
.content-wrapper {
    margin-left: 300px;
    position: relative;
    -webkit-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
}
p.more {
    margin-top: 10px;
    padding: 0 10px;
}
p.more a {
    font-size: 0.8rem;
}
.iconsMenuContainer ul>li>i {
    width: 100%;
    display: block;
    padding: 15px 0 15px 0;
    position: relative;
    color: #fff;
    border-bottom: none;
    font-weight: 400;
    font-size: 0.8rem;
    text-transform: uppercase;
}
.iconsMenuContainer ul>li.home> p {
    padding-left: 50px;
}
.iconsMenuContainer ul>li.home {
    display: inline-block;
    background: url('../repo03/get_image.php?img=7440639225147689') no-repeat 16px 50%;
    background-size: 16px;
    height: 46px;
}
.iconsMenuContainer ul>li.home:hover,
.iconsMenuContainer ul>li.home.active,
.iconsMenuContainer ul>li.home.active:hover {
    background: url('../repo03/get_image.php?img=7441402745137933') no-repeat 16px 50%;
    background-size: 16px;
    height: 46px;
}
#Icons_menu_container button.home {
    display: inline-block;
    background: url('../repo03/get_image.php?img=7440639225147689') no-repeat 16px 50%;
    background-size: 16px;
    height: 46px;
}
#Icons_menu_container button.home:hover,
#Icons_menu_container button.home.active,
#Icons_menu_container button.home.active:hover {
    background: url('../repo03/get_image.php?img=7441402745137933') no-repeat 16px 50%;
    background-size: 16px;
    height: 46px;
}
.iconsMenuContainer ul>li.keaesz {
    display: inline-block;
    background: url('../repo03/get_image.php?img=7816266914042381') no-repeat 16px 50%;
    background-size: 24px;
    height: 46px;
}
.iconsMenuContainer ul>li.keaesz:hover,
.iconsMenuContainer ul>li.keaesz.active,
.iconsMenuContainer ul>li.keaesz.active:hover {
    background: url('../repo03/get_image.php?img=7918444481277129') no-repeat 16px 50%;
    background-size: 24px;
    height: 46px;
}
#Icons_menu_container button.keaesz {
    display: inline-block;
    background: url('../repo03/get_image.php?img=7816266914042381') no-repeat 16px 50%;
    background-size: 24px;
    background-position: center;
    height: 46px;
}
#Icons_menu_container button.keaesz:hover,
#Icons_menu_container button.keaesz.active,
#Icons_menu_container button.keaesz.active:hover {
    background: url('../repo03/get_image.php?img=7918444481277129') no-repeat 16px 50%;
    background-size: 24px;
    background-position: center;
    height: 46px;
}
#Icons_menu_container button.oldMohu {
    display: inline-block;
  background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAAA5CAYAAACGRC3XAAAACXBIWXMAAAsTAAALEwEAmpwYAAAF8mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDYgNzkuZGFiYWNiYiwgMjAyMS8wNC8xNC0wMDozOTo0NCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIyLjQgKFdpbmRvd3MpIiB4bXA6Q3JlYXRlRGF0ZT0iMjAyMS0wNy0xNVQxMTowMjoyMCswMjowMCIgeG1wOk1vZGlmeURhdGU9IjIwMjEtMDctMTVUMTE6NTQ6NDkrMDI6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMjEtMDctMTVUMTE6NTQ6NDkrMDI6MDAiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6ODM1ODlhNDAtOTc0Mi1kNDQwLWI0YmItMzg0ZTYyMjNhZTVmIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6MDZiYjgwODQtZWQ4Ny1jNTQ3LTk0MTItMjdlNzM4YjkyM2RkIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6YzExM2FhM2MtMWFiMS05YjQ2LWExZmItMzU3MGQ0M2QzOTIyIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDpjMTEzYWEzYy0xYWIxLTliNDYtYTFmYi0zNTcwZDQzZDM5MjIiIHN0RXZ0OndoZW49IjIwMjEtMDctMTVUMTE6MDI6MjArMDI6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi40IChXaW5kb3dzKSIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ODM1ODlhNDAtOTc0Mi1kNDQwLWI0YmItMzg0ZTYyMjNhZTVmIiBzdEV2dDp3aGVuPSIyMDIxLTA3LTE1VDExOjU0OjQ5KzAyOjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuNCAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+xgGV4wAABrxJREFUaIHVm1mMVEUUhr8ZdgmyKmqigIgaRYkGFVdMXEAIkEA0EqNGxiVqeDAYNGp4MWrcgj64i7sjREUghNU4BhNRVNBx12F1RUGCK+gMvw91G256qk7d7r7djn/Smcut/69T2606daqok0QHRj/gYuBc4FjgQGAXsB5YA7wMrK7IgqSO+pslaafiWC7puHLt1HXAEdAbWAqcWqLuMuD5Uo11tAboBHwODCtTX3IjdLQGeAWYUmEehwMbs5LrKzSWJ86k8srD/3gEvAmMzimv44GPsxCrMQI6A0OA44AjgZ4ZNAOIV74RuBy4Edga4TZksOmQ47I1QdI8Sd8VLVPbJa2UNE1SfUB7YWSpu6WI31/SNoO/PWu586j4sZKaIhUooEXSJE8eMwzNpoDdGyK2zstS/ko/gQuAZuDsjPyhwALglqL3nQ1NaLi/ELF1daYSldHjhd+JGXs9hOtTeV1r8HZJOiRQhmWG7i9JPQK6TJ5gJ+Ac4AzgMKAL8AvwAbAOWJS8rwTDgBbgFOAdg3czcLfn/UXAPEN3BfCMWYJAy9wkaUtZ/VoamlI2fzB4X8pfzk6SfjV0iwO64CQ4TNJH5damTByW2J4d4Z0gfyXmGJo/FPkM0pPgEGAtzomoBDuBacBwYALwSYRfmKwejfBCa/tjhmY/nC8ShvYNpeL1uxy0qf3WtIuknw3NxhT3M4P3q8I9+bWhO9/Q7R0Bs4FDIj2QBUtp74L+AzxgaAYDo5JnaxT0wi27Pvxm6LobadQD/YHpFqkE/B14/3RENy35+2KEd5vn3THACEPzp5mjbC+sgNfl3Fxrppbcmt0nMNzeMXQ7tc9NXhKx8ZCkgyR1kzRa0vcR/hGB8uxdBZYa4lZJ41OCHhG+JF0ZMNYQ0RXsTI7wJNfQWzPwNheV4SBJIyT1UqoBWowM7lf7isTW3jUeDZJ6y02SISxMcXcYvFIwM5Xng3INJ7nN0kwlDWDN0GPkr8zDEcOHBnSvRnQ9E97UCC8LdkjqLNvHaEBuGQrhVvkrMipifFZANymiu0rZGyuGM5N8+hucb5Gb4EJokb8isYYL6epkD+93i/iLDK6FS1N5jDB4u+qBJmORGAqcFkh7LqI72bfo4A4zQjgZ55EWMBG40+AX4yvcBi4dF9xg8Dci54tbWCV/bw6K6JoCupERXaNHM1zSkwrP/OskTQ/YQ+HgybjOwBZcrK1/0kNp1AG/B1pvM2672TegC3ln7wPX4Tw0n84XAPkEuDLRDAcGJc/bcNvp9QFbBcwG2oBrcMdrG4B7gSUdKSpcK3THnS8CHSss/p/AisVlxXm4iE5rIH0O8HPyPCDhD8dtvtpwpzhrgeXAHo/+ctyW1ve57AFux78HacCdEvl0rYmuNegjl/CLhbRnynmBcyT9ZvA2yfkPxaHzOyL5TwmUa3ZEN1bKJywec6e3yfY2i/GlXMC1kHdPSbsN/opAmfpF7DQqxwaYVUIFs2JUKv8XI9y+gXItNjS7JXXN62jsqZzySeMt3A0RiEV23bG4D1Z8oSswMc9VYA1wUl6ZJVgOjE2efwQGBnjN+IMi3XATcK+A7qk8D0cfzzGvAsbg7gYBzDV4xwNHe97vxna9B+fZAK/QfskJ4W9gIbAkA/eG5O/DEd4VgffNhqZ7XpNg4bcgw+S2QdLglGak7MtQ6ZPeLwze92WUaWXe9wOezcC5FNiU+vf7wEyD3w8Ynzw/YfAOBp7EOToFXAtMMjTr83aF63Dnh30C6W1AD1yoPI1uuAOVbgHdfNz1mQOAnyJl2AC8hwu3nxLhjsv7E0Bu2xrCHrmtrU8339C1aV8gc4XBKwU7pMrvB/hgDdM63Cfgg+VL1AOTk+cbyymUBzOAqt0U/cZo+a2GztorvJ3i3VVaZ7fDG4W8qtUAsQ3M6QHdIxFd+qJEzD0OYZ32RYurdk8wdsQVWrOfKUF3Cf5LExZeBUaS3roHeiKP38dGL1ifgXUx4wsPf5Sk1+ROsUJYpcC2uZoRoRnAfUb6WJyvX4w7aH+JKo0TgA897w8FzsJFpHsDf+H8jdXAp8HcqjgCBho9IklzA7qjIrrH8yxntWOCTYSv0P2Diyj/4Ulrxt009aEV2B/XwxWj2pel5xhpXQi7qT6XejNwD26H2FZhufai2iOgK66HQ8HXVfjvCB+IOx/YhdvOvgQsI/tuMzNqERZvBKYa6QPx+/cTcT79D9UoVAG1+P8C1mcA4bO/RVS58lCbBngD2B5I+9NIqwlq0QCi/Sh4HXcxaghwUw3KEEStjsZG4IIVi3FuckstjGbBvxJ5Ii0kYifVAAAAAElFTkSuQmCC) no-repeat 14px 50%;
    background-size: 20px;
    height: 46px;
}
#Icons_menu_container button.oldMohu.active,
#Icons_menu_container button.oldMohu:hover {
 background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAAA5CAYAAACGRC3XAAAACXBIWXMAAAsTAAALEwEAmpwYAAAF8mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDYgNzkuZGFiYWNiYiwgMjAyMS8wNC8xNC0wMDozOTo0NCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIyLjQgKFdpbmRvd3MpIiB4bXA6Q3JlYXRlRGF0ZT0iMjAyMS0wNy0xNVQxMTowMjozOSswMjowMCIgeG1wOk1vZGlmeURhdGU9IjIwMjEtMDctMTVUMTE6NTY6MDIrMDI6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMjEtMDctMTVUMTE6NTY6MDIrMDI6MDAiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6ZmM1ODQ1NDgtZDMwOC03NTQ3LTg4MTAtNTkyNWU3NzA1MzFmIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6ZjhlYTJhYjAtYzQ4ZS00YzQwLTg5M2YtYmUxNTRmYWViZjc1IiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6N2UzMGZlMjYtYmViYS0zNjQzLWE1NTgtYTNhYTg1ZTE4MWRiIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo3ZTMwZmUyNi1iZWJhLTM2NDMtYTU1OC1hM2FhODVlMTgxZGIiIHN0RXZ0OndoZW49IjIwMjEtMDctMTVUMTE6MDI6MzkrMDI6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi40IChXaW5kb3dzKSIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZmM1ODQ1NDgtZDMwOC03NTQ3LTg4MTAtNTkyNWU3NzA1MzFmIiBzdEV2dDp3aGVuPSIyMDIxLTA3LTE1VDExOjU2OjAyKzAyOjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuNCAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+S8IJ2wAABfVJREFUaIHlmmuIVVUUx3/T+ETEtDKTzOyNZqKIDoVF5ZSZJT2E+lCDj5CKCBlQKDCipOzBGJSFzHwoUAwfZUiaVlNSWhaZ9tIaXz0sSTO18jnePqxznOOds9Y699xz74j+YTHDPeu/11r7nL332mvvCk5u9ADuAUYCA4CewEFgM7AWWACsaTPvSozpwF4g58h7wMA28rEk6Aasxg88X+5rC2ezRiXwI4UHf8p0wkLSBx9Kv7J7nRFGUHzwOeCTcjueFT4imw7I0caTYjvkMxwIXAZ0ScA5Gz+oucD9QC3wh6M7K6tgCsFtwJvAb3nO7AZWAhOAMxTuOOyAHsvTPwvYZejvziimRBgANBrORKUJGBvTRq3B2abYneLYqi42sCS4BWh2HEnyRqcZup8rts9xbCzIID4TQxwHPHk40taDht5BoLfiw3KDdwDo7AVR6TyrBmoCGQdcD5wbGFiCZG1pMRqZ2P4KbE1S9NoBfwKfxjw7HPil8ZqAr9M4Nw34meyWJU0aIzZ/N/Q2KX5WAvsM3tJCA78UWF+GwKNyQWC7ztEbrPjcYHD+JcEwCNEP2J9BQH8D45HVYQzwjaP/dGD/ckfvZcXvYQ5vUJLgK2m9fqeRZlpnYe2RMaxxtkZ0vzf09hn+/2TwbrICDxOTOvSZthAsQ954FEewM7MLgarg/9cMva7IshuH/Qavk/EMkKwqq/G8WLHR2+HNSehL3ErQHzsXGel1gJWFhfI+kuZaM3UOWbPPVOx8ZvD20vI1vuvYeAXoBXQErgN2OPqXeB2wzCAfBW6N6HZ29HPo6/lEhxfaudPRCzt6ZwK97Xk+9EImxa7RH5uMBl6MCcRbe9cqHdAN+1NdEtHdkyC4JDI10uZLSMflkM3S8WfWDH2zEsxsx3AfhbfI4YVb53szCH4Pkg2CnmNMBFmGtEYeVwKpcoxPV3hjHd4DBXSWJyOCdqyJ9VeQCU5TaFICAbvjNF4F9uedv/N7J2Xw0eLoIEPvIMhbthq7WgnmSYc3TOHNcXj5Rc0ZBQS+Cbghj9/V0P8BJBe3Gl2lBNLX4TUqvKEOb14M50qgHn3mXwc8otgDvXgyuh2y66uhZaxEUQH8ozS6Hcn5uys8LTv7EngIydDieDtjON8iy2snpDP6Bv/vQobbZsVWiDpkBZqMHK9tAZ5Hco7TDm5qfFqhIoM2qoHhSNYYhwYk1wApf1cjn3Fv5LPcCnyFHHIei+HXIOX1uOFyDHgKqQzlYyJwkcI7GvA0nwuCV9KeimSBDdj1hm1I/pBfOvdWgbsUv+oc3qgiYm4FK53ehZ1txi1lQyJtdwEOGforFJ96OHbiVpvUmO4YSyNVkfbnOrrdFb+WGpxDQIci4z6O8wsMLokcQd4iyLxh6T6q+OXtKe4uPvQWrC0guKSyPNK+dR64XvGpI/bOtaHYoKOYlCCgNDIgaH+Wo3eF4pdVNf5AO6xMg/ByQxIcRvb/STKxKcHf2Y7eeOX3DQYn86Tobfw3ugUphIYYin0ZKnrSu9HQ25HCp5VpA9Vwh2EslGtieJMdTlgu8+qX9ZyY3FlnjjnsKnQqePv9o8g5QT460lKuipNFgZ53IpxDNkbzsYuwoWhl9qJQbxg8hqTBcVhs8JppKWSuMPQKkT3ZhNsawx3DMxXeGIdXE+hd5egllQnZhBuPXwzDcfv9ENZeYXVE7xlDL4l8WHyINrwNTNxECPCqw4se33npsSbraKkWlwz9HSfqFZ43fPKr1M86+vmyEPtSSKawjsWtYWBdzNgYo18FvIWsMBpvFcq2OYuCiIZa4AXj+SikCJKPGbS+RBXFYOKvvfQBrgUuRuoPB5AawxrgO9fbEiC8S6TJfIXnXZSYo/BOSjSiB3IY/RbpBoN3hAKuvXjIcjMUB2u72Z74S5MAr8f8th14DjmvbC7Sr7KhA/LGtLf5scLrGTw/ALyBpKylnK9KinnYY7qnwrsdOK8cDpYaN5IuJygLSj0HgKSd2u3t/4xnpxRmcuJbX4lUcLTP/5TDIOAL4AkSXFoqJ/4HUuh/UzsA4foAAAAASUVORK5CYII=) no-repeat 14px 50%;
    background-size: 20px;
    height: 46px;
}
.iconsMenuContainer ul>li:last-child>a {
    border-bottom: 0;
}

#Icons_menu_container button:hover,
#Icons_menu_container button.active,
#Icons_menu_container button.active:hover {
    color: #000;
    background-color: #ECEBEA !important;
    border-color: #ECEBEA !important;
}

.iconsMenuContainer ul>li:hover>i,
.iconsMenuContainer ul>li.active>i,
.iconsMenuContainer ul>li:hover>p,
.iconsMenuContainer ul>li.active>p {
    color: #000;
}
.iconsMenuContainer ul>li>i, .iconsMenuContainer ul > li > p {
    color: #fff;
    -webkit-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
}
.iconsMenuContainer button .badge {
    background-color: #D82937;
    font-size: 0.6rem;
    position: absolute;
    left: 24px;
    top: 8px;
}
.sidebar.toggle .iconsMenuContainer.visible {
    visibility: visible;
    width: 50px;
}
footer {
    margin: 0 -30px;
    background: #E1F0FA;
    padding: 0 15px;
    position: relative;
    bottom: 0;
    z-index: 10;
    -webkit-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
}
#footer-linkek span {
    padding-left: 10px;
}
#footer-linkek {
    text-align: right;
}
footer .pagination {
    margin: 10px 0;
}
.table.inbox>tbody>tr>td,
.table.inbox>tbody>tr>th,
.table.inbox>tfoot>tr>td,
.table.inbox>tfoot>tr>th,
.table.inbox>thead>tr>td,
.table.inbox>thead>tr>th {
    border-top: none;
}
.table.inbox th:nth-child(4),
.table.inbox>tbody>tr>td:nth-child(4) {
    text-align: right;
}
.table.inbox.table-hover>tbody>tr:hover {
    background-color: #F5F7F6;
}
.table.inbox>thead.fixed {
    position: fixed;
    background: #fff;
}
.filter .searchForm .input-group {
    width: 95%;
    margin: 5px 0 10px 10px;
}
.filter .searchForm .input-group button {
    background: transparent;
}
.dropdown-menu.filter > li > a {
    padding: 5px 25px;
}
.dropdown-menu.filter .divider {
    margin: 0;
}
span.text-required {
    color: #D82937;
}
a.help {
    display: inline-block;
    font-size: 1rem;
}
.dropdown-menu.filter.open {
    display: block;
}
.table.inbox .dropdown-menu {
    z-index: 9;
}
.dropdown-menu.editAccount i.fa,
.dropdown-menu.editTags i.fa {
    margin-left: 10px;
}
.dropdown-menu.editAccount li form span,
.dropdown-menu.editTags li form span {
    display: inline-block;
    padding: 10px 0 10px 10px;
    color: #000;
}
.dropdown-menu.editAccount .inputEditable button,
.dropdown-menu.editAccount .inputEditable button > span,
.dropdown-menu.editTags .inputEditable button,
.dropdown-menu.editTags .inputEditable button > span {
    background: none;
    padding: 0;
    margin: 0;
    border: none;
}
.dropdown-menu.editTags li form span {
    margin-left: 15px;
}
.dropdown-menu.editAccount .inputEditable .inputEditable-input,
.dropdown-menu.editTags .inputEditable .inputEditable-input {
    display: inline-block;
    width: 60%;
    margin-left: 10px;
}
.dropdown-menu.editAccount .inputEditable i.fa,
.dropdown-menu.editTags .inputEditable i.fa {
    margin-left: 5px !important;
}
.sidebar .nav .list-group-item .fa {
    margin-right: 10px;
    font-size: 1.4rem;
}
.sidebarTwo {
    height: 100%;
}
.sidebarTwo .normalMenuContainer {
    width: 315px !important;
}
.addNewDir a {
    cursor: pointer;
    color: #000;
    font-size: 1.4rem;
    display: block;
}
.addNewDir a > .fa {
    margin-right: 10px;
}
.sidebarTwo .list-unstyled li:last-child {
    border-bottom: none;
}
.sidebarTwo .list-unstyled li:first-child {
    border-bottom: 1px solid;
}
/*
.roundContainer {
    width: 120px !important;
    display: block;
    height: 120px;
    vertical-align: middle;
    text-align: center;
    padding: 0px;
    margin: 15px auto;
}
*/
.roundContainer_admin {
    width: 40px !important;
    display: table;
    height: 40px;
    vertical-align: middle;
    text-align: center;
    padding: 3px;
    margin: 5px auto;
}
.roundContainer_lang {
    width: 28px !important;
    display: block;
    height: 28px;
    vertical-align: middle;
    text-align: center;
    padding: 0px;
    margin: 0;
   background:#004b88;
 border-radius:100%;
 color:#fff;
 padding:4px;
 margin:-6px 0 0 5px;
 font-size:0.8rem;
}
.roundContainer_lang span {
    text-align: center;
    width: 100%;
    height: 100%;
    font-size: 14px;
    vertical-align: top;
    padding-top: 4px;
    font-weight: 700;
}
.fooldal .roundContainer_lang {
    width: 32px !important;
    display: block;
    height: 28px;
    vertical-align: middle;
    text-align: center;
    padding: 0px;
    margin: 0;
   background:none;
 border-radius:none;
 padding:5px;
 margin:-7px 0 0 5px;
}
.fooldal .roundContainer_lang span {
    text-align: center;
    width: 100%;
    height: 100%;
    font-size: 14px;
  color: #000;
    vertical-align: top;
    padding-top: 4px;
    font-weight: 700;
} 
.roundContainer span {
    display: block;
    text-align: center;
    color: #fff;
    width: 100%;
    font-size: 1.8rem;
    vertical-align: middle;
    padding-top:32%;
}
.roundContainer_admin span {
    display: table-cell;
    text-align: center;
    color: #fff;
    width: 100%;
    height: 100%;
    font-size: 0.7rem;
    vertical-align: middle;
}

.block-container .roundContainer-title.roundContainer-title-long{
    display: none;
}

#top10_list .list-group-item {
    padding: 0 !important;
    margin: 5px 0px !important;
    width: 100% !important;
}

#top10_list .block-container {
    position: inherit;
    min-height: 30px; 
    display: flex;
}

#top10_list .block-container .roundContainer {
    max-height: 145px !important;
/*    height: auto !important; */
}

#top10_list p {
    font-size: 0.9rem !important;
    font-weight: 700;
    padding: 5px 0 5px 10px !important;
    /*position: absolute;*/
    /*top: 50%;*/
    /*transform: translateY(-50%);*/
    line-height: normal !important;
    margin: 0 30px 0 0;
    border-left: 3px solid #fff;
    border-bottom: 0;
}
#top10_list button.service1 {
    border-left: 3px solid #fff !important;
    border-color: #00659f !important;
    padding-left: 10px;
}
#top10_list button.service2 {
    border-left: 3px solid #fff !important;
    border-color: #25a0af !important;
    padding-left: 10px;
}
#top10_list button.service3 {
    border-left: 3px solid #fff !important;
    border-color: #009ee3 !important;
    padding-left: 10px;
}
#top10_list button.service4 {
    border-left: 3px solid #fff !important;
    border-color: #91b74f !important;
    padding-left: 10px;
}
#top10_list button.service5 {
    border-left: 3px solid #fff !important;
    border-color: #c20029 !important;
    padding-left: 10px;
}
#top10_list button.service6 {
    border-left: 3px solid #fff !important;
    border-color: #ffcc00 !important;
    padding-left: 10px;
}
#top10_list button.service7 {
    border-left: 3px solid #fff !important;
    border-color: #f2f2f2 !important;
    padding-left: 10px;
}
#top10_list button.service8 {
    border-left: 3px solid #fff !important;
    border-color: #f15736 !important;
    padding-left: 10px;
}

.top10_szolg {
  float: left;
  width: 100% !important;
}
.top10_nyil {
  float: left;
  width: 20px !important;
  height: 20px;
}
.top10_nyil img {
  width: 20px;
  height: 20px;
  margin: 0px !important;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
}

.kereses_grid {
    width: 100%;
}

#kereses_talalatok p.cim:after {
    content: '\00A0\00BB';
}

#szolg_ABC div.panel-heading {
  display: none;
}

#szolg_ABC div.panel-body {
  border: 0;
}

/* forced list view */
    .szolg-list-view-by-subcategory {
        border: 0 !important;
    }
@media (min-width: 769px) {

    .szolg-list-view .roundContainer-record{
        width: 100% !important;
        margin:0 !important;
        padding: 0;
        min-height: 45px;
        /*border-bottom: 1px solid #ddd !important; */
    }
    .szolg-list-view .roundContainer-record .block-container{
        position: inherit;
        display: flex;
        min-height: 45px;
    }
    .szolg-list-view .block-container .roundContainer{
        width: 3px !important;
        display: block;
        max-height: 45px;
        vertical-align: middle;
        text-align: center;
        padding: 0px;
        margin: 0px;
        float: left;
    }
    .szolg-list-view .block-container .roundContainer span {
        display: block;
        text-align: center;
        color: #fff;
        width: 100%;
        font-size: 0.9rem;
        vertical-align: middle;
        padding-top:36%;
    }
    .szolg-list-view .block-container .roundContainer-title{
        display: inline-block;
        margin: auto 0;
        font-size: 1rem !important;
        text-align: left;
        margin-left: 15px;
        /*margin-top: 20px;*/
        font-weight: 700;
        width: auto;
        border-bottom:1px solid transparent;
          -webkit-transition: color 0.5s ease-out, border-bottom 0.5s ease-out;
  transition: color 0.5s ease-out, border-bottom 0.5s ease-out;
    }
    .szolg-list-view .block-container .roundContainer-title:hover{
        border-bottom:1px solid #000;
    }
    .szolg-list-view .block-container .roundContainer-title .roundContainer-title-long{
        display: block;
    }
}
@media (max-width: 768px) {
    #top-nav_Search{width: 100% !important; padding: 24px 0 6px 0 !important;}
    #top-nav_Search_80{width: auto !important; padding: 24px 0 6px 0 !important;}

    .roundContainer-record .block-container{
        margin-top: 15px;
        margin-bottom: 0px;
        position: inherit;
        /* display: flex; */
        min-height: 50px;
    }
    .roundContainer-record{
        width: 100% !important;
        margin: 0 !important;
        padding: 0;
    }
    .roundContainer {
        width: 50px !important;
        display: block;
        height: 50px;
        vertical-align: middle;
        text-align: center;
        padding: 0px;
        margin: 0px;
        position: absolute;
        top: 50%;
        margin-top: -25px;
    }
    .block-container .roundContainer{
        width: 3px !important;
        display: block;
        height: 50px;
        vertical-align: middle;
        text-align: center;
        padding: 0px;
        margin: 0px;
        position: absolute;
        margin-top: -25px;
        top: 50%;
    }
    .roundContainer span {
        display: block;
        text-align: center;
        color: #fff;
        width: 100%;
        font-size: 0.75rem;
        vertical-align: middle;
        padding-top:31%;
    }
    .roundContainer-title{
        display: block;
        margin: auto 0;
        font-size: 0.9rem !important;
        text-align: left;
        padding-left: 25px;
    }

    .block-container .roundContainer-title.roundContainer-title-long{
        display: block;
    }
    .del_favorite {
        position: relative;
        left: 50px;
    }
}
.roundContainer.service1, .roundContainer_admin.service1, .roundContainer_lang.service1 {
    background: #00659f;
}
.roundContainer.service2, .roundContainer_admin.service2 {
    background: #25a0af;
}
.roundContainer.service3, .roundContainer_admin.service3 {
    background: #009ee3;
}
.roundContainer.service4, .roundContainer_admin.service4 {
    background: #91b74f;
}
.roundContainer.service5, .roundContainer_admin.service5 {
    background: #c20029;
}
.roundContainer.service6, .roundContainer_admin.service6 {
    background: #ffcc00;
}
.roundContainer.service7, .roundContainer_admin.service7 {
    background: #f2f2f2;
}
.roundContainer.service8, .roundContainer_admin.service8 {
    background: #f15736;
}
#Focsoportok {
    padding: 15px 0 15px 0;
}
#top-nav {
    height: 125px;
    overflow: hidden;
    /* padding-right: 40px !important; */
    padding-left: 25px;
    padding-right: 25px;
}
#main-RNY {
    padding-left: 5px;
}
#top-nav-RNY {
    height: 125px;
    overflow: hidden;
    /* padding-right: 40px !important; */
    padding-left: 0px;
    padding-right: 0px;
    padding-top: 0px;
}
#border-RNY {
  margin-top: 5px;
}
#top-nav_Search #search,  #top-nav_Search_80 #search {
    height: 35px;
    padding: 0 12px !important;
    border-color: #101010;
   
}

#top-nav_Search #search:focus,  #top-nav_Search_80 #search:focus{
  border-color: #3333FF!important;
}

.input-focused #top-nav_Search #search input,  .input-focused #top-nav_Search_80 #search input {
   border-color: #58585a;
  /*border-color: #3333FF;*/
}


.fooldal #top-nav_Search {
  padding: 0 !important;
}
.fooldal #top-nav {
    padding-right: 15px !important;
}

#Hirek0, #Hirek1, #Hirek2, #Hirek3, #Hirek4, #Hirek5, #Hirek6, #Hirek7, #Hirek8, #Hirek9 {
    padding: 30px 10% 30px 10%;
}
#Hirek_fooldal img {
    cursor: pointer;
}
#Focsoportok .list-group-item {
    border: none !important;
    padding: 0px 10px 40px 10px;
}    
#Focsoportok a h4 {
    color: #00659f;
    font-weight: bold;
    font-size: 1.429em;
}
#Focsoportok a p {
    color: #000;
}
.bx-wrapper img {
    cursor: pointer;
}
.searchOverlay {
    position: fixed;
    z-index: 95;
    width: 100%;
    left: 0;
    right: 0;
    bottom: 0;
    background: #fff;
    opacity: 0.9;
    padding: 100px 50px 50px 50px;
}
.searchOverlay h3 {
    color: #F15736;
    margin-bottom: 15px;
}
.searchOverlay li a {
    color: #000;
    font-size: 1.2rem;
}
.searchOverlay li {
    margin: 0 0 15px 15px;
}
.descCont {
    padding: 10px 0;
}
.descCont h3 {
    color: #4AAFE3;
}
.descCont {
    font-size: 1rem;
}
.descCont hr {
    border-top: 1px solid #c2cddb;
}
#avdhaszfgrid div {
    display: inline;
    vertical-align: middle;
}
.avdh_aszf_checkbox_szoveg {
    font-size: 1rem;
}
.serviceSection {
    margin-bottom: 0px;
}
.serviceSection p,
.serviceSection li a {
    font-size: 1rem;
}
.serviceSection a {
    display: inline-block;
}
.serviceSection li a {
    color: #4AAFE3;
}
.serviceSection li {
    margin-bottom: 10px;
}
.serviceSection .btnGroup {
    margin-top: 30px;
    text-transform: none !important;
}
.serviceSection .btnGroup .btn-default, .serviceSection .btnGroup .btn-primary {
    padding: 25px 35px;
}
.serviceSection .btnGroup > div:nth-child(1) {
    text-align: left;
}
.serviceSection .btnGroup > div:nth-child(2) {
    text-align: center;
}
.serviceSection .btnGroup > div:nth-child(3) {
    text-align: right;
}
.serviceSection .list-group-item {
    border: 0 !important;
}
table.services td:nth-child(1) {
    text-align: right;
    border: none;
}
table.services .block-container {
    display: inline-block;
    margin: 0;
    text-align: right;
}
table.services td:nth-child(2) {
    text-align: left;
    vertical-align: bottom;
    width: 90%;
    border: none;
}
main h1 {
    margin-bottom: 40px;
}
.has-feedback label~.form-control-feedback {
    right: 25px;
}
.help-block {
    margin-bottom: 10px;
    height: 0;
}
.text-danger {
    font-weight: 700;
    color: #D82937;
}
textarea {
    resize: vertical;
}
.sidebarTwo .nav>div {
    left: 40px;
}
.carousel-control {
    background: none;
    top: 40%;
    color: #fff;
    font-size: 2.2rem;
    opacity: 1;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid #fff;
}
.carousel-control.right,
.carousel-control.left {
    background: none;
}
.carousel-caption {
    font-size: 1.6rem;
    opacity: 1;
}
.carousel-control .glyphicon {
    top: 5px;
}
.carousel-control.right {
    right: 10%;
}
.carousel-control.left {
    left: 10%;
}
/*-----------------------
AUTOCOMPLETE
-------------------------*/

.auto .dropdown-menu {
    width: 100%;
}
/*-----------------------
MODAL - CENTER
-------------------------*/
.modal {
    text-align: center;
    padding: 0 !important;
  
}
#nyitooldal_modal {
    border: 0px !important;
    border-radius: 0;
}
.no_border {
    border: none !important;
    border-radius: 0;
    -webkit-box-shadow: none;
}
.modal-header {
    border-bottom-color: #c2cddb;
}
.modal-footer {
    border-top-color: #c2cddb;
}
.modal-content {
    padding: 15px;
}
.modal:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: -4px
}
.modal-body h1 {
    text-align: center;
    margin: 25px auto;
    font-size: 24px;
    font-weight: 400;
    font-family: 'Open Sans' !important;
    font-style: normal !important;
}
.modal-body a {
    font-weight: 400;
    color: rgb(0, 101, 159);
    cursor: pointer;
    text-decoration: none;
    font-size: 20px;
}
.modal-body a:hover {
    text-decoration: underline;
}
.modal-body .snap_clickable_text {
    text-transform: none;
    font-size: 20px;
    font-weight: 400;
    color: #337ab7;
}
.modal-body a.btn-blue,
.modal-body .btn-blue:hover,
.modal-body .btn-blue:focus,
.modal-body .btn-blue:active,
.modal-body .btn-blue.active,
.modal-body .btn-blue:active:hover,
.modal-body .btn-blue:focus:hover {
    color: #fff;
    background-color: #004b88;
    border-color: transparent;
    outline: none;
    border-radius: 4px;
    text-transform: uppercase;
   /* padding: 10px;*/
}
.modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
    min-height: 550px;
}
.modal-title {
    color: #000;
    font-weight: 700;
}
span.value {
    display: inline-block;
    padding-top: 7px;
}
.modal.msgDetails .form-horizontal .control-label {
    text-align: left;
}
.modal .modal-dialog {
    width: 60%;
}
.modal-header .close {
    float: right;
    font-size: 30px;
}
.modal.msgDetails select.form-control {
    width: auto;
    margin-left: 20px;
}
.modal.msgDetails .dropdown-toggle {
    margin: 8px 0 0 10px;
    display: inline-block;
}
.modal .nav.list-group li {
    margin-bottom: 10px;
}
.modal .nav.list-group a {
    color: #000;
}
.modal .nav.list-group a.active {
    font-weight: 700;
}
.row.leftBorder {
    border-left: 1px solid #c2cddb;
    min-height: 200px;
}
.modal .selectable {
    margin: 0 0 0 -15px;
    padding: 10px 10px 10px 20px;
}
/*
.modal .table>tbody>tr>td,
.modal .table>tbody>tr>th,
.table>thead:first-child>tr:first-child>td,
.table>thead:first-child>tr:first-child>th {
    border-top: none;
    padding-left: 0;
}
*/
.table>thead:first-child>tr:first-child>th {
    font-weight: 700;
}
.paddingLeft {
    padding-left: 20px;
}
.modal .progressContainer {
    border-bottom: 2px solid #ddd;
    padding-bottom: 15px;
    margin-bottom: 15px;
}
.modal .progress {
    background-color: transparent;
    border: 1px solid #ddd;
}

table.storageData,
table.storageData table {
    margin-bottom: 0;
}
table.storageData tr td {
    vertical-align: top;
    padding: 0;
}
table.storageData tr td p {
    margin: 0;
    padding: 0;
}
table.storageData td .square {
    width: 10px;
    height: 10px;
    margin-top: 5px;
}
table.storageData td .square.tartosTar {
    background-color: #64a350;
}
table.storageData td .square.Kuka {
    background-color: #f0ad4e;
}
.modal.settings label {
    font-weight: 400;
}
.modal.settings table .label {
    margin-left: 0;
}
.modal .head.underline {
    margin-bottom: 15px;
}
.modal.ident .head.underline {
    margin-top: 30px;
}
.modal .form-control-feedback {
    right: 10px;
}
.modal .help-block {
    margin-bottom: 0;
    height: 0;
}
.has-success .form-control {
    border-color: #3C7C30;
}
.modal.sm .modal-dialog {
    width: 40%;
}
.captcha {
    width: 100%;
    margin-bottom: 30px;
}
.captcha span {
    display: inline-block;
    font-size: 1.2rem;
    margin-right: 10px;
}
.captcha input {
    width: 50%;
    display: inline-block;
}
form.contact .has-feedback label~.form-control-feedback {
    right: 0px;
}
form.contact .help-block {
    margin-top: 0;
    padding-bottom: 5px;
}
.captcha .form-control-feedback {
    top: 25px;
    right: -5px;
}
.captcha .help-block {
    margin: 0 0 0 55px;
    font-size: 0.8rem;
    display: block;
}
.contactInfo h1,
.contactInfo h3 {
    margin: 0 0 25px 0;
}
.contactInfo p, .contactInfo span, .contactInfo strong {
    font-size: 1.2rem;
}
.contactInfo button {
    margin: 20px 0;
}
.alert .fa,
.text-danger .fa {
    font-size: 1.2rem;
    margin-right: 5px;
}
.kau-table {
    display: table;
    height: 100%;
    width: 100%;
    margin: 0 auto;
    padding-top: 10vh;
}
.kau-table .szuf_container {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}
.bgrImage {
    margin: 0 auto;
    width: 60%;
/*    background: url(../img/kau_hatter.svg) no-repeat center center; */
    background-size: 80% 80%;
}
.bgrImage > .leftSide {
    width: 50%;
    height: 100%;
    background-color: #FFFFFF;
    background-color: rgb(255, 255, 255);
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 5px;
    border: 2px solid #ccc;
    padding: 30px 20px;
}
.bgrImage #logo {
    width: 30%;
    margin: 0 auto 30px auto;
}
.bgrImage h3 {
    font-weight: 600;
}
.kau-table .buttons {
    width: 80%;
    margin: 50px auto;
}
.kau-table .buttons >.btn {
    margin-bottom: 30px;
}
.kau-table .bgrImage p {
    font-size: 1.2rem;
}
.kau-table .bgrImage p a, .kau-table .bgrImage .snap_clickable_text {
    font-weight: 600;
    color: #4AAFE3;
}
#kedvencek_mappa_list .snap_clickable_text {
    text-transform: none;
}
#kedvencek_mappa_list .list-group-item {
    padding: 5px 5px;
    margin-bottom: -1px;
    background-color: #fff;
    border: 0px;
    overflow: hidden;
}
#kedvencek_mappa_uj label {
    display: none;
}
#kedvencek_mappa_uj div, #kedvencek_mappa_uj ul {
    margin-bottom: 0;
}
/*-----------------------
DATEPICKER
-------------------------*/

.dropdown-menu .submenu-ul + .dropdown-menu.datepicker {
    left: -100px;
    top: 32px;
}
.input-daterange {
    padding: 15px;
}
.datepicker table tr td.active.active,
.datepicker table tr td.active.highlighted.active,
.datepicker table tr td.active.highlighted:active,
.datepicker table tr td.active:active {
    background-color: #004b88;
    border-color: #004b88;
    background-image: none;
}
.datepicker table tr td.today {
    color: #000;
    background-color: #E1F0FA;
    border-color: #E1F0FA;
    background-image: none;
}
/*-----------------------
TABS
-------------------------*/

            .nav-tabs > li > a {
                color: #000;
                font-size: 1rem;
                border-top: 2px solid transparent;
                padding-top: 9px;
            }
            .nav-tabs > li.active > a,
            .nav-tabs > li.active > a:focus,
            .nav-tabs > li.active > a:hover,
            .nav-tabs > li > a:hover,
            .nav-tabs > li > a:focus {
                border: 1px solid #e5e5e5;
                border-top-color: rgb(229, 229, 229);
                border-top-style: solid;
                border-top-width: 1px;
                border-bottom-color: rgb(229, 229, 229);
                border-bottom-color: transparent;
                font-weight: 700;
                background: #fff;
                border-radius: 0;
                border-top: 2px solid #00659f;
                padding-top: 9px;
            }
            .tab-content {
                border-right: 1px solid #e5e5e5;
                border-left: 1px solid #e5e5e5;
                border-bottom: 1px solid #e5e5e5;
                padding: 30px;
                margin-bottom: 15px;
            }

/*-----------------------
ACCORDION
-------------------------*/

.accordion-section-content {
    padding: 0;
    display: none;
}
.accordionmenuItem .list-inline {
    margin: 0;
    padding: 0;
}
.accordionmenuItem .head-link {
    font-size: 1.2rem;
    position: relative;
    bottom: 0;
}
.accordionmenu a > i {
    margin: 0 0 0 10px;
    color: #969696;
}
.accordionContent {
    display: none;
}
.accordion-section-content.open {
    display: block;
}
.backtotop {
    text-decoration: none;
    color: #000;
    position: fixed;
    bottom: 10px;
    right: 10px;
    display: none;
    z-index: 100;
}
/*-----------------------
MEDIA QUERIES
-------------------------*/
@media (max-width: 350px) {
    #sidebar {
        left: -25px;
    }
}
@media (max-width: 768px) {
/*    .container{
        padding-top: 0px !important;
    }
*/
    .navbar {
        min-height: 50px;
    }
    .nav-container-blue{
        padding-top: 1em !important;
        padding-bottom: 0 !important;
    }
 .sidebar .navbar-inverse {
        margin: 0;
        left: -40px;
        overflow: hidden;
    }
    .navbar #SZUF {
        margin: 6px 0 20px 0 !important;
        font-size: 2em;
    }
    .searchPanel .btn-primary {
        padding: 10px;
    }
    .file-list .progressCont span {
        left: 90%;
    }
    .modal .modal-dialog {
        width: 90%;
    }
    .carousel-control {
        width: 25px;
        height: 25px;
        font-size: 1rem;
        top: 30%;
    }
    .carousel-control .glyphicon {
        top: 0;
    }
    .bgrImage {
        background-size: 100% 100%;
    }
    .bgrImage {
        width: 80%;
    }
    .navbar-inverse .navbar-nav {
        margin-top: 0 !important;
    /* padding: 0 !important; *//* mantis 7523.A nyelvválsztó gombnál az oldal nagyításával egyre feltűnőbb, hogy a HU felírat nem a kék kör közepén van, hanem kicsit fentebb csúszva*/
    }
    .navbar-inverse .navbar-nav > li {
        padding: 0 !important;
    }
    .navbar-inverse .navbar-nav > li > a {
        padding-right: 0px !important;
        padding-left: 12px !important;
    }
    .navbar-inverse .navbar-nav > li > a > h4 {
        font-size: 1em !important;
    }
    .searchPanel .btn-primary {
        display: inline-block;
    }
    .navbar-form {
        padding-left: 15px !important;
    }
}
@media(min-width:768px) and (max-width:991px) {
    .searchPanel .btn-primary {
        padding: 10px;
    }
    .file-list .progressCont span {
        left: 90%;
    }
    .modal .modal-dialog {
        width: 70%;
    }
    .carousel-control {
        width: 25px;
        height: 25px;
        font-size: 1rem;
        top: 30%;
    }
    .carousel-indicators {
        bottom: 0;
    }
    .carousel-control .glyphicon {
        top: 0;
    }
    .block-container .btn-lblue {
        margin-right: 0;
        margin: 5px auto;
    }
    .block-container p {
        /*min-height: 45px;*/
        line-height: 45px;
    }
    .bgrImage {
        background-size: 100% 100%;
    }
    .bgrImage {
        width: 80%;
    }
}
@media(min-width:992px) and (max-width:1199px) {
    .selectable .btn {
        padding: 6px;
    }
    .carousel-indicators {
        bottom: 0;
    }
    .carousel-caption {
        padding-bottom: 10px;
    }
    .block-container p {
       /* min-height: 60px;*/
        line-height: 45px; 
    }
    .carousel-control {
        top: 20%;
    }
    .bgrImage {
        background-size: 90% 90%;
    }
    .bgrImage {
        width: 80%;
    }
}
@media(min-width:1200px)  {}

/*-----------------------
HELPER CLASSES
-------------------------*/
.wrapword {
    white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
    white-space: -webkit-pre-wrap; /*Chrome & Safari */ 
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    white-space: pre-wrap;       /* css-3 */
    word-wrap: break-all;       /* Internet Explorer 5.5+ */
    word-break: break-all;
    white-space: normal;
    display: inline-block;
}
.marginbot {
    margin-bottom: 20px;
}
.relative {
    position: relative;
}
.snap_clickable_text {
   text-decoration: none !important;
}
#hir-section .snap_clickable_text, #hirek .snap_clickable_text, #uzemeltetes .snap_clickable_text, #segitseg .snap_clickable_text, #elethelyzet .snap_clickable_text, #text-timeout {
    color: #004b88 !important;
}
#uzemeltetes .material-icons, #uzemeltetes h4 {
  line-height: 1.5;
}
.full-width-section{
    margin-left:-15px !important;
    margin-right:-15px !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
    width: auto !important;
}
.no-top-margin{
    margin-top:0px !important;
}
select option[value="service1"], select option[value="service1"]:hover {
    background: rgba(122, 166, 55, 1);
}
select option[value="service2"], select option[value="service2"]:hover {
    background: rgba(73, 111, 174, 1);
}
select option[value="service3"], select option[value="service3"]:hover {
    background: rgba(75, 44, 111, 1);
}
select option[value="service4"], select option[value="service4"]:hover {
    background: rgba(174, 17, 36, 1);
}
select option:hover {
    color: white;
}
.snap-card-fix {
    border: none !important;
    width: 250px;
    margin:10px;
}
.list-group {
    box-shadow: none !important;
    margin-bottom: 0 !important;
}
#talalatok_ugyek li, #talalatok_hirek li, #talalatok_segitseg li, #talalatok_uzemeltetes li {
    border: none !important;
}
#talalatok_ugyek .badge, #talalatok_hirek .badge, #talalatok_segitseg .badge, #talalatok_uzemeltetes .badge {
    display: none;
}
/* hamburger gomb */
.menu-button {
  display:none;
  margin-top:9px;
margin-left:-15px;
float:left;
  height: 34px;
  width: 44px !important;
}
.navbar-toggle{
  background: transparent !important;
  border: none;
  margin: 0;
  padding: 0;
  display: block !important;
}
.navbar-toggle:hover{
  background:transparent !important;
cursor:pointer;
}
.navbar-toggle .icon-bar {
    background-color: #000 !important;
    display: block;
    width: 20px;
    height: 2px;
    border-radius: 1.5px;
}
.navbar-toggle .icon-bar+.icon-bar {
    margin-top: 4px;
}
#navbutton{visibility:hidden}

@media(max-width:430px) {

    .menu-button {
        margin-top:8px;
    }
    .navbar-toggle .icon-bar {
        width: 44px;
        height: 2px;
        border-radius: 1px;
    }
    .navbar-toggle .icon-bar+.icon-bar {
        margin-top: 5px;
    }
}
.fc .alert-info{
    background: #f5f5f5;
color:red;
}
.fc-ltr .fc-time-grid .fc-event-container {
    margin: 0 15% 0 2px;
}
.fc-event .fc-bg {
    opacity: 0;
}
.fc-agenda-view .fc-day-grid{
    display: none;
}
.fc-agenda-view .fc-day-grid+hr.fc-divider{
    display: none;
}
.fc-time-grid .fc-slats .fc-minor td {
    border-top-style: hidden;
}
.margin_bottom_bo_footer {
    margin-bottom: 100px;
}
.szolg-list-view .block-container {
    margin: 5px 0;
}
.szuf_menu_kis_gombfelirat .btn {
    font-size: smaller;
}
table.dataTable thead th, table.dataTable thead td {
    border-bottom: 0;
}
table.dataTable.no-footer {
    border-bottom: 1px solid #ddd;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #fff !important;
    background: #004b88 !important;
    border-color: #004b88;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    color: #337ab7 !important;
    background-color: #fff;
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 3px 13px;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 2px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    border-color: #eee;
    background: #eee !important;
    color: #337ab7 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
    outline:0;
    background-color:#2b2b2b;
}
.dataTables_wrapper .dataTables_filter input {
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#ajax_loader img {
  background-color: #ffffff00;
  border: 0;
  box-shadow: 0 0 0 0;
  border-radius: 0;
  height: auto !important;
  width: 150px !important;
}

#top-nav {
  overflow: visible;
}
#top-nav #javaslatok {
  position: absolute;
  width: 100%;
  margin-top: 35px;
}
#top-nav #javaslatok .list-group-item-heading,
#top-nav #javaslatok .badge {
  display: none;
}

#top-nav #javaslatok li {
  cursor: pointer;
}

.tab-content-hidden .tab-content {
  display: none;
}
.naptar-menu .form-group{
  margin-bottom:0px;
}
.naptar-menu .checkbox{
  margin-top:0px;
  margin-bottom:0px;
}
.panel.panel-primary{
    border-color: #004b88;
    background: transparent;
}
.panel.panel-primary .panel-heading{
    border-color: #004b88;
    background-image: none;
    background-color: #004b88;
}

@media (max-width: 768px) {
    .szechenyi-2020 img {
        margin-bottom: -50px !important;
    } 
    .navbar-default-nisz-footer {
        margin: 40px 25px 0 25px;
    }
}
.szechenyi-2020 img{
    max-width: 269px;
    /* margin-top: -196px; */
    margin-right: -15px;
    margin-bottom: -45px;
}
#SZUF-SM.fooldal {
    height: 30px !important;
}
/*7312-mantis*/
 .fooldal_szuf_logo_szuf_logo_new{
    height: 55px;
    width: auto;
    background:   url(get_image.php?img=7838741705126680) 0 0 no-repeat;
    position: static;
    margin-left: 100px !important;   
    margin-top: 12px !important;    
}

/*material-input*/
div.material-input input[disabled],
div.material-input input[readonly],
div.fixed-material-input input[disabled],
div.fixed-material-input input[readonly]{
    background-color: #F7FAFF !important;
    border: 1px solid #D3D9E5;

}
div.material-input .invalid_input,
div.fixed-material-input .invalid_input{
border: 1px solid red !important;
}
div.material-dropdown .bootstrap-select.invalid_input{
border-left: 0px !important;
}
div.material-dropdown .bootstrap-select.invalid_input .dropdown-toggle{
border: 1px solid red !important;
}
.inline-checkbox .checkbox{
    padding-right: 25px;
    display: inline-block;
    width: auto;
}
div.material-input div.form-group.vcenter,
div.fixed-material-input div.form-group.vcenter{
    position: relative;
}
div.material-input label,
div.fixed-material-input label{
    position: absolute;
    font-weight: 400;
    font-size: 12px;
    color: #888D9A;
    top:9px;
    left:21px;
    transition: all 0.15s ease-in-out;
    z-index: 5;
}
div.material-input label .required_field{
    position: absolute;
    padding-left: 2px;
    top:0;
    font-size: 10px;

}
div.material-input.input-focused label,
div.material-input .input-focused label,
div.material-input.input-has-value label,
div.material-input.input-has-value-mask label,
div.fixed-material-input label{
    font-size: 11px;
    /*top: -10px;
    left: 18px;*/
    top: -18px;
    left: 4px;
    background: #fff;
    padding: 0 4px;
    /*font-family: SourceSansPro-Semibold;*/
    z-index: 5;
    color:#888D9A;
}
div.material-input.input-has-value.input-disabled label,
div.material-input.input-has-value.input-readonly label{
    background-color: #D3D9E5;
    border-radius: 9px;
    color: #888D9A;
}
div.material-input.input-disabled label,
div.material-input.input-readonly label{
    background-color: #F7FAFF;
    border-radius: 9px;
    color: #888D9A;
}
div.fixed-material-input.input-disabled label,
div.fixed-material-input.input-readonly label{
    background-color: #D3D9E5;
    border-radius: 9px;
    color: #888D9A;
}

/* DARKMODE */

.darkmode{
    background-color: #2c2c2c;
    color: #fff !important;
}
.darkmode body, .darkmode #MainMenuDefault button {
    background-color: #2c2c2c;
    color: #fff !important;
}
/*.darkmode div{
    background-color: #2c2c2c;
}*/
/*.darkmode .snap_clickable_text{
   color: #5C9AD1; 
}*/

.darkmode .ugyleiras_torol{
   color: #5C9AD1 !important; 
}
.darkmode ul.list-group.list-inline.list-unstyled.pull-right a{
   color: #5C9AD1 !important; 
}
.darkmode #hir-section .snap_clickable_text, 
.darkmode #hirek .snap_clickable_text, 
.darkmode #uzemeltetes .snap_clickable_text, 
.darkmode #segitseg .snap_clickable_text, 
.darkmode #elethelyzet .snap_clickable_text,
.darkmode #esemenynaplo_lista .snap_clickable_text, 
.darkmode #piszkozat_lista .snap_clickable_text,
.darkmode #ntsz_form .snap_clickable_text,
.darkmode .uzemeltetes_cim .panel-title a,
.darkmode #text-timeout{
   color: #5C9AD1 !important; 
}
.darkmode #hirek_cim, .darkmode #top10_title, .darkmode .fooldal .roundContainer_lang span {
  color: #fff !important;
}
.darkmode .fc a{
  color: #fff !important;
}
.darkmode .fc-list-heading{
  background-color: #2c2c2c !important;
}


.darkmode .navbar-inverse{
    background-color: #2c2c2c;
}
.darkmode h1,
.darkmode h2,
.darkmode h3,
.darkmode h4,
.darkmode h5{
    color: #fff;
}
.darkmode .list-group-item {
    background-color: #2c2c2c;   
}
.darkmode #mappa_mod_gomb .list-group-item {
    background-color: #fff;
}
.darkmode .iconsMenuContainer .list-group-item {
    background-color: #6D6E72;
}
.darkmode .navbar-default-nisz-footer ul.links li {
    background-color: #2c2c2c;
}
.darkmode .navbar-default-nisz-footer ul.links li a p,
.darkmode .navbar-default-nisz-footer ul.links li a:hover p,
.darkmode .navbar-default-nisz-footer ul.links li a:active p,
.darkmode .navbar-default-nisz-footer ul.links li a:focus p,
.darkmode .navbar-default-nisz-footer ul.links li a:visited p,
.darkmode .navbar-default-nisz-footer ul.copy li a p,
.darkmode .navbar-default-nisz-footer ul.copy li a:hover p,
.darkmode .navbar-default-nisz-footer ul.copy li a:active p,
.darkmode .navbar-default-nisz-footer ul.copy li a:focus p,
.darkmode .navbar-default-nisz-footer ul.copy li a:visited p{
    color: #fff !important;
}
.darkmode .navbar-default-nisz-footer {
    border-top: 1px solid #fff !important;
}

.darkmode .fc .alert-info, .darkmode .priorizalt_hir{
    background-color: #444;
}
.darkmode .sidebarHeader{
    background-color: #2c2c2c;
}
.darkmode .panel-title a:after {
    border-left: 2px solid #fff;
    border-bottom: 2px solid #fff;
}
.darkmode .panel-title a.collapsed:after, .darkmode .init_menu .panel-title a:after  {
    border-left: 2px solid #fff;
    border-bottom: 2px solid #fff;
}
.darkmode .csokkentett .panel-title a:after,
.darkmode .karbantartas .panel-title a:after,
.darkmode .uzemkieses .panel-title a:after,
.darkmode .csokkentett_en .panel-title a:after,
.darkmode .karbantartas_en .panel-title a:after,
.darkmode .uzemkieses_en .panel-title a:after,
.darkmode .elethelyzet_cim .panel-title a:after{
  color: #fff !important;
  border: none !important;
}
.darkmode .panel-default > .panel-heading > .panel-title > a:hover,
.darkmode .panel-default > .panel-heading > .panel-title > a:active {
  border-bottom: none !important;
}

.darkmode .panel-body{
  background-color: #333;
}
.darkmode .dataTables_info{
  color: #fff !important;
}
.darkmode .elethelyzet_cim .panel-body{
    background-color: transparent !important;
}
.darkmode .sidebar .panel-body{
    background-color: transparent;
}
.darkmode .sidebar .list-group-item .list-group-item:hover, 
.darkmode .sidebar #Profil_section button:hover, 
.darkmode .sidebar #Hirek_section button:hover, 
.darkmode .sidebar #Uzemeltetes_section button:hover,
.darkmode .sidebar #Hitelesites_section button:hover, 
.darkmode .sidebar #KEAESZ_section button:hover, 
.darkmode .sidebar .list-group-item:hover .panel-heading /*kijelölés, vessző hiány*/
{
    background-color: #444 !important; 
}
.darkmode .sidebar a,
.darkmode .sidebar p.snap_clickable_text{
  color: #fff !important;
}
.darkmode .normalMenuContainer{
  background-color: #2c2c2c !important;
}
.darkmode .clickable_text_as_button, .darkmode .clickable_text_as_button_footer, .darkmode .clickable_text_as_button_elethelyzet {
  color: #fff !important;
}
.darkmode .modal-content{
  background-color: #2c2c2c;
}
.darkmode .navbar-default{
  box-shadow: none;
  background-image: none;
  background-color: #2c2c2c;
}
.darkmode .navbar-toggle .icon-bar {
    background-color: #fff !important;
}
.darkmode .bootstrap-datetimepicker-widget{
  background-color: #2c2c2c;
}
.darkmode .bootstrap-datetimepicker-widget.dropdown-menu.bottom::after {
  border-bottom: 6px solid #2c2c2c;
}
.darkmode input.kedvencek[type="text"]:disabled {
  color: #fff !important;
}
.darkmode #kedvencek_mappa_list .snap_clickable_text {
  color: #000 !important;  
}
.darkmode .szolg-list-view .block-container .roundContainer-title:hover{
  border-bottom:1px solid #fff;
}
.darkmode a:hover,
.darkmode a:focus,
.darkmode a:active,
.darkmode .serviceSection .snap_clickable_text:hover,
.darkmode .serviceSection .snap_clickable_text:focus,
.darkmode .serviceSection .snap_clickable_text:active{
  border-bottom: 1px solid #fff !important;   
  cursor: pointer;
}
.darkmode .navbar-default-nisz-footer ul.links a:hover p {
  border-bottom: 1px solid #fff !important;
  cursor: pointer;
}
.darkmode .nav-tabs > li.active > a{
  background-color: #2c2c2c;
  color: #fff
} 
.darkmode .nav-tabs > li.active > a:focus, 
.darkmode .nav-tabs > li.active > a:hover,
.darkmode .nav-tabs > li > a:hover, 
.darkmode .nav-tabs > li > a:focus {
  background-color: #444;
  color: #fff
}
.darkmode .nav-tabs > li > a {
  color: #fff;
}
.darkmode .ajax-loader{
  background-color: rgba(0,0,0,0.5);
}
.darkmode table.dataTable tbody tr {
  background-color: #2c2c2c;
}
.darkmode table.dataTable tbody tr:hover {
  background-color: #444;
}
.darkmode legend {
  color: #fff;
}

/*	0007312: 1. pont 2. pont*/
.darkmode a,
.darkmode.serviceSection .snap_clickable_text {
    color: #5C9AD1;  /*	0007312: 2. pont*/
    font-weight: 700;
  /* border-bottom: 0 !important; /*	0007312: 1. pont*/
    /*padding-bottom: 0!important; /*	0007312: 1. pont*/
    padding-bottom: 2px;    
}

.darkmode .uzemeltetes_cim .panel-heading,
.darkmode .elethelyzet_cim .panel-heading {
  background-color: #2c2c2c !important;
  color: #fff !important;
}

/* mantis miatt 0007674*/
.darkmode table.dataTable.stripe tbody tr.odd{
    background-color: #000000;
	}
.darkmode table.dataTable.stripe tbody>tr.odd.selected, table.dataTable.stripe tbody>tr.odd>.selected,.darkmode table.dataTable.display tbody>tr.odd.selected,.darkmode table.dataTable.display tbody>tr.odd>.selected {
   background-color: #f99639;
}
.darkmode table.dataTable tbody>tr.selected, table.dataTable tbody>tr>.selected {
    background-color: #f99639;
}
.darkmode table.dataTable button.ui-btn{
    background-color: #2c2c2c;
}

 /* mantis miatt 0007312 4-es pont*/
.darkmode #MainMenuDefault .panel-title a:after {
    content: '';
    width: 9px;
    height: 9px;
    border-left: 2px solid #fff;
    border-bottom: 2px solid #fff;
    transform: rotate(135deg);
    margin-top: 3px;
    display: block;
    position: absolute;
    right: 10px;
    top: 7px;
    transition: all 0.3s ease-out;
}
/* mantis miatt 0007312 3-as pont*/
.darkmode .navbar-default-nisz-footer .cimer {
    width: 50px;
    height: 70px;
    border-left: 1px solid #2c2c2c;
    border-right: 1px solid #2c2c2c;
    background:#2c2c2c  url(get_image.php?img=7934033236265245) 0 0 no-repeat;
    background-size: auto;
    background-size: 100%;
    position: absolute;
    top: -41px;
    left: calc(50% - 25px);
}
.darkmode .navbar-default-nisz-footer .cimer.fooldal {
    width: 35px !important;
    height: 50px !important;
    top: -30px !important;
}

.darkmode .fooldal_szuf_logo_szuf_logo_new{
    height: 55px;
    width: 70px;
    background:   url(get_image.php?img=7940150138896600) 0 0 no-repeat;
    background-size: auto;
    background-size: 100%;
    position: static;
    margin-left: 100px !important;   
    margin-top: 12px !important;
}
.darkmode .top10_nyil .top10_fa-icon-1_nyil {
      content: '';
    width: 9px;
    height: 9px;
    border-left: 2px solid #fff;
    border-bottom: 2px solid #fff;
    transform: rotate(225deg);
    margin-top: 3px;
    display: block;
    position: absolute;
    right: 10px;
    top: 7px;
    transition: all 0.3s ease-out;
}

.top10_nyil .top10_fa-icon-1_nyil {
      content: '';
    width: 9px;
    height: 9px;
    border-left: 2px solid #2c2c2c;
    border-bottom: 2px solid #2c2c2c;
    transform: rotate(225deg);
    margin-top: 3px;
    display: block;
    position: absolute;
    right: 10px;
    top: 7px;
    transition: all 0.3s ease-out;
}

.darkmode .panel.panel-info{
    border-color: #004b88;
    background: transparent;
}
.darkmode .panel.panel-info .panel-heading {
    border-color: #004b88;
    background-image: none;
    background-color: #004b88;	
	}

.darkmode table.dataTable tbody tr.odd{ /*A sablont használó ügyleírások- IFORM*/
    background-color: transparent;
}

.szuf_feltoltes_img{
        display: block;
		min-height: 45px;
		width: 45px;
  		text-align: center;
		margin-top:15px;
		/*background:   url(get_image.php?img=7594046335126804)  0 0 no-repeat;*/
        background-size: auto;
        background-size: 100%;           
}
.darkmode .szuf_feltoltes_img img{
opacity: 0;
}				
.darkmode .szuf_feltoltes_img{
        display: block;
		min-height: 45px;
		width:  45px;
       	text-align: center;
		margin-top:15px;
		background: #2c2c2c  url(get_image.php?img=7904688591189591) 0 0 no-repeat;
        background-size: auto;
        background-size: 100%;
        position:  relative;
}

		
.darkmode div.material-input label,
.darkmode div.fixed-material-input label{
    color: #2c2c2c !important;
    background: #fff !important;
    /*top: -20px;
    left: -4px;*/
}



.darkmode div.material-input.input-focused label,
.darkmode div.material-input.input-has-value label,
.darkmode div.material-input.input-has-value-mask label{
    color: #fff !important;
    background-color:#2c2c2c !important;
}
.darkmode .modal-header .close{
background-color: #fff;
}

/* ÉLETHELYZET */

.elethelyzet_ikon{
  height: 50px;
}
.elethelyzet_cim .panel-title a:after, .elethelyzet_cim .panel-title a.collapsed:after {
  content: "";
}
.elethelyzet_cim .panel-title a {
  display: block !important;
}
.elethelyzet_cim .panel-heading {
    background-color: #ffffff !important;
    color: #000000 !important;
    display: inline-block;
    width: 100%;
    border: 0!important;
    border-top: 0!important;
    border-bottom: 0!important;
   
}

.elethelyzet_cim.panel-body  {
    border-top: 0!important;
    border-bottom: 0!important;
    border: 0!important;
}

.elethelyzet_cim .panel-collapse > .panel-body {
    border-top: 0 !important;
}


/*-----------------------
ŰRLAP
-------------------------*/
#formfrag {
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
}
#formfrag>iframe {
	width: 100%;
	height: 100%;
	border: 0;
}
progress {
	height: 4px;
}
/*-----------------------
accessibility-focus 
-------------------------*/



#Icons_menu_container button {
  border: 0 !important;
  border-radius: 0px;
  background-color: transparent !important;
  outline: none;
  text-align: center;
  color: #fff;
  -webkit-box-shadow: none;
  box-shadow: none;
  width: 48px;
  font-size: 1rem;
  padding: 15px;
}

.clickable_text_as_button {
  border: 0 !important;
  border-radius: 0px;
  padding: 0;
  background-color: transparent !important;
  outline: none;
  text-align: left;
  white-space: normal !important;
  -webkit-box-shadow: none;
  box-shadow: none;
  /*width: 100%;*/
  margin: 0 !important;
}

.clickable_text_as_button_elethelyzet {
  border: 0 !important;
  border-radius: 0px;
  padding: 0;
  background-color: transparent !important;
  outline: none;
  text-align: left;
  white-space: normal !important;
  -webkit-box-shadow: none;
  box-shadow: none;
  margin: 0 !important;
  display: block;
}

.clickable_text_as_button_elethelyzet i {
  line-height: 24px !important;
}

.clickable_text_as_button_footer {
  border: 0 !important;
  border-radius: 0px;
  padding: 0;
  background-color: transparent !important;
  outline: none;
  text-align: left;
  white-space: normal !important;
  -webkit-box-shadow: none;
  box-shadow: none;
  margin: 0 !important;
  text-transform: none !important;
}

#Navbar_nav .btn-link {
  border: 0 !important;
  border-radius: 0px;
  padding: 4px;
  outline: none;
  text-align: left;
  white-space: normal !important;
  -webkit-box-shadow: none;
  box-shadow: none;
  margin: 0 0 -1px 10px !important;
  background-color: transparent;
}

#Navbar_nav #navbar_contact {
  line-height: 1.3 !important;
}

#Navbar_nav #lang_en {
  margin-right: 5px !important;
}

.color_black_text {
  color: #000 !important;
}

.color_red_text {
  color: #af1a27 !important;
  text-transform: none !important;
   text-decoration: underline!important;
}

.color_red {
  color: #af1a27 !important;
  text-transform: none !important;
  text-decoration: none!important;
}

.color_yellow {
  color: orange !important;
  text-transform: none !important;
  text-decoration: none!important;
}

.color_green {
  color: green !important;
  text-transform: none !important;
  text-decoration: none!important;
}

.darkmode .color_black_text {
  color: #fff !important;
}

.darkmode .color_red_text {
  color: #af1a27 !important;
}

.color_blue_text {
  color: #004b88 !important;
}

.font_weight_400 {
  font-weight: 400 !important;
}

.font_weight_700 {
  font-weight: 700 !important;
}

.font_size_09rem {
  font-size: 0.9rem !important;
}

.font_size_1rem {
  font-size: 1rem !important;
}

.font_size_12rem {
  font-size: 1.2rem !important;
}

.margin_left_15 {
  margin-left: 15px !important;
}

.margin_bottom_10 {
  margin-bottom: 10px !important;
}

.text_transform_none {
  text-transform: none !important;
}

.clickable_text_as_button:hover,
.clickable_text_as_button:focus,
.clickable_text_as_button:active,
.clickable_text_as_button_elethelyzet:hover,
.clickable_text_as_button_elethelyzet:focus,
.clickable_text_as_button_footer:hover,
.clickable_text_as_button_footer:focus,
#Navbar_nav .btn-link {
    text-decoration: none !important;
}

.clickable_text_as_button_footer:focus,
#kapcsolodo_dokumentumok button:focus {
   outline-offset: 3px;
   outline: 3px solid #33f;
}

.clickable_text_as_button:hover,
.clickable_text_as_button:active {
    outline: 0 !important;
   /* background-color: #ECEBEA !important;
    border-color: #ECEBEA !important;*/
}

.darkmode .clickable_text_as_button:hover,
.darkmode .clickable_text_as_button:active {
    outline: 0 !important;
    background-color: #444 !important;
    border-color: #444 !important;
}
/****************************************************************************/
#navbar_contact:after { /*alul vonalka*/
  content: '';
  position: absolute;
  width: 100%;
  transform: scaleX(0);
  height: 1px;
  bottom: 0;
  left: 0;
  background-color: #000;
  transform-origin: bottom right;
  transition: transform 0.25s ease-out;
}

#navbar_contact:hover:after {
  transform: scaleX(1);
  transform-origin: bottom left;
}

.icon_button_size{
   font-size: 1.6rem;
}


.icon_font_size_large{
font-size: x-large;
}

.pull-up-center{
   padding-bottom:1.5vh;
}

.text-transform-kisbetus{ 
  text-transform:none}

.icon_button-padding
{ padding-left:10px;
  padding-right:10px;
}


/****************************************************************************/
.accessibility-focus .btn-lblue:focus,
.accessibility-focus .btn.btn-blue:active:focus,
.accessibility-focus .btn.btn-blue:focus,
.accessibility-focus .btn.btn-red:active:focus,
.accessibility-focus .btn.btn-red:focus,
.accessibility-focus .modal-dialog:focus,
.accessibility-focus .modal:focus {
 outline:5px solid #fbdc00;
 outline-offset:-2px
}


.accessibility-focus .btn:activ,
.accessibility-focus .btn:focus{
  outline-offset: -2px;
   outline: 3px solid #fbdc00 !important;
   border: 3px solid #fbdc00 !important;
}

.accessibility-focus .modal-header .close:focus,
.accessibility-focus .button.close:focus
{
   outline-offset: 2px;
   outline: 3px solid #3333ff;
   
  /* padding:5px;*/
}

.accessibility-focus .modal-footer .btns:focus {
 	outline-offset: 2px;
   	outline: 3px solid #3333ff;
}

/*.accessibility-focus #Navbar_nav .btn-link:hover,
.accessibility-focus .btn:hover,
.accessibility-focus .clickable_text_as_button_footer:hover,
.accessibility-focus .btn-block:hover,
.accessibility-focus .btn-default:hover*/
.text-underline:hover{
   text-decoration: underline !important;

}
.accessibility-focus .navbar .btn:active, 
.accessibility-focus .navbar .btn:focus, 
.accessibility-focus .btn-default:focus, 
.accessibility-focus .btn-default:active, 
.accessibility-focus .btn-default.active:focus,
.accessibility-focus .btn-block:focus,
.accessibility-focus .btn-success:active,
.accessibility-focus .btn-success:focus{
  outline:5px solid #fbdc00;
  outline-offset:-2px;
  text-decoration: underline;
  }

.accessibility-focus #Icons_menu_container button:focus {
  outline: 3px solid #fff; 
  outline-offset: -2px;
}

.accessibility-focus .clickable_text_as_button_elethelyzet:focus,
.accessibility-focus .clickable_text_as_button:focus,
.accessibility-focus .clickable_text_as_button:active,
.accessibility-focus .clickable_text_as_button_footer:focus,
.accessibility-focus #search_button:focus,
.accessibility-focus #search_button:active,
.accessibility-focus .color_black_text:focus,
.accessibility-focus .color_black_text:active{
   outline-offset: 2px;
   outline: 3px solid #3333ff !important;
}




.accessibility-focus #Navbar_nav .btn-link:focus,
.accessibility-focus #Navbar_nav .btn-link:active,
.accessibility-focus .navbar-toggle:focus,
.accessibility-focus .navbar-toggle:active
{
   outline-offset: 3px;
   outline: 3px solid #3333ff;
  
}
.accessibility-focus #search_button:hover{
transform: scale(1.03);
}

.accessibility-focus input.form-control:focus, 
.accessibility-focus .checkbox-slider--b-flat:hover, 
.accessibility-focus select.form-control option:hover,
.accessibility-focus .checkbox-slider--b-flat input:focus + span,
/*.accessibility-focus .checkbox-slider--b-flat:focus:hover, */
/*.accessibility-focus .btn-group > .btn:first-child:focus,*/
.accessibility-focus select.form-control:focus,
.accessibility-focus textarea.form-control:focus {
   border:3px solid #3333ff !important;
   outline: 0;
}
.accessibility-focus .underline>h1:focus,
.accessibility-focus .serviceSection .snap_clickable_text:focus,
.accessibility-focus .serviceSection .snap_clickable_text:active,
.accessibility-focus input[type=checkbox]:focus,
.accessibility-focus input[type=radio]:focus{
  outline-offset:3px;
 outline:3px solid #33f;
}


.accessibility-focus #MainMenuDefault .panel-title a:active,
.accessibility-focus #MainMenuDefault .panel-title a:focus {
  /*  outline-offset: 3px;
    outline: 3px solid #33f;*/
   border: none !important;
   outline-offset: 2px;
   outline: 3px solid #3333ff;
     
}

.accessibility-focus .panel-title a:active,
.accessibility-focus .panel-title a:focus{
    /* outline:5px solid #fbdc00;*/
  outline-offset: 2px;
  outline: 3px solid #3333ff;
  border: none !important;
 
     
}


.accessibility-focus a:hover,
.accessibility-focus a:focus,
.accessibility-focus a:active,
.accessibility-focus .serviceSection .snap_clickable_text:hover,
.accessibility-focus .serviceSection .snap_clickable_text:focus,
.accessibility-focus .serviceSection .snap_clickable_text:active{
    border-bottom: 1px solid #004b88;
    cursor: pointer;
}

.accessibility-focus .nav-tabs > li.active > a:focus, 
.accessibility-focus .nav-tabs > li.active > a:hover,
.accessibility-focus .nav-tabs > li > a:hover, 
.accessibility-focus .nav-tabs > li > a:focus
{
    border-bottom: 1px solid #004b88;
    cursor: pointer;
}


.accessibility-focus .pagination>.active>a:focus {
    outline: 2px solid #fbdc00;
    outline-offset: -2px;
}

.accessibility-focus .yellow_outline:focus,
.accessibility-focus .yellow_outline:hover, 
.yellow_outline:hover, 
.yellow_outline:focus,
.accessibility-focus #mydivpopup:hover{
    outline: 5px solid #fbdc00;
 	outline-offset:-2px
}

.text-black{
  color: #000 !important;  
}

.no_snap_clickable_text{
pointer-events:none;
cursor:not-allowed;
opacity:.5;
color: #000 !important;  
}
/****************************************************************************/
.underline-href .navbar-inverse .navbar-nav>li a,
.underline-href .navbar-inverse .navbar-nav>li a:active,
.underline-href .navbar-inverse .navbar-nav>li a:focus,
.underline-href .navbar-inverse .navbar-nav>li a:hover,
.underline-href a,
.underline-href a:active,
.underline-href a:focus,
.underline-href a:hover,
.underline-href a:not(.btn):active {
 text-decoration:none;
 border-bottom:1px solid #33f;
 background-size:0 0
}



/****************************************************************************Tabulátorozás müködjön/
 input.form-control:focus, 
 .checkbox-slider--b-flat:hover, 
 select.form-control option:hover,
.checkbox a._sys_help:focus,
.checkbox-slider--b-flat input:focus + span,
 /*.checkbox-slider--b-flat:focus,*/
.dropdown-menu > li > a:focus,
.dataTables_wrapper .dataTables_paginate>a.paginate_button:active:hover,
.dataTables_wrapper .dataTables_paginate>a.paginate_button:focus,
.dataTables_wrapper .dataTables_paginate>a.paginate_button:hover, 
 /*.btn-group > .btn:first-child:focus,*/
 select.form-control:focus,
 textarea.form-control:focus {
   border:1px solid #33f;
   outline: 0;
   
}

 .btn-lblue:focus,
 .btn.btn-blue:active:focus,
 .btn.btn-blue:focus,
 .btn.btn-red:active:focus,
 .btn.btn-red:focus,
 .navbar .btn:active, 
 .navbar .btn:focus, 
 .btn-default:focus, 
 .btn-default:active, 
 .btn-default.active:focus,
 .btn-block:focus,
 .btn-success:active,
 .btn-success:focus
 {
 border: 1px solid #fbdc00;
}


 
#Icons_menu_container button:focus {
  outline: 3px solid #fff !important;
  outline-offset: -2px !important;
}

 .modal-header .close:focus,
 .button.close:focus
{
   outline-offset:1px;
   outline:1px solid #33f;

}

 .modal-footer .btns:focus {
  outline-offset:1px;
 outline:1px solid #33f;
}


 .clickable_text_as_button_elethelyzet:focus,
 .clickable_text_as_button:focus,
 .clickable_text_as_button:active,
 .clickable_text_as_button_footer:focus,
.pagination>.active>a:focus, 
 #search_button:focus,
 #search_button:active,
 .color_black_text:focus,
 .color_black_text:active{
   outline-offset:1px;
   outline:1px solid #33f;
   border:none;
}


 #Navbar_nav .btn-link:focus,
 #Navbar_nav .btn-link:active,
 .navbar-toggle:focus,
 .navbar-toggle:active
{
   outline-offset:3px;
   outline:1px solid #33f;
   border:none;
  
}
/*table.dataTable tbody tr:focus td:first-child,
table.dataTable tbody tr:focus td:last-child,
table.dataTable tbody tr:focus td{
  outline-offset:3px !important;
   outline:1px solid #33f !important;
   border:none;
}*/


 .underline>h1:focus,
 .serviceSection .snap_clickable_text:focus,
 .serviceSection .snap_clickable_text:active,
 input[type=checkbox]:focus,
 input[type=radio]:focus{
 outline-offset:1px ;
 outline:1px solid #33f;
}


 #MainMenuDefault .panel-title a:active,
 #MainMenuDefault .panel-title a:focus {
 outline-offset:1px;
 outline:1px solid #33f;
     
}

 .panel-title a:active,
 .panel-title a:focus{
  outline-offset:1px;
 outline:1px solid #33f;    
}


/****************************************************************************/




 .jel_badge{
      display: inline-block;
      min-width: 10px;
      padding: 3px 7px;
      font-size: 12px;
      font-weight: 700;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      background-color: #777;
      border-radius: 10px;
   }


 .jel_badge_RNY{
      display: inline-block;
      min-width: 10px;
      padding: 3px 7px;
      font-size: 12px;
      font-weight: 700;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      background-color: red;
      border-radius: 10px;
   }

.szinezett_lista_jeloles {
    background: #25a0af;
    width: 40px !important;
    display: table;
    height: 40px;
    vertical-align: middle;
    text-align: center;
    padding: 3px;
    margin: 5px auto;
}


.szinezett_lista_jeloles_RNY {
    background: #fd8018;
    width: 40px !important;
    display: table;
    height: 40px;
    vertical-align: middle;
    text-align: center;
    padding: 3px;
    margin: 5px auto;
}



/*listview kattintható legyen amiatt kell*/
/*a[ctrl_type="jqm_listitem"],
a[ctrl_type="listitem"],
div[ctrl_type="collapsible-set"]  > div > div > h4 > a:not([data-toggle="collapse"]){ 
	pointer-events: auto;
}*/
/**/
#S_B_Top_ugrolink {
    text-decoration: none;
    color: #000;
    position: absolute;
    bottom: 30px;
    right: 30px;
    max-width: 10px !important;
	z-index: 100;
    /*display: none;
    /*border: 1px solid #58585a;*/
   padding: 10px;
   background: transparent;
}


.displayinline{
  display: inline;
}

.displaynone{
  display: none;
}

#listview-1_ikon_1 .list-group-item,
#listview-1_ikon_2 .list-group-item  {
    border: none !important;
} 

