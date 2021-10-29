<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/models/Importances.php');

class ImportancesController extends Importances{
    
    /**
     * createImportance
     *
     * @param  String $eimportant extremely important column
     * @param  String $vimportant very important column
     * @param  String $imporant   important column
     * @param  String $limportant less important column
     * @param  String $normal     normal column
     * @param  Integar $user_id 
     * @return Integar inserted id of the importance
     */
    public function createImportance($eimportant,$vimportant,$imporant,$limportant,$normal,$user_id){
        return $this->create($eimportant,$vimportant,$imporant,$limportant,$normal,$user_id);
        // return $this->connect()->lastInsertId();
    }
    
    /**
     * updateImportance
     *
     * @param  Integar $id of importance
     * @param  String $eimportant extremely important column
     * @param  String $vimportant very important column
     * @param  String $imporant   important column
     * @param  String $limportant less important column
     * @param  String $normal     normal column
     * @return Bolean true if successfully updated
     */
    public function updateImportance($id,$eimportant,$vimportant,$imporant,$limportant,$normal){
        $this->update($id,$eimportant,$vimportant,$imporant,$limportant,$normal);
        return true;
    }
    
    /**
     * deleteImportance
     *
     * @param  Integar $id
     * @return Bolean true if deleted succefully
     */
    public function deleteImportance($id){
        $this->destroy($id);
        return true;
    }


    /**
     * getSchemaById get schema by id
     *
     * @param  Integar $id
     * @return AssocArray
     */
    public function getSchemaById($schema_id){
        $schema = $this->getById($schema_id);
        return $schema[0];
    }
}


//Testing

// $importanceCont = new ImportancesController();
//  $id = $importanceCont->createImportance('d32f2f','e53935','f44336','e57373','ef9a9a',2);
//  echo $id;
// $importanceCont->updateImportance(38 , 'ffffff','ffffff','ffffff','ffffff','ffffff','ffffff');
// $importanceCont->deleteImportance(37);