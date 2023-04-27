body.left-m #left {
    width: 315px;
     -webkit-box-shadow: 0 -10px 10px 0px rgba(102, 102, 102, 0.4);
    box-shadow: 0 -10px 10px 0px rgba(102, 102, 102, 0.4);
}
body.left-m #main {
    left: 315px;
}
body.left-s #left {
    margin-left: 0 !important;
    width: 50px !important;
    display: block !important;
}
body.left-s #main {
    left: 50px !important;
}
body.bottom-l #footer {
    height: 129px !important;
    z-index: 3;
}
body.bottom-l #main {
    bottom: 129px !important;
}
body.bottom-l #left {
    bottom: 129px !important;
}
@media(max-width:800px) {
    #navbutton {
	display: none !important;
    }
    body.bottom-l #footer {
	height: 220px !important;
    }
    body.bottom-l #main {
	bottom: 220px !important;
    }
}
@media(max-width:640px) {
    body.bottom-l #footer {
	height: 260px !important;
    }
    body.bottom-l #main {
	bottom: 260px !important;
    }
}
@media(max-width:350px) {
    body.bottom-l #footer {
	height: 300px !important;
    }
    body.bottom-l #main {
	bottom: 300px !important;
    }
}
/* CLIENT_TIMEOUT_WARNING dialog styles (#6528) */
.btn-primary  {
	color: #fff;
	background-color: rgba(0, 75, 136, 1);
	border: 1px solid rgba(0, 75, 136, 1);
}

.jconfirm-title  { /* Same as .modal-title */
	text-transform: uppercase;
	font-weight: 700;
}

.jconfirm-content  { /* Same as .modal-body */
	position: relative;
	padding: 15px 0px;
	border-top: 1px solid #e5e5e5; /* From .modal-footer */
	border-bottom: 1px solid #e5e5e5; /* From .modal-header */
}
#gyorslink {
	margin: 0;
	position: relative
}
#gyorslink ul {
	list-style: none;
	line-height: 1em;
	margin-bottom: 0
}
#gyorslink li {
	margin-bottom: 0
}
#gyorslink a {
	position: absolute;
	left: 50%;
	top: -100px;
	width: auto;
	background-color: #33f;
	color: #fff;
	font-size: 12.4px;
	text-decoration: none;
	padding: 10px;
	margin: 0 auto;
	text-align: center;
	-webkit-transition: top .5s ease-out,border-bottom .5s ease-out;
	transition: top .5s ease-out,border-bottom .5s ease-out;
	display: block;
	z-index: 11;
	opacity: 0;
	border: none;
	outline: 0;
	font-weight: 700
}
#gyorslink a:focus,
#gyorslink a:hover {
	top: 0;
	opacity: 1
}
#gyorslink a:before {
	content: "\25BC";
	display: inline;
	padding-right: 5px
}