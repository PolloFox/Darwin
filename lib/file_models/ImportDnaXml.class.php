<?php 
class ImportDnaXml implements IImportModels
{
  private $simpleArrayField = array(
    'category' => 'category',
    'level' => 'level', 
    'sex' => 'individual_sex', 
    'type' => 'individual_type',
    'stage' => 'individual_stage',
    'specimen_part' => 'part',
    'expedition_name' => 'expedition_name',
    'expedition_from_date' => 'expedition_from_date',
    'expedition_from_date_mask' => 'expedition_from_date_mask',
    'expedition_to_date' => 'expedition_to_date',
    'expedition_to_date_mask' => 'expedition_to_date_mask',
    'gtu_code' => 'gtu_code',
    'gtu_from_date' => 'gtu_from_date',
    'gtu_from_date_mask' => 'gtu_from_date_mask',
    'latitude' => 'gtu_latitude',
    'longitude' => 'gtu_longitude',     
    'lat_long_accuracy' => 'gtu_lat_long_accuracy',
    'elevation_value' => 'gtu_elevation',
    'elevation_accuracy' => 'gtu_elevation_accuracy',
    'shelf' => 'shelf',
    'container_type' => 'container_type',
    'container_storage' => 'container_storage',
    'container' => 'container',
    'sub_container_type' => 'sub_container_type',
    'sub_container_storage' => 'sub_container_storage',
    'sub_container' => 'sub_container', 
    'group_name' => 'group_name',
    'sub_group_name' => 'sub_group_name',
    'tag_value' => 'tag_value',
    'property_type' => 'property_type',
    'sub_type' => 'property_sub_type',
    'qualifier' => 'property_qualifier',
    'unit' => 'property_unit',
    'code_prefix' => 'code_prefix',
    'code_prefix_separator' => 'code_prefix_separator',
    'code_suffix' => 'code_suffix', 
    'code_suffix_separator' => 'code_suffix_separator',
    'code_date' => 'code_date', 
    'code_date_mask' => 'code_date_mask',
    'part_count_min' => 'part_count_min',
    'part_count_max' => 'part_count_max',
    
  ) ; 
  
  public function importFile($file,$id)
  {  
    $xml = new DOMDocument();
    $xml->load($file) ;     
//    if(!$xml->schemaValidate(sfConfig::get('sf_data_dir').'/import/import.xsd')) die('pas bon') ;
    $this->import_id = $id ;
    $msgs = $xml->documentElement;
    $this->createAndsaveStaging($msgs);
  }
  
  protected function createAndSaveStaging($msgs,$id=null)
  {
    if(!$msgs->childNodes->length) return ;  
    foreach ($msgs->childNodes as $msg)
    {       
      
      if($msg->nodeName != "collection_object") continue;   
      $this->complex_nodes = array();
      $object = new Staging() ;
      $object['parent_ref'] = $id ;
      $object['import_ref'] = $this->import_id ; 
      $this->fillSimpleObject($msg,$object) ;
      $object->save() ; 
      $this->parseAndAdd($object->getId()) ; 
    } 
  }   
  
  protected function parseAndAdd($id)
  {     
    $array = $this->complex_nodes ;
    foreach($array as $key => $node)
    {
      if($key == 'collection_objects') $this->createAndSaveStaging($node,$id) ;
      elseif($key == 'codes') $this->processWithCodesNode($array[$key],$id);
      elseif($key == 'identifications') $this->processWithIdentificationsNode($array[$key],$id);
      elseif($key == 'institution') $this->processWithInstitutionNode($array[$key],$id);
      elseif($key == 'comments') $this->processWithCommentsNode($array[$key],$id);
      elseif($key == 'properties') $this->processWithPropertiesNode($array[$key],$id);
      elseif($key == 'tag_groups') $this->processWithTagGroupsNode($array[$key],$id);
      else die('Unknown node '.$key) ;     
    }    
  }
  
  // this function fill the Staging Object with simple tag, all complex node are saved into an array to be proceeded afted 
  // gtu, expedition, donators and collectors are fields found in the staging table, so we don't need the staging id a we can handle then directly
  // other tags need the staging id, so I store then in an array to deal with then after the saving
  protected function fillSimpleObject($nodes,$object)   
  {
    foreach ($nodes->childNodes as $childNode) 
    {      
      // text node doesn't interest us
      if($childNode->nodeName == "#text") continue;
      // if a node have not more than one child, it's a node without childen
      if($childNode->childNodes->length == 1) $this->getSimpleField($childNode,$object);
      elseif($childNode->nodeName == 'gtu') $this->processWithGtuNode($childNode,$object); 
      elseif($childNode->nodeName == 'expedition') $this->fillSimpleObject($childNode,$object);  
      elseif($childNode->nodeName == 'donators') $this->processWithDonatorsNode($childNode,$object);      
      elseif($childNode->nodeName == 'collectors') $this->processWithCollectorsNode($childNode,$object);      
      elseif($childNode->nodeName == 'taxon') $this->processWithTaxonNode($childNode,$object);         
      else $this->complex_nodes[$childNode->nodeName] = $childNode ;
    }
  }  

  // function used to get an XML tag and return the associated field in the Staging table
  protected function getSimpleField($xml_node, $object)
  {
    if(array_key_exists($xml_node->nodeName,$this->simpleArrayField)) $object[$this->simpleArrayField[$xml_node->nodeName]] = $xml_node->nodeValue ;  
  }
  
  /**
   * This function fill all gtu fields from Staging
   * if a tag_groups tag is found, we store it and deal with it when the staging is saved and the staging id is known
   */ 
  public function processWithGtuNode($xml_node,$object)
  {
    foreach ($xml_node->childNodes as $gtu_node) 
    {        
      // text node doesn't interest us
      if($gtu_node->nodeName == "#text") continue;
      // if a node have not more than one child, it's a node without childen
      if($gtu_node->childNodes->length == 1) $this->getSimpleField($gtu_node,$object);
      else
      {
        if($gtu_node->nodeName == 'tag_groups')
        {      
          $this->complex_nodes['tag_groups'] = $gtu_node ;
        }
        elseif($gtu_node->nodeName == 'comments')
        {
          $this->complex_nodes['comments']['node'] = $gtu_node ;
          $this->complex_nodes['comments']['notion_concerned'] = 'gtu' ;
        }   
        elseif($gtu_node->nodeName == 'properties')
        {
          $this->complex_nodes['properties']['node'] = $gtu_node ;
          $this->complex_nodes['properties']['notion_concerned'] = 'gtu' ;
        }              
        elseif($gtu_node->nodeName == 'lat_long' || $gtu_node->nodeName == 'elevation') $this->fillSimpleObject($gtu_node,$object) ;
        else die('Unknown node '.$gtu_node->nodeName.' in gtu') ;
      }
    }  
  } 
  
  /**
   * This function create and tag groups found in the staging_tag_group table
   */   
  public function processWithTagGroupsNode($tag_groups,$id)
  {
    $tags = $tag_groups->getElementsByTagName("tag_group");
    foreach($tags as $tags_infos)    
    {
      $tag = new StagingTagGroups() ;
      $tag['staging_ref'] = $id ;
      $this->fillSimpleObject($tags_infos,$tag) ;
      $tag->save() ;  
    }
  }    
   
  /**
   * This function fill the collector field from Staging
   * $collectors is defined to be used as an array in the db with all collectors separated by a ','
   */      
  public function processWithCollectorsNode($xml_node,$object)
  {
    $collector_node = $xml_node->getElementsByTagName("collector");  
    $collectors = '{';
    foreach ($collector_node as $collector) 
    { 
      foreach($collector->childNodes as $collector_infos)
      { 
        if($collector_infos->nodeName == "formated_name" && $collector_infos->parentNode->nodeName == 'collector') $collectors .= $collector_infos->nodeValue.',' ;
      }
    }
    $object['collectors'] = substr($collectors,0,strlen($collectors)-1).'}' ;      
  }  
   
   
   /**
   * This function fill all taxon fields from Staging
   * $taxon_parent may containt all field referenced in $array_level separated by ","
   */    
  public function processWithTaxonNode($xml_node,$object)
  {
    $taxon_parent = '' ;
    $array_level = array("phylum","class","order","family","genus","sub_genus","species","sub_species") ;
    foreach ($xml_node->childNodes as $taxon_node) 
    {        
      // text node doesn't interest us
      if($taxon_node->nodeName == "#text") continue;
      // if a node have not more than one child, it's a node without childen
      if(in_array($taxon_node->nodeName,$array_level)) $taxon_parent .= $taxon_node->nodeName.'=>'.$taxon_node->nodeValue.',' ;   
      elseif($taxon_node->nodeName == 'name') $object['taxon_name'] = $taxon_node->nodeValue ;
      elseif($taxon_node->nodeName == 'level') $object['taxon_level_name'] = $taxon_node->nodeValue ;
      elseif($taxon_node->nodeName == 'comments')
      {
        $this->complex_nodes['comments']['node'] = $taxon_node ;
        $this->complex_nodes['comments']['notion_concerned'] = 'taxon' ;
      }  
      elseif($taxon_node->nodeName == 'properties')
      {
        $this->complex_nodes['properties']['node'] = $taxon_node ;
        $this->complex_nodes['properties']['notion_concerned'] = 'taxon' ;
      }              
      else die('Unknown node '.$taxon_node->nodeName.' in taxon') ;
    }
    $object['taxon_parents'] = substr($taxon_parent,0,strlen($taxon_parent)-1) ;
  }
     
  /**
   * This function create and save all Codes found
   */      
  public function processWithCodesNode($code_groups,$id)
  {
    $codes = $code_groups->getElementsByTagName("code");
    foreach($codes as $codes_node)    
    {
      $code = new Codes() ;
      $code['record_id'] = $id ;
      $code['referenced_relation'] = 'staging' ;
      foreach($codes_node->childNodes as $codes_info)
      { 
        if($codes_info->nodeName == "#text") continue; 
        if($codes_info->nodeName == "value") $code['code'] = $codes_info->nodeValue ;
        if($codes_info->nodeName == "category") $code['code_category'] = $codes_info->nodeValue ;        
        elseif($codes_info->nodeName == 'comments')
        {
          $this->complex_nodes['comments']['node'] = $codes_info ;
          $this->complex_nodes['comments']['notion_concerned'] = 'codes' ;
        }  
        elseif($codes_info->nodeName == 'properties')
        {
          $this->complex_nodes['properties']['node'] = $codes_info ;
          $this->complex_nodes['properties']['notion_concerned'] = 'codes' ;
        }         
        else $this->getSimpleField($codes_info,$code);
      }      
      $code->save() ;
    }  
  }   
  
  /**
   * This function create and save all Identifications found
   * $identifiers contains all referenced people is an identification, these identifier are saved in the determination_status field
   * if $comments is an array, I put the tag concerned just before notion concerned
   */   
  public function processWithIdentificationsNode($xml_node,$id)
  {
    $node = $xml_node->getElementsByTagName("identification");
    foreach($node as $identifications)    
    {
      $identifiers = "" ;
      $identification = new Identifications() ;
      $identification['record_id'] = $id ;
      $identification['referenced_relation'] = 'staging' ;
      foreach ($identifications->childNodes as $identification_info) 
      {          
        if($identification_info->nodeName == "#text") continue;      
        if($identification_info->nodeName == 'notion_concerned') $identification['notion_concerned'] = $identification_info->nodeValue;
        elseif($identification_info->nodeName == 'value') $identification['value_defined'] = $identification_info->nodeValue;
        elseif($identification_info->nodeName == 'identifiers')
        {
          $ident_tags = $identification_info->getElementsByTagName("identifier");
          foreach($ident_tags as $ident_tag) $identifiers .= $ident_tag->getElementsByTagName("formated_name")->item(0)->nodeValue.";" ;        
        }
        elseif($identification_info->nodeName == 'comments')
        {
          $this->complex_nodes['comments']['node'] = $identification_info ;
          $this->complex_nodes['comments']['notion_concerned'] = 'identifications' ;
        }  
        elseif($identification_info->nodeName == 'properties')
        {
          $this->complex_nodes['properties']['node'] = $identification_info ;
          $this->complex_nodes['properties']['notion_concerned'] = 'identifications' ;
        }        
      }
      $identification['determination_status'] = $identifiers ;
      $identification->save() ;  
    }  
  } 
  
  /**
   * This function fill the donator field from Staging
   * $donators is defined to be used as an array in the db with all donators separated by a ','
   */    
  public function processWithDonatorsNode($xml_node,$object)
  {
    $donator_node = $xml_node->getElementsByTagName("donator");  
    $donators = '{';
    foreach ($donator_node as $donator) 
    { 
      foreach($donator->childNodes as $donator_infos)
      { 
        if($donator_infos->nodeName == "formated_name" && $donator_infos->parentNode->nodeName == 'donator') $donators .= $donator_infos->nodeValue.',' ;
      }
    }
    // I remove the latest ',' and add the '}' 
    $object['donators'] = substr($donators,0,strlen($donators)-1).'}' ; 
  } 
    
    
  // function not used for now, because I don't know what to do with Institutions  
  public function processWithInstitutionNode($xml_node,$id)
  {
  
  }   

  // function not used for now, because there is no Igs for now
  public function processWithIgsNode($xml_node,$id)
  {
  
  }  

  /**
   * This function create and save all Comments found
   * $comments can be an array when the tag is found in another complex tag (such as gtu)
   * if $comments is an array, I put the tag concerned just before notion concerned
   */   
  public function processWithCommentsNode($comments,$id)
  {
    $notion = "" ;
    if(gettype($comments) == "array") 
    {
      $xml_node = $comments['node']->getElementsByTagName("comment") ;
      $notion = $comments['notion_concerned'].'/' ;
    }
    else $xml_node = $comments->getElementsByTagName("comment") ;
    foreach($xml_node as $comment_info)    
    {
      if($comment_info->nodeName == "#text") continue;
      $comment = new Comments() ;
      $comment['record_id'] = $id ;
      $comment['referenced_relation'] = 'staging' ;
      $comment['notion_concerned'] = $notion.$comment_info->getElementsByTagName("notion_concerned")->item(0)->nodeValue;
      $comment['comment'] = $comment_info->getElementsByTagName("value")->item(0)->nodeValue;
      $comment->save() ;  
    }  
  }  
  
  /**
   * This function create and save all Properties found
   * $properties can be an array when the tag is found in another complex tag (such as gtu)
   * if $properties is an array, I put the tag concerned just before notion concerned
   * $property_values contains the property_values' tag, because I have to handle then after having saved the property in order to give the id
   */   
  public function processWithPropertiesNode($properties,$id)
  {
    $notion = "" ;
    if(gettype($properties) == "array") 
    {
      $xml_node = $properties['node']->getElementsByTagName("property") ;
      $notion = $properties['notion_concerned'].'/' ;
    }
    else $xml_node = $properties->getElementsByTagName("property") ;
    foreach($xml_node as $nodes)    
    {      
      $property = new CatalogueProperties() ;
      $property['record_id'] = $id ;
      $property['referenced_relation'] = 'staging' ;
      $property_values = '' ;
      foreach($nodes->childNodes as $properties_info)
      {     
        if($properties_info->nodeName == "#text") continue;
        if($properties_info->nodeName == "property_values") $property_values = $properties_info ;
        else $this->getSimpleField($properties_info,$property);
      }
      $property->save() ;  
      if($property_values) $this->processWithPropertiesValues($property_values,$property->getId()) ;
    }    
  }    
  
  /**
   * This function create and save all Properties values found on a properties tag
   */
  public function processWithPropertiesValues($properties_values,$id)
  {
    $properties_value = $properties_values->getElementsByTagName("properties_value") ;
    foreach($properties_value as $properties_value_node)
    {      
      $property = new PropertiesValues();
      $property['property_ref'] = $id ;
      foreach($properties_value_node as $values)
      {
        if($values->nodeName == "#text") continue;      
        if($values->nodeName == 'values') $property['property_value'] = $values->nodeValue;
        if($values->nodeName == 'accuracy') $property['property_accuracy'] = $values->nodeValue;      
      }
      $property->save();
    }  
  }  
}
    