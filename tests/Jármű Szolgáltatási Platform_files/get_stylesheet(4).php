.darkmode div[role="main"] > div[ctrl_type="main"] h1 {
  border-bottom-color: #777777; /* #CCCCCC */
}

.darkmode div.modal-dialog > div.modal-content .btn-default,
.darkmode div[role="main"] > div[ctrl_type="main"] .btn-default {
  background-color: #333333; /* #FFFFFF */
  border-color: #62738B; /* #C2CDDB */
  color: #BBBBBB /* #333333 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] .btn-blue {
  background-color: #058DD2 !important; /* #004B88 */
  border-color: #058DD2; /* #004B88 */
  color: #000000; /* #FFFFFF */
}

/* Keresés -------------------------------------------------------------------------------------- */

.darkmode div[role="main"] > div[ctrl_type="main"] .kiegeszito_info > span,
.darkmode div[role="main"] > div[ctrl_type="main"] label[for="input-rendszam"]::after,
.darkmode div[role="main"] > div[ctrl_type="main"] .invalidation_message {
  color: #E16973; /* #C20029 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] .form-control {
  background-color: #2C2C2C; /* #FFFFFF */
  border: 1px solid #CCCCCC !important; /* #777777 */
  color: #FFFFFF; /* #000000 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] .form-control:focus,
.darkmode div[role="main"] > div[ctrl_type="main"] .form-control:hover,
.darkmode div[role="main"] > div[ctrl_type="main"] .form-control:active {
  border: 1px solid #FFFFFF !important;
}

.darkmode div[role="main"] > div[ctrl_type="main"] .form-control.invalid_input {
  border-color: #E16973 !important; /* #C20029 */
}

/* Adatlap -------------------------------------------------------------------------------------- */

.darkmode div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li > a:hover,
.darkmode div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li > a:focus,
.darkmode div[role="main"] > div[ctrl_type="main"] ul[ctrl_type="tabbar"] li > a:active {
  background-color: #363636; /* #F5F5F5 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] h2 {
  color: #4CB7E9; /* #004B88 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] div:not([class*="checkbox"]) > label:not([for="input-rendszam"]) {
  color: #CCCCCC; /* #777777 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] .form-control,
.darkmode div[role="main"] > div[ctrl_type="main"] .form-group > p,
.darkmode div[role="main"] > div[ctrl_type="main"] .form-group > span,
.darkmode div[role="main"] > div[ctrl_type="main"] .korozes p {
  color: #FFFFFF; /* #000000 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] table[ctrl_type="datatable"] {
  border-bottom-color: #777777; /* #DDDDDD */
}

.darkmode div[role="main"] > div[ctrl_type="main"] table[ctrl_type="datatable"] tbody tr td {
  border-top-color: #777777; /* #DDDDDD */
}

.darkmode div[role="main"] > div[ctrl_type="main"] .panel .panel-heading i {
  color: #4CB7E9; /* #004B88 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] .panel .panel-heading .panel-title a {
  color: #4CB7E9; /* #004B88 */
}

.darkmode div[role="main"] > div[ctrl_type="main"] .panel .panel-body {
  background-color: transparent;
}

/* Diagram -------------------------------------------------------------------------------------- */

.darkmode div[role="main"] > div[ctrl_type="main"] svg {
  filter: invert(1) hue-rotate(180deg);
}

.darkmode div[role="main"] > div[ctrl_type="main"] svg g > g > rect {
  fill: #D3D3D3; /* invert of #2C2C2C */
}

.darkmode div[role="main"] > div[ctrl_type="main"] svg g > g > rect[style*="stroke:white"] {
  fill: #D3D3D3 !important; /* invert of #2C2C2C */
  stroke: #D3D3D3 !important; /* invert of #2C2C2C */
}

.darkmode div[role="main"] > div[ctrl_type="main"] svg g > g:nth-last-of-type(3) > rect[style*="stroke:black"]:nth-of-type(2) {
  fill: #B4B4B4 !important; /* invert of #4B4B4B */
  stroke: #000000 !important; /* inver of #FFFFFF */
}

.darkmode div[role="main"] > div[ctrl_type="main"] svg g > g:nth-last-of-type(2) > rect[style*="stroke:black"]:nth-of-type(2) {
  fill: #D3D3D3 !important; /* invert of #2C2C2C */
  stroke: #000000 !important; /* inver of #FFFFFF */
}

/* Galéria -------------------------------------------------------------------------------------- */

.darkmode div[role="main"] > div[ctrl_type="main"] .bx-wrapper {
  -moz-box-shadow: 0 0 5px #777777; /* #CCCCCC */
  -webkit-box-shadow: 0 0 5px #777777; /* #CCCCCC */
  box-shadow: 0 0 5px #777777; /* #CCCCCC */
  border-color: #2C2C2C; /* #FFFFFF */
  background-color: #2C2C2C; /* #FFFFFF */
}

.darkmode  div[role="main"] > div[ctrl_type="main"] .bx-wrapper .bx-controls .bx-pager a.bx-pager-link:not(.active) {
  background-color: #777777 !important; /* #DDDDDD */
}

.darkmode  div[role="main"] > div[ctrl_type="main"] .bx-wrapper .bx-controls .bx-pager a.bx-pager-link.active {
    background: #FFFFFF !important; /* #000000 */
}
