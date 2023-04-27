div[role="main"] {
  height: 100%;
}

div[role="main"] * {
  outline: none !important;
}

div[role="main"] > div[ctrl_type="main"] {
  max-width: 996px;
  padding: 1em 25px 3em 25px !important;
}

div[role="main"] > div[ctrl_type="main"] h1 {
  border-bottom: 1px solid #CCCCCC;
  text-transform: uppercase;
}

div[role="main"] > div[ctrl_type="main"] .kiegeszito_info {
  font-size: 0.9em;
  margin-bottom: 1em;
}

div[role="main"] > div[ctrl_type="main"] div[role="group"][ctrl_type="navbar"],
div[role="main"] > div[ctrl_type="main"] div[role="toolbar"][ctrl_type="navbar"] {
  margin-bottom: 0;
}

div[role="main"] > div[ctrl_type="main"] button {
  margin: 1em 1em 0 1em;
}

div[role="main"] > div[ctrl_type="main"] button:focus,
div[role="main"] > div[ctrl_type="main"] button:hover {
  text-decoration: none;
}

div[role="main"] > div[ctrl_type="main"] .btn-blue {
  border-color: #004B88;
}

/* Keresés -------------------------------------------------------------------------------------- */

div[role="main"] > div[ctrl_type="main"] .kereses_fejlec > h1 {
  margin-bottom: 1em;
}

div[role="main"] > div[ctrl_type="main"] div[class*="checkbox"] > label,
div[role="main"] > div[ctrl_type="main"] div > label[for="input-rendszam"] {
  font-size: 1em;
  text-transform: none;
}

div[role="main"] > div[ctrl_type="main"] div > label[for="input-rendszam"] {
  font-weight: 600;
}

div[role="main"] > div[ctrl_type="main"] label[for="input-rendszam"]::after {
  content: "*";
  padding-left: 0.3em;
}

div[role="main"] > div[ctrl_type="main"] .kiegeszito_info > span,
div[role="main"] > div[ctrl_type="main"] label[for="input-rendszam"]::after,
div[role="main"] > div[ctrl_type="main"] .invalidation_message {
  color: #C20029;
  font-weight: 600;
}

div[role="main"] > div[ctrl_type="main"] .form-control {
  border: 1px solid #777777 !important;
}

div[role="main"] > div[ctrl_type="main"] .form-control:focus,
div[role="main"] > div[ctrl_type="main"] .form-control:hover,
div[role="main"] > div[ctrl_type="main"] .form-control:active {
  border: 1px solid #000000 !important;
}

div[role="main"] > div[ctrl_type="main"] input.rendszam {
  background-image: url("get_image.php?img=7187169645170507");
  background-position: left center;
  background-repeat: no-repeat;
  background-size: contain;
  font-size: 1.5em;
  font-weight: 600;
  text-indent: 0.5em;
}

div[role="main"] > div[ctrl_type="main"] .form-control.invalid_input {
  border-left-width: 1px !important;
  border-color: #C20029 !important;
  padding-left: 12px !important;
}

div[role="main"] > div[ctrl_type="main"] div.tooltip .tooltip-inner {
  max-width: 24em;
}

div[role="main"] > div[ctrl_type="main"] .invalidation_message {
  font-size: 0.9rem;
  margin-top: 5px;
  min-height: 1.2rem;
}

@media (min-width: 768px) {
  div[role="main"] > div[ctrl_type="main"] .invalidation_message {
    height: 1.2rem;
  }
}

/* Adatlap -------------------------------------------------------------------------------------- */

div[role="main"] > div[ctrl_type="main"] .adatlap_fejlec {
  margin-bottom: 1em;
}

div[role="main"] > div[ctrl_type="main"] .adatlap_fejlec > h1 {
  margin-bottom: 5px;
}

div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li a {
  font-size: 1em; /* v3.1 fix */
  padding: 9px 10px 10px 10px;
}

div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li > a:hover,
div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li > a:focus,
div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li > a:active {
  background-color: #F5F5F5;
}

div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li:not(.active) > a:hover,
div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li:not(.active) > a:focus,
div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li:not(.active) > a:active {
  border-bottom-color: #DDDDDD;
}

div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li.active > a:hover,
div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li.active > a:focus,
div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li.active > a:active {
  border-bottom-color: transparent !important;
}

div[role="main"] > div[ctrl_type="main"] h2 {
  color: #004B88;
  font-size: 1.15em;
  font-weight: normal;
  margin: 10px 0;
  text-transform: uppercase;
}

div[role="main"] > div[ctrl_type="main"] div:not([class*="checkbox"]) > label:not([for="input-rendszam"]) {
  color: #777777;
  font-size: 0.9em;
  font-weight: normal;
  text-transform: none;
}

div[role="main"] > div[ctrl_type="main"] .form-control,
div[role="main"] > div[ctrl_type="main"] .form-group > p,
div[role="main"] > div[ctrl_type="main"] .form-group > span,
div[role="main"] > div[ctrl_type="main"] .korozes p {
  color: #000000;
  /* font-weight: 600; */
  overflow-wrap: break-word;
  word-break: break-word;
  word-wrap: break-word;
}

div[role="main"] > div[ctrl_type="main"] .korozes p,
div[role="main"] > div[ctrl_type="main"] .korozes .form-group .form-group {
  margin-bottom: 0;
}

div[role="main"] > div[ctrl_type="main"] .korozes .list-group-item {
  padding: 0 !important;
}

div[role="main"] > div[ctrl_type="main"] .korozes .form-group {
  margin-bottom: 3em;
}

div[role="main"] > div[ctrl_type="main"] .list-group-item {
  border: 0;
  padding: 0;
}

div[role="main"] > div[ctrl_type="main"] .datatable_fejlec thead tr th {
  font-size: 1em;
  font-weight: 600;
  padding: 0.5em 1.3em 0.5em 0;
  text-transform: none;
}

div[role="main"] > div[ctrl_type="main"] .datatable_fejlec tbody tr td {
  font-size: 1em;
  padding: 0.5em 0;
}

div[role="main"] > div[ctrl_type="main"] .panel-group {
  margin-bottom: 3em;
}

div[role="main"] > div[ctrl_type="main"] .panel .panel-heading {
  background-color: transparent;
  padding: 0;
}

div[role="main"] > div[ctrl_type="main"] .panel .panel-heading i {
  color: #004B88;
  padding: 0.25em 0;
}

div[role="main"] > div[ctrl_type="main"] .panel .panel-heading .panel-title a {
  border-width: 0 !important; /* v3.1 fix */
  color: #004B88;
  display: block;
  font-size: 1.05em;
  font-weight: 600;
  padding: 0.25em 0;
}

div[role="main"] > div[ctrl_type="main"] .panel .panel-heading .panel-title a:after,
div[role="main"] > div[ctrl_type="main"] .panel .panel-heading .panel-title a.collapsed:after {
  border: 0 none;
  content: "";
}

div[role="main"] > div[ctrl_type="main"] .panel .panel-body {
  padding: 1em 0;
}

/* Galéria -------------------------------------------------------------------------------------- */

div[role="main"] > div[ctrl_type="main"] h1.galeria_cim {
  border: 0 none;
  margin: 20px 0 1em 0;
}

div[role="main"] > div[ctrl_type="main"] h4.galeria_cim {
  font-size: 1.3em;
  padding: 0.5em 0;
  text-transform: uppercase;
}

div[role="main"] > div[ctrl_type="main"] .galeria_bezaras {
  color: #777777;
  float: right;
  font-size: 2em;
  line-height: 0.4em;
}

div[role="main"] > div[ctrl_type="main"] .bx-wrapper {
  margin: 0 0 60px 0;
}

div[role="main"] > div[ctrl_type="main"] .bx-wrapper a,
div[role="main"] > div[ctrl_type="main"] .bx-wrapper a:hover,
div[role="main"] > div[ctrl_type="main"] .bx-wrapper a:focus,
div[role="main"] > div[ctrl_type="main"] .bx-wrapper a:active {
  border-bottom: 0 none !important;
}

div[role="main"] > div[ctrl_type="main"] .bx-wrapper .bxslider {
    margin: 0;
}

div[role="main"] > div[ctrl_type="main"] .bx-wrapper .bx-controls .bx-controls-direction a {
  transition: none !important;
}

div[role="main"] > div[ctrl_type="main"] .bx-wrapper .bx-caption span {
  font-size: 1em;
  padding: 5px 10px;
}

div[role="main"] > div[ctrl_type="main"] .bx-wrapper .bx-viewport:not([aria-live]) + .bx-controls .bx-prev {
  left: 0; /* v2.2 fix */
}

div[role="main"] > div[ctrl_type="main"] .bx-wrapper .bx-viewport:not([aria-live]) .bx-caption span {
  padding-bottom: 15px; /* v2.2 fix */
}
