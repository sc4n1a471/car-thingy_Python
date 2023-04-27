XPATHS = {
    'main_frame': '//*[@id="main"]/iframe',

    'login_methods': '//form[@id="urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"]',
    'login_method': '//form[@id="urn:eksz.gov.hu:1.0:azonositas:kau:1:uk:uidpwd"]',
    'username_field': '//input[@id="fldUser"]',
    'password_field': '//input[@id="fldPass"]',
    'login_button': '//button[@name="submit"]',

    'accident_record_ckeckbox': '//input[@id="checkbox-BiztositasKartortenet"]',

    'search_input': '//input[@id="input-rendszam"]',

    'no_official_data': '//p[contains(text(), "A járműhöz nem tartoznak okmányadatok.")]',
    'no_inspection_data': '//p[contains(text(), "A járműhöz nem tartoznak a műszaki állapotára vonatkozó adatok.")]',

    'brand': '//*[contains(@id, "Gyartmany") and string-length(text())]',
    'model': '//*[contains(@id, "Kerleiras") and string-length(text())]',
    'type_code': '//*[contains(@id, "Tipus") and string-length(text())]',
    'status': '//*[contains(@id, "ForgalmiAllapot") and string-length(text())]',
    'first_reg': '//*[contains(@id, "ElsoForgHelyezes") and string-length(text())]',
    'first_reg_hun': '//*[contains(@id, "ElsoMoForgHelyezes") and string-length(text())]',
    'num_of_owners': '//*[contains(@id, "OsszesTulaj") and string-length(text())]',
    'year': '//*[contains(@id, "GyartasiEv") and string-length(text())]',
    'engine_size': '//*[contains(@id, "Hengerurtartalom") and string-length(text())]',
    'performance': '//*[contains(@id, "text-Teljesitmeny") and contains(text(), " kW")]',
    'fuel_type': '//*[contains(@id, "Uzemanyag") and string-length(text())]',
    'gearbox': '//*[contains(@id, "Sebessegvalto") and string-length(text())]',
    'color': '//*[contains(@id, "Szin") and string-length(text())]',

    'restrictions_tab': '//*[@id="tabitem-ForgtartasForgkorlat"]',
    'restrictions': '//*[@id="datatable-Forgkorlat"]/tbody',

    'mileage_tab': '//*[@id="tabitem-FutasTeljesitmeny"]',
    'mileage': '//*[@id="datatable-FutasTeljesitmeny_RogzitettOraAllasok"]/tbody',

    'accidents_tab': '//*[@id="tabitem-BiztositasKartortenet"]',
    'accidents': '//*[@id="datatable-Karesemeny"]/tbody',

    'inspections_tab': '//*[@id="tabitem-MuszakiAllapot"]',
    'inspections': '//a[contains(@href, "_collapsible-MuszakiAllapot")]',
    'inspections_show_pictures': '//button[contains(@id, "MuszakiAllapot_Kepek_megjelenitese")]',
    'inspections_pictures_dialog_frame': '//*[@id="dialog_frame"]',
    'inspections_pictures': '//img[contains(@title, " kép")]',
    'inspections_close_button': '//button[@id="button-bezaras"]',

    'error_modal': '//h4[contains(text(), "Hiba")]',
    'unreleased_license_plate': '//p[contains(text(), "A rendszám nem került kiadásra Magyarországon.")]',
    'no_accident_record': '//p[contains(text(), "A jármű kártörténetéről nem szolgáltatható adat.")]',
    'try_again_later': '//p[contains(text(), "Kérjük, adatigénylését ismételje meg később.")]',
    'error_modal_button': '//*[@id="snap-dialog-ok-button"]',

    'logout_button': '//*[@id="kijelentkezes"]'
}
