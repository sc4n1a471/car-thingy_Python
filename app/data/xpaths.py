XPATHS = {
    'main_frame': '//*[@id="main"]/iframe',

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
    'error_modal_button': '//*[@id="snap-dialog-ok-button"]',

    'logout_button': '//*[@id="kijelentkezes"]'
}