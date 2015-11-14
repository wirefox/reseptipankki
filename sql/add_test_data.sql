INSERT INTO KAYTTAJA (etunimi, sukunimi, kayttajatunnus, salasana, rooli) 
    VALUES ('Arttu', 'Testinen', '12345888', '55555', '0');
INSERT INTO KAYTTAJA (etunimi, sukunimi, kayttajatunnus, salasana, rooli) 
    VALUES ('Elina', 'Testaaja', '1234699', '55556', '1');

INSERT INTO RAAKA_AINE (nimi, ravintoarvo) VALUES ('vehnäjauho', 'http://www.fineli.fi/food.php?foodid=110&lang=fi');
INSERT INTO RAAKA_AINE (nimi, ravintoarvo) VALUES ('kevytmaito', 'http://www.fineli.fi/food.php?foodid=684&lang=fi');

INSERT INTO KATEGORIA (nimi) VALUES ('Makeat leivonnaiset');
INSERT INTO KATEGORIA (nimi) VALUES ('Suolaiset leivonnaiset');
INSERT INTO KATEGORIA (nimi) VALUES ('Jälkiruuat');
INSERT INTO KATEGORIA (nimi) VALUES ('Pääruuat');
INSERT INTO KATEGORIA (nimi) VALUES ('Salaatit');
INSERT INTO KATEGORIA (nimi) VALUES ('Keitot');
INSERT INTO KATEGORIA (nimi) VALUES ('Alkuruuat');

INSERT INTO RESEPTI (nimi, kategoria, annoksia, valmistusohje, kuva, lahde, lisayspvm, muokkauspvm) 
    VALUES ('Pulla', 'Makeat leivonnaiset', '25', 'Liuota hiiva kädenlämpöiseen maitoon. Sekoita joukkoon suola, sokeri, kardemumma ja muna. Lisää jauhot vähitellen, aluksi vatkaten, jotta ilmaa sitoutuu taikinaan. Alusta taikina hyvin vaivaten. Lisää pehmeä rasva alustamisen loppupuolella. Laita taikina peitettynä kohoamaan lämpimään, vedottomaan paikkaan. Kun taikina on kohonnut kaksinkertaiseksi, ota se leivinpöydälle ja vaivaa taikinasta ilmakuplat pois. Leivo taikinasta haluamasi muotoisia pullia. Kohota pullat kaksinkertaisiksi, voitele ne munalla ja koristele raesokerilla ennen paistamista. Paista pikkupullat ja pienet leivonnaiset n. 225-asteisen uunin keskitasolla 5-10 min. Paista pitkot ja muut isommat vehnäleivät n. 200-asteisen uunin alatasolla 20-25 min.', 'http://www.myllynparas.fi/files/images/300_reseptikuvat/makeat_leivonnaiset/pulla-myllyn-paras-300.jpg', 'http://www.myllynparas.fi/suomi/reseptit/makeat_leivonnaiset/pullat_ja_wienerit/pulla/', NOW(), NOW());
INSERT INTO RESEPTI (nimi, kategoria, annoksia, valmistusohje, kuva, lahde, lisayspvm, muokkauspvm) 
    VALUES ('Juustopiirakka', 'Suolaiset leivonnaiset', '8', 'Tee pohja. Mittaa jauhot, voi ja suola monitoimikoneen kulhoon. Sekoita tasaiseksi ja murumaiseksi. Voit tehdä taikinan myös käsin nyppimällä. Kun seos on tasaista, lisää sekaan pieni määrä kylmää vettä, jotta saat sopivan taikinapallon. Pingota leivinpaperi (n. 26 cm) irtopohjavuoan pohjalle ja voitele reunat. Kauli tai levitä taikina leivinpaperilla vuoratun irtopohjavuoan pohjalle ja reunoille jauhoja apuna käyttäen. Pane vuoka jääkaappiin noin 15 minuutiksi. Sekoita täytteen ainekset kevyesti keskenään. Ota taikinapohja kylmästä ja levitä sen päälle leivinpaperi. Kaada päälle paistokuulat tai kuivattuja herneitä ja esipaista pohjaa 225 asteessa noin 10 minuuttia. Nosta herneet leivinpapereineen pois pohjan päältä.Kaada täyte pohjalle ja jatka paistamista 200 asteisessa uunissa noin 40 minuuttia. Seuraa paistopintaa, jotta se ei paistu liikaa. Tarjoa piirakka jäähtyneenä smetanan, paistetun pekonin ja punasipulin kera. Koristele vuonankaalilla. ', 'http://is13.snstatic.fi/img/658/1443764586032.jpg', 'http://www.iltasanomat.fi/ruokala/resepti/art-1443764597334.html', NOW(), NOW());
INSERT INTO RESEPTIN_RAAKAAINE (resepti_id, raakaAine_id, maara, yksikko) 
    VALUES ('1', '1', '10', 'dl');
INSERT INTO RESEPTIN_RAAKAAINE (resepti_id, raakaAine_id, maara, yksikko) 
    VALUES ('2', '2', '5', 'dl');