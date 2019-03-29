<?php

namespace App\Http\Controllers;

use App\Models\#beginNodeName#endNodeName;


use App\Models\MiscThing;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMiscThings;

use DB;
//use App\Http\Controllers\Schema;

class #beginNodeName#endNodeNameController extends CRHBaseController
{
        public function __construct(
     
        /**/
        $buttons_in_front               = "",
        $print_orientation              = "",
        $record_type                    = "table_controller", 
        //$db_connection_name             = "blues_main", 
        $db_connection_name             = "", 
        $db_snippet_connection          = "",
        $db_data_connection             = "",
        //$db_snippet_connection          = "",
        // set unique values for table controller
        //flagEn0 dont chage or remove this line or line above
        $controller_name                = "#beginNodeName#endNodeNameController", 
        $model_table                    = "#beginNodeName#endNodeName",         
        $model                          = "#beginNodeName#endNodeName", 
        $node_name                      = "#beginNodeName#endNodeName", 
        //flagStart1 dont chage or remove this line

        $report_definition_model_name   = "Report_Definition_Model",

        $no_of_blank_entries            = "5", 
        $snippet_table                  = "miscThings", 
        $snippet_table_key_field_name   = "id", 
        $backup_node                    = "backup_before_redirect_to_baseline", 
        $generated_files_folder         = "generated_files", 
        $key_field_name                 = "id", 
        $bypassed_field_name            = "not_used",
        $view_files_prefix              = "",

        $field_list_array_name              = "",
        $field_name_list_array              = "",
        $field_name_lists_array             = "",
        $field_name_list_array_first_index  = "",
        $my_ctr                             = 0,
        $report_definition_id               = 0,
        $store_validation_id                = 0,
        $business_rules_array               = 0

        ) 
        {
        
         parent::__construct();
        //$this->debug_exit(__FILE__,__LINE__,0); echo(" entering constructor");

        $this->db_connection_name              = $db_connection_name;
        $this->db_data_connection              = $db_data_connection;
        $this->db_snippet_connection           = $db_snippet_connection;
        //$this->db_snippet_connection           = "";
       
        $this->model                            = $model;
        $this->model_table                      = $model_table;
        $this->snippet_table                    = $snippet_table;
        $this->snippet_table_key_field_name     = $snippet_table_key_field_name;
        $this->node_name                        = $node_name ;

        $this->link_parms_array               = $this->derive_entity_names_from_table(" ",$this->node_name);
        //$link_parms_array = array(
        //'controller_name',   
        //'model_table',   
        //'model',       
        //'node_name',        
        //field_name_string');

        $this->report_definition_model_name     = $report_definition_model_name;
        //* $this->report_definition_id is the same for all tables
        //* because their node_names change, we need to define where this is
        $this->report_definition_id             =  $this->get_report_definition_id(
            'report_definition',
            $this->snippet_node_name,
            $this->report_definition_model_name
            );


        $this->backup_node                      = $backup_node;
        $this->generated_files_folder           = $generated_files_folder;
        $this->key_field_name                   = $key_field_name;
        $this->bypassed_field_name              = $bypassed_field_name;     
        $this->no_of_blank_entries              = $no_of_blank_entries;

        // these are derived
        $this->views_files_path     = substr(app_path(),0,strlen(app_path())-4)."/resources/views/".$this->node_name;
        $this->storage_path         = substr(app_path(),0,strlen(app_path())-4)."/storage";
        $this->controllers_path     = app_path()."/Http/Controllers";
        $this->routes_path          = app_path()."/Http";
        $this->key_field_array      = array($this->snippet_table_key_field_name=>$this->snippet_table_key_field_name);
        $this->make_sure_table_snippet_exists($this->model_table);
        //$this->debug_exit(__FILE__,__LINE__,0);
        $this->generated_snippets_array        = $this->get_generated_snippets();

       //config
        $this->database_connection_config_path = substr(app_path(),0,strlen(app_path())-4)."/config/";
        
        //controllers
        $node =  "controllers";
        $this->DEHbase_controller_path     = app_path()."/Http/Controllers/";
         $this->stored_connections_path = substr(app_path(),0,strlen(app_path())-4).'/storage/connections/'. $this->db_connection_name ;

        $this->my_ctr = $my_ctr;
        //routes

        // these are derived
 
        $this->view_files_prefix                = $this->views_files_path;
        $this->key_field_array                  = array($this->snippet_table_key_field_name=>$this->snippet_table_key_field_name);
        $this->key_field_name_array             = array($this->snippet_table_key_field_name=>$this->snippet_table_key_field_name);
        $this->make_sure_table_snippet_exists($this->model_table);
        //$this->debug_exit(__FILE__,__LINE__);
        $this->generated_snippets_array         = $this->get_generated_snippets();
        // generated_snippets are arrays that are generated when the properties



        //$this->required_fields_array            = $this->generated_snippets_array['required_fields_array'];
        //echo $this->view_files_prefix ;exit ("exit in constructor");


        // THIS IS HOW WE CHANGE CONNECTIONS (they're currently hardcoded to homestead)
        $dataModel = $this->link_parms_array['controller_name'];
        $this->snippet_model_parms = $this->derive_entity_names_from_table(" ",$this->snippet_table);
        $snippetController = $this->snippet_model_parms['controller_name'];
        $snippetModel = $this->snippet_model_parms['model'];
        //echo($snippetModel);exit("exit at 146");
        //$MiscThing = new $snippetModel;
        //$MiscThing->setConnection("homestead");
        $miscThings = MiscThing
            ::where('record_type'       ,'='    ,'table_controller')
            ->where('controller_name'   ,'='    ,"MiscThingsController")
            ->get();
        $this->db_snippet_connection            = $miscThings[0]->db_snippet_connection;
        $this->db_data_connection               = $miscThings[0]->db_data_connection;
        
        $this->db_snippet_connection            = "homestead";
        $this->db_data_connection               = "homestead";
       
        //$this->debug_exit(__FILE__,__LINE__,0);
        $this->field_name_lists_array = $field_name_lists_array;
        $this->field_name_list_array = "";
        // **************
        // field_name_list_array defines the arrays depending on $what_we_are_doing
        // the first level index 
        // $this->field_name_list_array = (array) $this->initialize_field_name_list_array();
        // **************
        $this->field_name_list_array_first_index = $field_name_list_array_first_index;
        //$this->debug_exit(__FILE__,__LINE__,0); echo(" leaving constructor");
        $this->report_definition_id         = $this->report_definition_id;

        $this->business_rules_array         = $business_rules_array;
        $this->store_validation_id          = $this->report_definition_id;
    }

    public function initialize_query($distinct_regular,$field_name,$r_o,$v) {
    // *****************
    // this initializes the query pointing to the correct model
    // ****************
        switch ($distinct_regular) { 
            case "distinct":
                $query = #beginNodeName#endNodeName::distinct()->select($field_name);
                echo("#beginNodeName#endNodeName::distinct()->select(".$field_name.")");
                break;
            case "regular":
                $query = #beginNodeName#endNodeName::where($field_name,$r_o,$v);
                echo("#beginNodeName#endNodeName::where(".$field_name.",". $r_o. ",".$v.")");
                //$this->debug0(__FILE__,__LINE__,__FUNCTION__);

                 break;
       }   
       return $query;

    }








 
    public function editUpdate(
        Request $request, 
        $id, 
        $what_we_are_doing, 
        $coming_from,
        $report_definition_key){
        echo("<br> editUpdate... ".
            ' what_we_are_doing: '. $what_we_are_doing.
            ", id: ".$id.
            ', coming_from: '.$coming_from.
            ', report_definition_key: '.$report_definition_key);
        //$this->debug_exit(__FILE__,__LINE__,10);
        //var_dump($request);
        //echo("editUpdate");$this->debug_exit(__FILE__,__LINE__,10);
        if (!empty($what_we_are_doing)) {
            //echo("editUpdate");$this->debug_exit(__FILE__,__LINE__,0);
            $report_definition  = MiscThing::where('id','=',$report_definition_key)->get();
            $working_arrays     = $this->working_arrays_construct($report_definition[0]);
            switch ($what_we_are_doing) { 
                case "edit2_default_add":
                case "edit2new":
                case "edit2_default_edit":
                case "editing_a_data_record":
                    //$request->input('data_key');
                    //var_dump(Input::all()); $this->debug_exit(__FILE__,__LINE__,0);
                    //$report_definition  = $this->execute_query_by_report_no($id);
                    $modifiable_fields_array = $working_arrays['maintain_modifiable_fields']['modifiable_fields_array'];

                    $lookups_array['field_name'] = $this->build_column_names_array($this->model_table);
                    //var_dump($modifiable_fields_array); $this->debug_exit(__FILE__,__LINE__,10);

                    $fieldname_name_value_array = $this->bld_name_value_lookup_array($this->model_table);
                    //$lookups_array = $this->bld_name_value_lookup_array('shows');
                    $lookups_array = array_merge($lookups_array,$fieldname_name_value_array);
                    //var_dump($report_definition_key); $this->debug_exit(__FILE__,__LINE__,1);

                    $MiscThing  = MiscThing::where('id','=',$id)->get();
                    if($MiscThing){
                        $array1  = $this->return_modifiable_fields_array($what_we_are_doing,$report_definition_key,$modifiable_fields_array); 
                        $array1  = $this->return_modifiable_fields_array($what_we_are_doing,$id,$modifiable_fields_array); 
                       //echo('id' .$id);//var_dump($MiscThing[0]);var_dump($modifiable_fields_array);
                        //var_dump($array1);$this->debug_exit(__FILE__,__LINE__,0);
                        $snippet_string = $this->snippet_gen_modifiable_fields(
                            $modifiable_fields_array,
                            $lookups_array,
                            $array1);                   }   


                        $fnam = $this->view_files_prefix."/".$this->generated_files_folder."/".$id.'_snippet_string.blade.php';
                       //var_dump($fnam);$this->debug_exit(__FILE__,__LINE__,01);
                        $this->write_file_from_string($fnam,$snippet_string);
    

                        $edit_snippet_file_name ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.$MiscThing[0]->id.'_snippet_string';
                        //$edit_snippet_file_name = $fnam;
                        //debug_exit(__FILE__,__LINE__,1);   
                        $passed_to_view_array                                   = array();
                        $passed_to_view_array['edit_snippet_file_name']         = $edit_snippet_file_name;
                        $passed_to_view_array['id']                             = $id;
                        $passed_to_view_array['report_definition_key']          = $report_definition_key;
                        $passed_to_view_array['coming_from']                    = $coming_from;

                        $passed_to_view_array['encoded_modifiable_fields_array'] = 
                            json_encode($modifiable_fields_array);
                        $passed_to_view_arra2newy['data_key']                   = $request->input('data_key');
                        $passed_to_view_array['encoded_input']                  = $request->input('encoded_input');
                        $passed_to_view_array['snippet_name']                   ='_modifiable_fields_getEdit_snippet';
                        $passed_to_view_array['encoded_business_rules']                           = 
                            ($report_definition[0]['business_rules']);
                        $passed_to_view_array['report_definition']              = $report_definition[0];
                        $passed_to_view_array['record']                         = $MiscThing[0];
                        $passed_to_view_array['encoded_report_definition']      = json_encode($report_definition[0]);       
                        $passed_to_view_array['snippet_string']                 = $snippet_string;      
                        $passed_to_view_array['lookups_array']                  = $lookups_array;       
                        //echo("*".$request->input('coming_from')."*");$this->debug_exit(__FILE__,__LINE__,0);
                        //var_dump($passed_to_view_array['record']);$this->debug_exit(__FILE__,__LINE__,1);      
                // *****
                // return to view
                // *****
                        var_dump($request->input);$this->debug_exit(__FILE__,__LINE__,1);

                        return view($this->node_name.'.editUpdate',compact('miscThings'))
                        ->with('node_name'   ,$this->node_name)            
                        ->with('passed_to_view_array'   ,$passed_to_view_array);            
                        break;          
            case "edit2_default_update":
            //case "updating_data_record": // defined in editUpdate
                //echo("<BR>".$what_we_are_doing);$this->debug_exit(__FILE__,__LINE__,10);
                //var_dump($request);$this->debug_exit(__FILE__,__LINE__,1);
                $requestFieldsArray=$request->all(); // important!!

                //var_dump($working_arrays['ppv_define_business_rules']['business_rules_r_o_array']);
                //var_dump($this->build_business_rules_relational_operators());$this->debug_exit(__FILE__,__LINE__,1);
                var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,1);

                //$validator = Validator::make(Input::all(), $business_rules_array); //update
                if ( $validator->fails() ) {
                    $errors = $validator->messages();
                    $this->debug_exit(__FILE__,__LINE__,1);
                    //return redirect()->back(); 
                    //return redirect('public/admin/'.$this->node_name.'/editUpdate')
                    return View::make($this->node_name.'/editUpdate')
                        //->with('passed_to_view_array' ,$passed_to_view_array);            

                    //->withErrors($errors)
                    ->withInput();
                      //return $validator->errors()->all();
                    //return back()->withErrors($errors)->withInput();
                }
                
                //$this->debug_exit(__FILE__,__LINE__,1);
                $a = 'encoded_modifiable_fields_array';
                $Inputo = json_decode(json_encode(Input::all()),0);
                $modifiable_fields_array = $this->decode_object_field_to_array($Inputo,$a);
                //var_dump($b);
                //$this->debug_exit(__FILE__,__LINE__,1);
                switch ($request->input('coming_from')) {
                    
                    case "edit2_browse_add_button":
                        $updatex  = #beginNodeName#endNodeName
                            ::insert($modifiable_fields_name_values);
                        break;
                    case "edit2_edit_button":
                        $updatex  = #beginNodeName#endNodeName
                            ::where($this->key_field_name,  '=', $request->input('data_key'))
                            ->update($modifiable_fields_name_values);
                        break;
                }


                return redirect('admin/'.$this->node_name.'/edit1')
                ->with('message', 'record updated')
                ->with('message', 'validation has been bypassed');
                break;

                    default:
                        echo("<br>"."what we are doing is improperly assigned");
                        $this->debug_exit(__FILE__,__LINE__,1);
                        break;
                }
        }   
    }

    
}
