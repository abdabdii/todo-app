<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/models/Importances.php');

class ImportancesView extends Importances{

    public function makeSchema($schema){
        echo '
    <div class="schema" schema-id="'.$schema['id'].'">
        <p>Schema Number '.$schema['id'].''.(($schema["user_id"])!==NULL?'<button class="delete-schema"><i class="far fa-trash-alt delete"></i></button>':'').'</p>
        <div class="colors-schema">
            <div class="color-schema" data-importance="5" style="background-color:#'.$schema['extremely_important'].'" ></div>
            <div class="color-schema" data-importance="4" style="background-color:#'.$schema['very_important'].'" ></div>
            <div class="color-schema" data-importance="3" style="background-color:#'.$schema['important'].'" ></div>
            <div class="color-schema" data-importance="2" style="background-color:#'.$schema['less_important'].'" ></div>
            <div class="color-schema" data-importance="1" style="background-color:#'.$schema['normal'].'" ></div>
        </div>
    </div>';
    }

    public function getSchemaById($schema_id){
        $schema = $this->getById($schema_id);
        $this->makeSchema($schema[0]);
    }

    public function getSchemas($user_id){
        $schemas = $this->get($user_id);
        foreach ($schemas as $schema){
            $this->makeSchema($schema);
        }
    }





}