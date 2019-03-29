<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiscThing extends Model
{

    /**
     * Generated
     */
	//protected $connection = 'homestead';
    protected $table = 'miscThings';
    /*
    protected $fillable = ['id', 'record_type', 'report_name', 'report_query', 'bypassed_field_name', 'report_containing_menu', 'edit1_array', 'db_connection_name', 'db_default', 'db_driver', 'db_host', 'db_database', 'db_username', 'db_password', 'db_charset', 'db_collation', 'db_prefix', 'db_schema', 'maintenance_query', 'lookup_name_value_array', 'lookup_name_value_array_indexed', 'lookup_name_value_array_string', 'lookup_name_value_array_gen_by_table', 'business_rules_field_name_array', 'business_rules_r_o_array', 'business_rules_value_array', 'business_rules', 'query_field_name_array', 'query_r_o_array', 'query_value_array', 'advanced_query', 'name', 'value', 'class_name', 'node_name', 'table_name', 'field_name', 'field_name_source_string', 'misc_text_area_0', 'browse_select_display_snippet', 'browse_select_array', 'browse_select_field_names_row', 'fields_name_value_array', 'modifiable_fields_array', 'required_fields_array', 'required_fields_required_array', 'required_fields_as_string_list', 'query_where_clause_array', 'edit_blade_hidden_snippet', 'modifiable_fields_list', 'modifiable_fields_update_array_include', 'modifiable_add_save_snippet', 'merge_browse_select_and_modify_arrays', 'modifiable_fields_putUpdate', 'getEdit2_include', 'function_name', 'snippet_name', 'key_value_select_exists', 'key_value_select_name', 'key_value_select_routine_name', 'key_value_select_file_name', 'controller_name', 'no_of_blank_entries', 'model', 'model_table', 'snippet_table', 'snippet_table_key_field_name', 'backup_node', 'generated_files_folder', 'key_field_name'];
	*/


	protected $fillable = [
			'id',
			'user_id',
			'record_type',
			'report_name',
			'report_query',
			'bypassed_field_name', 
			'report_containing_menu',
			'edit1_array',
			'db_connection_name', 
			'db_default',
			'db_driver',
			'db_host',
			'db_database',
			'db_username',
			'db_password',
			'db_charset',
			'db_collation',
			'db_prefix',
			'db_schema',
			'db_snippet_connection',
			'db_data_connection',
			'maintenance_query',
			'lookup_name_value_array',
			'lookup_name_value_array_indexed',
			'lookup_name_value_array_string',
			'lookup_name_value_array_gen_by_table',
			'business_rules_field_name_array',
			'business_rules_r_o_array',
			'business_rules_value_array',
			'business_rules',
			'query_field_name_array',
			'query_r_o_array',
			'query_value_array',
			'query_array',
			'advanced_query',
			'name',
			'value',
			'class_name',
			'node_name',
			'table_name',
			'table_route_exists',
         	'table_controller_exists',
         	'table_reporting_active',

			'field_name',
			'field_name_source_string',
			'misc_text_area_0',
			'browse_select_display_snippet',
			'browse_select_array',
			'browse_select_field_names_row',
			'fields_name_value_array',
			'required_fields_array',
			'required_fields_required_array',
			'required_fields_as_string_list',
			'query_where_clause_array',
			'edit_blade_hidden_snippet',
			'modifiable_fields_list',
			'modifiable_fields_array',
			'modifiable_fields_update_array_include',
			'modifiable_add_save_snippet',
			'merge_browse_select_and_modify_arrays',
			'modifiable_fields_putUpdate',
			'getEdit2_include',
			'function_name',
			'snippet_name',
			'key_value_select_exists',
			'key_value_select_name',
			'key_value_select_routine_name',
			'key_value_select_file_name',
			
			'controller_name',
			'no_of_blank_entries',
			'model',
			'model_table',
			'snippet_table',
			'snippet_table_key_field_name',
			'backup_node',
			'generated_files_folder',
			'key_field_name'
			];

 protected $connection = 'homestead';
  //protected $connection = $this->db_snippet_connection;
}

