class XPATHS:
    main_frame = '//*[@id="main"]/iframe'
    login_methods = '//*[@id="dropdown-control-id"]'
    login_method = '//*[@id="urn:eksz.gov.hu:1.0:azonositas:kau:2:uk:totp"]/button'
    username_field = '//*[@id="name"]'
    password_field = '//*[@id="password"]'
    verification_code_field = '//*[@id="identifier"]'
    login_button = '//input[@value="Bejelentkezés"]'
    accident_record_checkbox = '//input[@id="checkbox-BiztositasKartortenet"]'
    inspection_record_checkbox = '//input[@id="checkbox-MuszakiAllapot"]'
    request_page = '//title[text() = "Jármű Szolgáltatási Platform"]'
    search_input = '//input[@id="input-rendszam"]'
    car_page = '//h1[@id="header-jarmu_adatai"]'
    no_official_data = '//p[contains(text(), "A járműhöz nem tartoznak okmányadatok.")]'
    no_inspection_data = '//p[contains(text(), "A járműhöz nem tartoznak a műszaki állapotára vonatkozó adatok.")]'
    error_modal = '//h4[contains(text(), "Hiba")]'
    unreleased_license_plate = '//p[contains(text(), "A rendszám nem került kiadásra Magyarországon.")]'
    no_accident_record = '//p[contains(text(), "A jármű kártörténetéről nem szolgáltatható adat.")]'
    no_inspection_record = '//p[contains(text(), "műszaki állapot")]'
    no_vehicle_management_record = (
        '//p[contains(text(), "A járműigazgatási adatok jelenleg nem elérhetők. Kérjük, próbálja meg később.")]'
    )
    try_again_later = '//p[contains(text(), "Kérjük, adatigénylését ismételje meg később.")]'
    error_modal_button = '//*[@id="snap-dialog-ok-button"]'
    brand = '//*[contains(@id, "Gyartmany") and string-length(text())]'
    model = '//*[contains(@id, "Kerleiras") and string-length(text())]'
    type_code = '//*[contains(@id, "Tipus") and string-length(text())]'
    status = '//*[contains(@id, "ForgalmiAllapot") and string-length(text())]'
    first_reg = '//*[contains(@id, "ElsoForgHelyezes") and string-length(text())]'
    first_reg_hun = '//*[contains(@id, "ElsoMoForgHelyezes") and string-length(text())]'
    logout_button = '//*[@id="kijelentkezes"]'
    num_of_owners = '//*[contains(@id, "OsszesTulaj") and string-length(text())]'
    year = '//*[contains(@id, "GyartasiEv") and string-length(text())]'
    engine_size = '//*[contains(@id, "Hengerurtartalom") and string-length(text())]'
    performance = '//*[contains(@id, "text-Teljesitmeny") and contains(text(), " kW")]'
    fuel_type = '//*[contains(@id, "Uzemanyag") and string-length(text())]'
    gearbox = '//*[contains(@id, "Sebessegvalto") and string-length(text())]'
    color = '//*[contains(@id, "Szin") and string-length(text())]'
    restrictions_tab = '//*[@id="tabitem-ForgtartasForgkorlat"]'
    restrictions = '//*[@id="datatable-Forgkorlat"]/tbody'
    mileage_tab = '//*[@id="tabitem-FutasTeljesitmeny"]'
    mileage = '//*[@id="datatable-FutasTeljesitmeny_RogzitettOraAllasok"]/tbody'
    accidents_tab = '//*[@id="tabitem-BiztositasKartortenet"]'
    accidents = '//*[@id="datatable-Karesemeny"]/tbody'
    inspections_tab = '//*[@id="tabitem-MuszakiAllapot"]'
    inspections = '//a[contains(@href, "_collapsible-MuszakiAllapot")]'
    inspections_show_pictures = '//button[contains(@id, "MuszakiAllapot_Kepek_megjelenitese")]'
    inspections_pictures_dialog_frame = '//*[@id="dialog_frame"]'
    inspections_pictures = '//img[contains(@title, " kép")]'
    inspections_close_button = '//button[@id="button-bezaras"]'
    accident_record_ckeckbox = '//input[@id="checkbox-BiztositasKartortenet"]'
    inspection_record_ckeckbox = '//input[@id="checkbox-MuszakiAllapot"]'
    inspections_no_pictures = '//p[contains(text(), "A járműről nem szolgáltathatók műszaki vizsgálati képek.")]'
    inspections_tab = '//*[@id="tabitem-MuszakiAllapot"]'
    inspections = '//a[contains(@href, "_collapsible-MuszakiAllapot")]'
    restrictions_tab = '//*[@id="tabitem-ForgtartasForgkorlat"]'
    restrictions = '//*[@id="datatable-Forgkorlat"]/tbody'
    originality_tab = '//*[@id="tabitem-SzarmazasEredet"]'
    originalities = '//a[contains(@href, "_collapsible-EredetVizsga")]'
    originality_show_pictures = '//button[contains(@id, "EredetVizsga_Kepek_megjelenitese")]'
    no_originality_data = (
        '//p[contains(text(), "A járműhöz nem tartoznak származásellenőrzési és eredetiségvizsgálati adatok.")]'
    )
