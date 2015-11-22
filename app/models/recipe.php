<?php

class Recipe extends BaseModel {

    public $id,
            $recipe_name,
            $category,
            $portion_amount,
            $instruction,
            $picture,
            $recipe_source,
            $added;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_category', 'validate_portion', 'validate_instruction', 'validate_picture', 'validate_recipe_source');
    }

//    public static function all($options) {
//        $query_string = 'SELECT * FROM Recipe WHERE id = :id';
//        $options = array('id' => $options['id']);
//        if (isset($options['search'])) {
//            $query_string .= ' AND recipe_name LIKE :like';
//            $options['like'] = '%' . $options['search'] . '%';
//        }
//        $query = DB::connection()->prepare($query_string);
//        $query->execute($options);
//
//        $rows = $query->fetchAll();
//        $recipes = array();
//
//        foreach ($rows as $row) {
//            $recipes[] = new Recipe($row);
//        }
//        return $recipes;
//    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Recipe');
        $query->execute();

        $rows = $query->fetchAll();
        $recipes = array();

        foreach ($rows as $row) {
            $recipes[] = new Recipe(array(
                'id' => $row['id'],
                'recipe_name' => $row['recipe_name'],
                'category' => $row['category'],
                'portion_amount' => $row['portion_amount'],
                'instruction' => $row['instruction'],
                'picture' => $row['picture'],
                'recipe_source' => $row['recipe_source'],
                'added' => $row['added']
            ));
        }

        return $recipes;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Recipe WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $recipe = new Recipe(array(
                'id' => $row['id'],
                'recipe_name' => $row['recipe_name'],
                'category' => $row['category'],
                'portion_amount' => $row['portion_amount'],
                'instruction' => $row['instruction'],
                'picture' => $row['picture'],
                'recipe_source' => $row['recipe_source'],
                'added' => $row['added']
            ));
            return $recipe;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare
                ('INSERT INTO Recipe (recipe_name, category, portion_amount, instruction, picture, recipe_source, added) '
                . 'VALUES (:recipe_name, :category, :portion_amount, :instruction, :picture, :recipe_source, NOW()) RETURNING id');
        $query->execute(array(
            'recipe_name' => $this->recipe_name,
            'category' => $this->category,
            'portion_amount' => $this->portion_amount,
            'instruction' => $this->instruction,
            'picture' => $this->picture,
            'recipe_source' => $this->recipe_source));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare
                ('UPDATE Recipe SET 
                    recipe_name = :recipe_name, 
                    category = :category, 
                    portion_amount = :portion_amount,
                    instruction = :instruction,
                    picture = :picture,
                    recipe_source = :recipe_source
                WHERE id = :id');

        $query->execute(array(
            'id' => $this->id,
            'recipe_name' => $this->recipe_name,
            'category' => $this->category,
            'portion_amount' => $this->portion_amount,
            'instruction' => $this->instruction,
            'picture' => $this->picture,
            'recipe_source' => $this->recipe_source));

//        $row = $query->fetch(); TÄMÄ RIVI PITÄÄ EHKÄ LAITTAA TAKAISIN (POISTETTU 20.11)
//$this->id = $row['id'];
//        Kint::dump($row);
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Recipe WHERE id = :id');

        $query->execute(array('id' => $this->id));
    }

    public function validate_name() {
        $errors = array();
        if ($this->recipe_name == '' || $this->recipe_name == null) {
            $errors[] = 'Nimi ei saa olla tyhjä.';
        }
        if (strlen($this->recipe_name) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään 3 merkkiä.';
        }
        if (strlen($this->recipe_name) > 50) {
            $errors[] = 'Nimen pituuden tulee olla enintään 50 merkkiä.';
        }
        return $errors;
    }

    public function validate_category() {
        $errors = array();
        if ($this->category == 'Valitse...') {
            $errors[] = 'Valitse kategoria';
        }
        return $errors;
    }

    public function validate_portion() {
        $errors = array();
        if ($this->portion_amount == '' || $this->portion_amount == null) {
            $errors[] = 'Annosmäärä ei saa olla tyhjä.';
        }
//        if (is_numeric($this->portion) < 1) {
//            $errors[] = 'Annosmäärän tulee olla vähintään 1.';
//        }

        if (!is_numeric($this->portion_amount)) {
            $errors[] = 'Annosmäärän tulee olla numero.';
        }
        return $errors;
    }

    public function validate_instruction() {
        $errors = array();
        if ($this->instruction == '' || $this->instruction == null) {
            $errors[] = 'Valmistusohje ei saa olla tyhjä.';
        }
        if (strlen($this->instruction) < 3 && strlen($this->instruction) > 3000) {
            $errors[] = 'Valmistusohjeen pituuden tulee olla vähintään 3 merkkiä.';
        }
        if (strlen($this->instruction) > 3000) {
            $errors[] = 'Valmistusohjeen pituuden tulee olla enintään 3000 merkkiä.';
        }
        return $errors;
    }

    public function validate_picture() {
        $errors = array();
        if ($this->picture == '' || $this->picture == null) {
            $errors[] = 'Kuvan lähdeviite ei saa olla tyhjä.';
        }
        if (strlen($this->picture) < 3) {
            $errors[] = 'Kuvan lähdeviitteen pituuden tulee olla vähintään 3 merkkiä.';
        }
        return $errors;
    }

    public function validate_recipe_source() {
        $errors = array();
        if ($this->recipe_source == '' || $this->recipe_source == null) {
            $errors[] = 'Reseptin lähde ei saa olla tyhjä.';
        }
        if (strlen($this->recipe_source) < 3) {
            $errors[] = 'Reseptin lähteen pituuden tulee olla vähintään 3 merkkiä.';
        }
        return $errors;
    }

}
