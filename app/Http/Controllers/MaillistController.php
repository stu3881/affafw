<?php

namespace App\Http\Controllers;

use App\Models\Maillist;
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

class MaillistController extends CRHBaseController
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
        $controller_name                = "MaillistController", 
        $model_table                    = "maillist",         
        $model                          = "Maillist", 
        $node_name                      = "maillist", 
        $snippet_model                  = "MiscThing",
        $link_parms_array               = "",

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
        $business_rules_array               = 0,
        $MyWorkingArray                     = array()
        

        ) 
        {
        
         parent::__construct();
        //$this->debug_exit(__FILE__,__LINE__,0); echo(" entering constructor");

        $this->MyWorkingArray                  = new  WorkingArray;
        $this->db_connection_name              = $db_connection_name;
        $this->db_data_connection              = $db_data_connection;
        $this->db_snippet_connection           = $db_snippet_connection;
        //$this->db_snippet_connection           = "";
       
        $this->model                            = $model;
        $this->model_table                      = $model_table;
        $this->snippet_table                    = $snippet_table;
        $this->snippet_table_key_field_name     = $snippet_table_key_field_name;
        $this->node_name                        = $node_name ;
        $this->snippet_model                    = $snippet_model;

        $this->link_parms_array                 = $this->derive_entity_names_from_table($this->node_name);
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
        $this->snippet_model_parms = $this->link_parms_array;
        $snippetController = $this->snippet_model_parms['controller_name'];
        $snippetModel = $this->snippet_model_parms['model'];
        //echo($snippetModel);exit("exit at 146");
        
        
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function xcreate_w_report_id(REQUEST $request, $report_definition_key) {
        // *******************
        // you can only get here after a table has been activated so all that needs to be 
        // done is to insert a report definition and the snippet files
        // *******************
        $link_parms_array = $this->link_parms_array;
        
        //echo $this->node_name;//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);    
        if ($miscThing = MiscThing    
 
            ::where('record_type',  '=', "report_definition")
            ->where('node_name',  '=', $link_parms_array['node_name'])
            ->get())
            //->orderBy('created_at','DESC')
            //->orderBy('created_at')
     {

        //$required_entities = $this->generic_method_define_required_entities();
        $msgs_array = array();
        $search_str_array = array(
            'controller_name'   => "MaillistController",
            'model_table'       => "maillist",
            'model'             => "Maillist",
            'node_name'         => "maillist",
            'field_name_string' => "@@field_name_string@@"
            );
        echo("<br/>nn ".$this->node_name);
        $link_parms_array = $this->link_parms_array;
        //var_dump($link_parms_array);

        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $parm2_array = array();
        $parm2_array[1]  = $report_definition_key;
         //echo(" * ".$this->node_name." * ". $this->get_report_definition_id('report_definition',$this->node_name, 'xxx'));
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $required_entities = array(
            'model_report_definition'       => 'model_report_definition'
            );
        // just this one 
        foreach ($required_entities as $entity=>$entity_name) {
            //echo("<br/>".$entity);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            $msgs_array = $this->generic_method_activate_entity($entity,$search_str_array,$msgs_array,$link_parms_array,$parm2_array,$this->node_name);
            }

        $coming_from = "create_w_report_id";
        $id = $report_definition_key;
        return view($this->node_name.'.reportDefMenuEdit',compact('miscThing'))
            ->with('id'                                 ,$id)
            ->with('report_definition_id'               ,$report_definition_key)
            ->with('model'                              ,$this->model)
            ->with('node_name'                          ,$this->node_name)
            ->with('what_we_are_doing'                  ,'updating_report_name')
            ->with('coming_from'                        ,$coming_from)
           ;

        $report_definition = 
        $this->execute_query_by_report_no($report_definition_key) ;
        //var_dump($report_definition);$this->debug_exit(__FILE__,__LINE__,1);
        $encoded_business_rules     = $report_definition[0]->business_rules;
        
        $snippet_file ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.
        $report_definition_key.'_modifiable_fields_add';  
        echo($report_definition_key.$this->node_name);
        return view($this->node_name.'.create')
            ->with('encoded_business_rules' , $report_definition[0]->business_rules)
            ->with('modifiable_fields_array' , 
                $report_definition[0]->modifiable_fields_array)
            ->with('report_definition_key'  , $report_definition_key)
            ->with('snippet_file'           , $snippet_file)
            ->with('node_name'              , $this->node_name
            );
    }
    }
 
    public function initialize_query($distinct_regular,$field_name,$r_o,$v) {
    // *****************
    // this initializes the query pointing to the correct model
    // ****************
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        switch ($distinct_regular) { 
            // all queries start the same except distinct
            case "distinct":
                $query = Maillist::distinct()->select($field_name);
                echo("Maillist::distinct()->select(".$field_name.")");
                break;
            case "regular":
                $query = Maillist::where($field_name,$r_o,$v);
                echo("Maillist::where(".$field_name.",". $r_o. ",".$v.")");
                break;
       }   
       return $query;
    }


    public function kloneRecord($function,$id)    {
        switch ($function) {
             case "insert":
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                $data_record = Maillist::where('id','=',$id)->get();
                //$arr1 = (array) $data_record[0]['attributes'];
                var_dump($data_record[0]);//var_dump($arr1);
                $arr1 = (array) $data_record[0];
                unset($arr1['id']);
                unset($arr1['created_at']);
                unset($arr1['updated_at']);
                if (Maillist::create($arr1)){
                    echo('klone succeeded');
                }
                else{
                    echo('klone failed');
                    $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                }
                break;
            }
    }






 
    public function editUpdate(
        Request $request, 
        $id, 
        $what_we_are_doing, 
        $coming_from,
        $report_definition_key){
        // ************
        // this guy has to get the report definition so he can find which fields can be 
        // updated.
        // then, she has to get record she selected so we can start with their current values
        // ************
        echo("<br> generated editUpdate... ".
            '<br> what_we_are_doing: '. $what_we_are_doing.
            "<br>, id: ".$id.
            '<br>, coming_from: '.$coming_from.
            '<br>, report_definition_key: '.$report_definition_key);
        $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        if (!empty($what_we_are_doing)) {
            switch ($coming_from) {
                case "browseEdit":
                    // ******************
                    // GET SNIPPET RECORD
                    // ******************
                    $report_definition  = $this->model_get_id($this->snippet_model,$report_definition_key);
                    $working_arrays = $this->working_arrays_construct($report_definition[0]);

                    $modifiable_fields_array = $working_arrays['maintain_modifiable_fields']['modifiable_fields_array'];
                    $lookups_array['field_name'] = $this->build_column_names_array($this->model_table);
                    $fieldname_name_value_array = $this->bld_name_value_lookup_array($this->model_table);
                    $lookups_array = $this->bld_name_value_lookup_array('shows');
                    $lookups_array = array_merge($lookups_array,$fieldname_name_value_array);

                    //var_dump($working_arrays);
                    //echo($coming_from);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    break;
                default :
                    //$report_definition  = MiscThing::where('id','=',$report_definition_key)->get();
                    $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    $working_arrays     = $this->working_arrays_construct($report_definition[0]);
                    break;
                }
            switch ($what_we_are_doing) { 

                case "klone_record":
                    //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    $this->kloneRecord(insert,$id);
                    break;
                case "edit2_default_add":
                case "edit2new":
                case "edit2_default_edit":
  
                case "editUpdate_data_record":
                    // ***************
                    // GET DATA RECORD
                    // ***************
                    $MiscThing  = $this->model_get_id($this->model,$id);
                    if($MiscThing){
                        echo($coming_from."**" . $what_we_are_doing);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                        $requestFieldsArray = $MiscThing->all(); 
                        $array1 = array_intersect_key($requestFieldsArray[0]['attributes'],
                        (array) $modifiable_fields_array);
                        //var_dump($array1);
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);echo(' id: ' .$id);
                         $snippet_string = $this->recreate_snippet_file(
                            $modifiable_fields_array,
                            $lookups_array,
                            $array1,
                            $report_definition_key
                        );                   


                        $edit_snippet_file_name ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.$report_definition_key.'_snippet_string';
                        //$edit_snippet_file_name = $fnam;
                        //debug_exit(__FILE__,__LINE__,1);   
                        $passed_to_view_array                                   = array();
                        $passed_to_view_array['record']                         = $array1;

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
                         $passed_to_view_array['encoded_report_definition']      = json_encode($report_definition[0]);       
                        $passed_to_view_array['snippet_string']                 = $snippet_string;      
                        $passed_to_view_array['lookups_array']                  = $lookups_array;       
                        //echo("*".$request->input('coming_from')."*");$this->debug_exit(__FILE__,__LINE__,0);
                        //var_dump($passed_to_view_array['record']);$this->debug_exit(__FILE__,__LINE__,1);      
                // *****
                // return to view
                // *****
                        //var_dump($passed_to_view_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                        return view('maillist'.'.editUpdate',compact('miscThings'))
                        ->with('node_name'   ,$this->node_name)            
                        ->with('model'   ,$this->model)            
                        ->with('passed_to_view_array'   ,$passed_to_view_array);  
                        }          
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
                        $updatex  = Maillist
                            ::insert($modifiable_fields_name_values);
                        break;
                    case "edit2_edit_button":
                        $updatex  = Maillist
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
 

    public function model_get_id($model,$id){
        //echo ("<br/>"." model_get_id "." model: ".$model." id: ".$id);//$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        switch ($model) {
            case $this->snippet_model:
                //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $model_get_id = miscThing::where('id','=',$id)  
                ->get();
                break;
            case $this->model:
        
                //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $model_get_id = Maillist::where('id','=',$id)  
                ->get();
                break;
         }
        //var_dump($model_get_id[0]);//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //echo ("<br/>"." xit model_get_id "." model: ".$model." id: ".$id);//$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
       return $model_get_id;
    }



    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idInput
     * @return \Illuminate\Http\Response
     */
    public function update(REQUEST $request, $id)
    {
        //* *********************
        // the request has every field we need but many we dont
        // running array_intersect_key against an array of the fields we want
        // will return an array of ONLY the data we want from the request
        // **********************
        
        
        $requestFieldsArray=$request->all();
        //var_dump($requestFieldsArray);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        if (!array_key_exists('what_we_are_doing',$requestFieldsArray)) {
           $requestFieldsArray['what_we_are_doing'] = 'updating_report_name';
         }
        $what_we_are_doing = $requestFieldsArray['what_we_are_doing'] ;

        if (array_key_exists('coming_from',$requestFieldsArray)) {
           $coming_from = $requestFieldsArray['coming_from'] ;
         }
         else{
            $coming_from = 'coming_from';//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
         }
        
        $update = 0;  
        //var_dump ($requestFieldsArray) ;
        //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
        //var_dump($requestFieldsArray['encoded_modifiable_fields_array']);$this->debug_exit(__FILE__,__LINE__,10);
        switch ($what_we_are_doing) {
          
           case "editUpdate":
                $update = 1;
                // this is the guy that needs validation
                $just_the_ones_we_want = array_flip((array) json_decode($requestFieldsArray['encoded_modifiable_fields_array']));
                
                //var_dump($just_the_ones_we_want);$this->debug_exit(__FILE__,__LINE__,10);
                 break; 
             case "updating_report_definition":
                break; 
            case "updating_report_name":
               $update = 1; 
               $requestFieldsArray['just_the_names_array'] = array('report_name');
         
                $just_the_ones_we_want = $requestFieldsArray['just_the_names_array'] ;
                $just_the_ones_we_want = array_flip($just_the_ones_we_want);
                break;  

           case "maintain_modifiable_fields":
                $update = 1; 
                //var_dump($requestFieldsArray['field_name_array']);$this->debug_exit(__FILE__,__LINE__,10);
                //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
                $requestFieldsArray['modifiable_fields_array'] = 
                json_encode(array_combine($request->to,$request->to));
                //* ******************
                $objectOrArray = "array";
                $this->blade_gen_browse_select($id,$objectOrArray);
                $just_the_ones_we_want = array(
                    'modifiable_fields_array'=> 'modifiable_fields_array'
                    );
                break;  

            case "maintain_browse_fields":           
                $update = 1; 
                $requestFieldsArray['browse_select_array'] = 
                json_encode(array_combine($request->to,$request->to));
                $objectOrArray = "array";
                $this->blade_gen_browse_select($id,$objectOrArray);
                $just_the_ones_we_want = array('browse_select_array'=> 'browse_select_array');
                break;  
            case "ppv_define_query":
                $update = 1; 
                $new_r_o_array = $request->r_o_array;
                if(is_numeric($request->r_o_array[0])){
                    $new_r_o_array = array();
                    $query_relational_operators_array = $this->build_query_relational_operators_array();
                    foreach ($request->r_o_array as $index=>$value){
                        $new_r_o_array[] =
                        $query_relational_operators_array[$value];
                    }
                }
                $requestFieldsArray = array(
                    'query_field_name_array'    => json_encode($request->field_name_array),
                    'query_r_o_array'           => json_encode($new_r_o_array),
                    'query_value_array'         => json_encode($request->value_array)
                    );
                $just_the_ones_we_want = $requestFieldsArray;

                break;  
            case "ppv_define_business_rules":
                echo(__FILE__.__LINE__.'<br>');//exit();
                $update = 1; 
                //var_dump($request);//var_dump($working_arrays);
 

                $requestFieldsArray['business_rules']             = 
                $this->build_validation_array(
                    $this->build_business_rules_relational_operators(),
                    $request->field_name_array,
                    $request->r_o_array,
                    $request->value_array);
                $business_rules = $requestFieldsArray['business_rules'];
                $request->business_rules = json_encode($requestFieldsArray['business_rules']);
                $requestFieldsArray['business_rules'] = 
                    json_encode($requestFieldsArray['business_rules']);
                $requestFieldsArray['business_rules_field_name_array']    = 
                    json_encode($request->field_name_array);
                $requestFieldsArray['business_rules_r_o_array'] = 
                    json_encode($request->r_o_array);
                $requestFieldsArray['business_rules_value_array'] = 
                    json_encode($request->value_array);


                $just_the_ones_we_want = (array) json_decode($requestFieldsArray['just_the_names_array']);
                $just_the_ones_we_want = array_flip($just_the_ones_we_want);
                 //echo(' array_intersect_key($requestFieldsArray,$arr2 ' );var_dump($arr2);            $this->debug_exit(__FILE__,__LINE__,10);
                break;  
        } 
        //$requestFieldsArray=$request->all(); // create an array of all fields on the form
        //$this->debug_exit(__FILE__,__LINE__,1);echo('update id: '.$id);
        // ******
       // update
       // ******
        if ($update){  
            $requestFieldsArray = array_intersect_key($requestFieldsArray,
            $just_the_ones_we_want);
            //var_dump($request);//$this->debug_exit(__FILE__,__LINE__,10);
            //$validation_array = json_decode($encoded_business_rules);
            switch ($request->what_we_are_doing) {
             case "editUpdate":
                $rules_array =  (array) json_decode($request->encoded_business_rules);
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                $this->validate($request,$rules_array);
                // you'll redirect if validation fails
                break; 
            }
            
            //var_dump($this->key_field_name);var_dump($id);var_dump($requestFieldsArray);
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            // ******
            // this does the update
            // ******
            $this->updateGetRedirect($this->key_field_name,$id,$requestFieldsArray,$request);

            //var_dump($coming_from);var_dump($what_we_are_doing);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            switch ($what_we_are_doing) {
                case 'maintain_modifiable_fields':
                case 'maintain_browse_fields':
                case 'updating_report_name':
                    switch ($coming_from) {
                        case 'reportDefMenuEdit':
                        case 'select_fields':
                            //echo($id);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                            $miscThing = $this->execute_query_by_report_no($id) ;
                            //var_dump($coming_from);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                           return view('maillist'.'.reportDefMenuEdit',compact('miscThing'))
                            ->with('id'                    ,$id)
                            ->with('report_definition_id'  ,$this->report_definition_id)
                            ->with('model'                 ,$this->model)
                            ->with('node_name'             ,$this->node_name)

                            ->with('what_we_are_doing'     ,'updating_report_name')
                            ->with('coming_from'           ,$coming_from)
                           ;
                            break;
                        }
                case "ppv_define_query":
                case "ppv_define_business_rules":
                    switch ($what_we_are_doing) {
                        case "ppv_define_business_rules":
                        case 'ppv_define_query':
                            echo($coming_from.$id);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                            $miscThing = $this->execute_query_by_report_no($this->report_definition_id) ;
                            var_dump($coming_from);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                           return view($this->node_name.'.reportDefMenuEdit',compact('miscThing'))
                            ->with('id'                    ,$id)
                            ->with('report_definition_id'  ,$this->report_definition_id)
                            ->with('model'                 ,$this->model)
                            ->with('node_name'             ,$this->node_name)
                            ->with('what_we_are_doing'     ,'updating_report_name')
                            ->with('coming_from'           ,$coming_from)
                           ;
                            break;
                        }

                    var_dump($coming_from);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                   return redirect()->route('maillist.browseEdit', 
                        ['id' => $request['report_definition_key'],
                        'what_we_are_doing' => 'what_we_are_doing',
                        'coming_from' => 'editUpdate'
                        ]);
                    break;
 
                default:
                    var_dump($coming_from);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                 
                    return redirect()->route('maillist.browseEdit', 
                        ['id' => $request['report_definition_key'],
                        'what_we_are_doing' => 'what_we_are_doing',
                        'coming_from' => 'editUpdate'
                        ]);
                    break;
                }
 
            }
        if (!$update) {

            var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
            if ((isset($request->what_we_are_doing)&&$request->what_we_are_doing == 'updating_data_record') ){
                $business_rules = json_decode($requestFieldsArray['wxyz'],1 );
                var_dump($business_rules);$this->debug_exit(__FILE__,__LINE__,0);
                $modifiable_fields_array = json_decode($request->encoded_modifiable_fields_array,1);
                $modifiable_fields_name_values = array_intersect_key($requestFieldsArray, $modifiable_fields_array);
                unset($modifiable_fields_name_values[$this->snippet_table_key_field_name]);
                $requestFieldsArray=$request->all(); // important!!
                $this->validate($request, $business_rules);
                 // valid past here
                $update = 0; 
                    $miscThingsings=MiscThing::find($id);
                    $miscThingsings->update($modifiable_fields_name_values);
                    return redirect('admin/miscThings')
                       ->with('message'      , 'ok ');
            }
        }

                return redirect('admin/miscThings')
                ->with('message'      , 'record updated ');
    }

    public function updateGetRedirect($key_field_name,$id,$requestFieldsArray,$request){
        $AllrequestFieldsArray=$request->all(); // important!!
        //var_dump($requestFieldsArray);
        //var_dump($AllrequestFieldsArray);
        //var_dump($request->request->parameters);$this->snippet_model
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $coming_from = $AllrequestFieldsArray['coming_from'];
        switch ($coming_from) {
            case 'select_fields':
            case 'reportDefMenuEdit':
            case 'ppv_update':
                $query_result = MiscThing::where($key_field_name,  '=', $id)
                ->update($requestFieldsArray);
               break;
            default :
                $query_result = Maillist::where($key_field_name,  '=', $id)
                ->update($requestFieldsArray);
                break;
            }
        //var_dump($this->node_name);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        return redirect()->route('miscThings'.'.browseEdit', 
            ['id' => $id,
            'what_we_are_doing' => 'what_we_are_doing',
            'coming_from' => 'editUpdate'
            ]);
         //var_dump($request);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //return $Maillist;
        }
    


    public function updateGetRedirectold($key_field_name,$id,$requestFieldsArray,$request){
        $AllrequestFieldsArray=$request->all(); // important!!
        //var_dump($requestFieldsArray);
        //var_dump($AllrequestFieldsArray);
        
        //var_dump($request->request->parameters);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //$coming_from = "";
        if($AllrequestFieldsArray['coming_from'] == 'select_fields'||
        $AllrequestFieldsArray['coming_from'] == 'ppv_update'){
        $query_result = MiscThing::where($key_field_name,  '=', $id)
        ->update($requestFieldsArray);

        }
        else {
        $query_result = 'Maillist'::where($key_field_name,  '=', $id)
        ->update($requestFieldsArray);
        //$MiscThing = MiscThing::where($key_field_name,  '=', $AllrequestFieldsArray['report_definition_key'])
        //->get();
        //$Maillist1 = compact($Maillist);
        //var_dump($this->node_name);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        return redirect()->route('maillist'.'.browseEdit', 
            ['id' => $id,
            'what_we_are_doing' => 'what_we_are_doing',
            'coming_from' => 'editUpdate'
            ]);
         var_dump($request);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //return $Maillist;
        }
    }

     public function destroyx($id)
    {
         $this->debug_exit(__FILE__,__LINE__);

        $this->authorize('destroy', Maillist);

        Maillist::delete($id);

        //return redirect('/tasks');
        return;

    }
     public function destroy(REQUEST $request, $id) {
       //echo($id.$this->snippet_node_name);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $requestFieldsArray=$request->all();
        var_dump($requestFieldsArray) ;
        $what_we_are_doing = $requestFieldsArray['what_we_are_doing'];
        $coming_from = $requestFieldsArray['coming_from'];
        $coming_from_node = $requestFieldsArray['coming_from_node'];

        switch ($what_we_are_doing) {
        case 'delete_report':
            switch ($coming_from) {
            case 'indexReports':
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $update_option = "remove_broken_links";
                $view_variables_array = $this->clean_orphan_files($coming_from_node,$update_option);  //2parms
                //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            break;
            }
        break;
        }
        $file = MiscThing::where('id', $id)->first(); // File::find($id)
        if($file) {
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            $file->delete();
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            return redirect()->route($coming_from_node.'.indexReports',[
            'id' => $requestFieldsArray['report_definition_id'],
            'reportDefinitionKey'=>$requestFieldsArray['report_definition_id']
            ]);
            $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        }

    }

}
