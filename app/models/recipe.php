<?php

class Resepti extends BaseModel {

    public $id,
            $nimi,
            $kategoria,
            $annoksia,
            $valmistusohje,
            $kuva,
            $lahde,
            $lisayspvm,
            $muokkauspvm;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Resepti');
        $query->execute();
        $rows = $query->fetchAll();
        $reseptit = array();

        foreach ($rows as $row) {
            $reseptit[] = new Resepti(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kategoria' => $row['kategoria'],
                'annoksia' => $row['annoksia'],
                'valmistusohje' => $row['valmistusohje'],
                'kuva' => $row['kuva'],
                'lahde' => $row['lahde'],
                'lisayspvm' => $row['lisayspvm'],
                'muokkauspvm' => $row['muokkauspvm']
            ));
        }

        return $reseptit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Resepti WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $resepti = new Resepti(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kategoria' => $row['kategoria'],
                'annoksia' => $row['annoksia'],
                'valmistusohje' => $row['valmistusohje'],
                'kuva' => $row['kuva'],
                'lahde' => $row['lahde'],
                'lisayspvm' => $row['lisayspvm'],
                'muokkauspvm' => $row['muokkauspvm'],
            ));
            return $resepti;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare
                ('INSERT INTO Resepti (nimi, kategoria, annoksia, valmistusohje, kuva, lahde, lisayspvm, muokkauspvm) '
                . 'VALUES (:nimi, :kategoria, :annoksia, :valmistusohje, :kuva, :lahde, NOW(), NOW()) RETURNING id');
        $query->execute(array(
            'nimi' => $this->nimi,
            'kategoria' => $this->kategoria,
            'annoksia' => $this->annoksia,
            'valmistusohje' => $this->valmistusohje,
            'kuva' => $this->kuva,
            'lahde' => $this->lahde));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare
                ('UPDATE Resepti SET 
                    nimi = :nimi, 
                    kategoria = :kategoria, 
                    annoksia = :annoksia,
                    valmistusohje = :valmistusohje,
                    kuva = :kuva,
                    lahde = :lahde
                WHERE id = :id');
        $query->execute(array(
            'id' => $this->id,
            'nimi' => $this->nimi,
            'kategoria' => $this->kategoria,
            'annoksia' => $this->annoksia,
            'valmistusohje' => $this->valmistusohje,
            'kuva' => $this->kuva,
            'lahde' => $this->lahde));
    }

}
