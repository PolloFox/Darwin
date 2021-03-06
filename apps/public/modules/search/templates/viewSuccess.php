<?php slot('title', __('View Specimens'));  ?>  

<div class="page viewer">
  <h1><?php echo __("Specimen Record");?></h1>
    <h2 class="title"><?php echo __("Collection") ?></h2>  
    <div class="borded right_padded">
      <table>
        <tbody>
          <tr>
            <td class="line">
                <span class="pager_nav"><?php echo __("Name") ; ?>: </span><span><?php echo $specimen->getCollectionName() ; ?></span>
                <?php echo image_tag('info.png',"title=info class=info id=collection_info");?>
              <div id="collection_tree" class="tree"></div>
                <script type="text/javascript">
                   $('#collection_info').click(function() 
                   {
                     if($('#collection_tree').is(":hidden"))
                     {
                       $.get('<?php echo url_for("search/tree?table=collections&id=".$specimen->getCollectionRef()) ;?>',function (html){
                         $('#collection_tree').html(html).slideDown();
                         });
                     }
                     $('#collection_tree').slideUp();
                   });
                </script>
              </div>
              <div class="line">
                <span class="pager_nav"><?php echo __("Institution") ; ?>: </span><span><?php echo $institute->getFamilyName() ; ?></span>
                <?php if ($institute->getAdditionalNames()) : ?>
                  (<span><?php echo $institute->getAdditionalNames() ; ?></span>)
                <?php endif ; ?>
              </div>            
            </td>
            <td>
              <div class="tree_view">
                <span class="line">
                <span class="pager_nav"><?php echo __("Collection manager") ; ?>: </span><span><?php echo $col_manager->getFormatedName() ; ?></span>
                </span>
                <?php foreach($manager as $info) : ?>
                  <?php if($img = $info->getDisplayImage(1)) : ?>
                    <span class="line">
                      <?php echo image_tag($img,"title=info class=info");?> :
                      <span class="pager_nav"><?php echo $info->getEntry() ; ?></span>
                    </span>
                 <?php endif ; ?>
                <?php endforeach ; ?>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>    
    <?php if(count($common_names)) : ?>
    <h2 class="title"><?php echo __("Common Names") ?></h2>  
    <div class="borded right_padded">    
      <table class="classification">
        <thead>
          <tr>
            <th><?php echo __("Classification") ; ?></th>
            <th><?php echo __("Community/language") ; ?></th>
            <th><?php echo __("Names") ; ?></th>
          </tr>
        </thead>
        <tbody>
          <?php include_partial('classification',array('common_name' => $common_names->getRawValue(), 'spec' => $specimen)) ; ?>
        </tbody>
      </table>
    </div>
    <?php endif ; ?>
    <?php if($specimen->getTaxonRef() || $specimen->getChronoRef() || $specimen->getLithoRef() || $specimen->getMineralRef() || $specimen->getLithologyRef()):?>
    <h2 class="title"><?php echo __("Classifications") ?></h2>  
    <div class="borded right_padded">        
      <table>
        <thead>
          <tr>
            <th>&nbsp;</th>
            <th><?php echo __("level") ; ?></th>
          </tr>
        </thead>
        <tbody>
        <?php if($specimen->getTaxonRef()) : ?>
          <tr>
            <td class="line">
              <span class="pager_nav"><?php echo __("Taxonomy") ; ?>: </span><span><?php echo $specimen->getTaxonName() ; ?></span>
              <?php echo image_tag('info.png',"title=info class=info id=taxon_info");?>
            </td>
            <td class="view_level">
              <span><?php echo $specimen->getTaxonLevelName() ; ?></span>
            </td>
          </tr>
          <tr>
            <td>
              <div id="taxon_tree" class="tree"></div>
              <script type="text/javascript">
                 $('#taxon_info').click(function() 
                 {
                   if($('#taxon_tree').is(":hidden"))
                   {
                     $.get('<?php echo url_for("search/tree?table=taxonomy&id=".$specimen->getTaxonRef()) ;?>',function (html){
                       $('#taxon_tree').html(html).slideDown();
                       });
                   }
                   $('#taxon_tree').slideUp();
                 });
              </script>
              </div>          
            </td>
            <td></td>
          </tr>
        <?php endif ; ?>
        <?php if($specimen->getChronoRef()) : ?>
          <tr>
            <td class="line">
              <span class="pager_nav"><?php echo __("Chronostratigraphy") ; ?>: </span><span><?php echo $specimen->getChronoName() ; ?></span>
              <?php echo image_tag('info.png',"title=info class=info id=chrono_info");?>
            </td>
            <td>
              <span><?php echo $specimen->getChronoLevelRef() ; ?></span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div id="chrono_tree" class="tree"></div>
              <script type="text/javascript">
                 $('#chrono_info').click(function() 
                 {
                   if($('#chrono_tree').is(":hidden"))
                   {
                     $.get('<?php echo url_for("search/tree?table=chronostratigraphy&id=".$specimen->getChronoRef()) ;?>',function (html){
                       $('#chrono_tree').html(html).slideDown();
                       });
                   }
                   $('#chrono_tree').slideUp();
                 });
              </script>
              </div>          
            </td>
          </tr>
        <?php endif ; ?>     
        <?php if($specimen->getLithoRef()) : ?>
          <tr>
            <td class="line">
              <span class="pager_nav"><?php echo __("Lithostatigraphy") ; ?>: </span><span><?php echo $specimen->getLithoName() ; ?></span>
              <?php echo image_tag('info.png',"title=info class=info id=litho_info");?>
            </td>
            <td>
              <span><?php echo $specimen->getLithoLevelRef() ; ?></span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div id="litho_tree" class="tree"></div>
              <script type="text/javascript">
                 $('#litho_info').click(function() 
                 {
                   if($('#litho_tree').is(":hidden"))
                   {
                     $.get('<?php echo url_for("search/tree?table=lithostratigraphy&id=".$specimen->getLithoRef()) ;?>',function (html){
                       $('#litho_tree').html(html).slideDown();
                       });
                   }
                   $('#litho_tree').slideUp();
                 });
              </script>
              </div>          
            </td>
          </tr>
        <?php endif ; ?>       
        <?php if($specimen->getLithologyRef()) : ?>
          <tr>
            <td class="line">
              <span class="pager_nav"><?php echo __("Lithology") ; ?>: </span><span><?php echo $specimen->getLithologyName() ; ?></span>
              <?php echo image_tag('info.png',"title=info class=info id=lithology_info");?>
            </td>
            <td>
              <span><?php echo $specimen->getLithologyLevelRef() ; ?></span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div id="lithology_tree" class="tree"></div>
              <script type="text/javascript">
                 $('#lithology_info').click(function() 
                 {
                   if($('#lithology_tree').is(":hidden"))
                   {
                     $.get('<?php echo url_for("search/tree?table=lithology&id=".$specimen->getLithologyRef()) ;?>',function (html){
                       $('#lithology_tree').html(html).slideDown();
                       });
                   }
                   $('#lithology_tree').slideUp();
                 });
              </script>
              </div>          
            </td>
          </tr>
        <?php endif ; ?>  
        <?php if($specimen->getMineralRef()) : ?>
          <tr>
            <td class="line">
              <span class="pager_nav"><?php echo __("Mineralogy") ; ?>: </span><span><?php echo $specimen->getMineralName() ; ?></span>
              <?php echo image_tag('info.png',"title=info class=info id=mineral_info");?>
            </td>
            <td>
              <span><?php echo $specimen->getMineralLevelRef() ; ?></span>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div id="mineral_tree" class="tree"></div>
              <script type="text/javascript">
                 $('#mineral_info').click(function() 
                 {
                   if($('#mineral_tree').is(":hidden"))
                   {
                     $.get('<?php echo url_for("search/tree?table=mineralogy&id=".$specimen->getMineralRef()) ;?>',function (html){
                       $('#mineral_tree').html(html).slideDown();
                       });
                   }
                   $('#mineral_tree').slideUp();
                 });
              </script>
              </div>          
            </td>
          </tr>
        <?php endif ; ?>
        </tbody>
      </table>      
    </div>
    <?php endif;?>
    <h2 class="title"><?php echo __("Specimen Characteristics") ?></h2>  
    <div class="borded right_padded">        
      <table class="caract_table">
        <tr>
          <td><span class="pager_nav"><?php echo __("Number of individual") ; ?> :</span></td>
          <td><span>
            <?php if($specimen->getIndividualCountMin() == $specimen->getIndividualCountMax()) 
                echo ($specimen->getIndividualCountMin()==""?"-":$specimen->getIndividualCountMin()) ;
              else
                echo __("Between ".$specimen->getIndividualCountMin()." and ".$specimen->getIndividualCountMax()) ;            
             ?></span>
          </td>
        </tr>
        <tr>
          <td><span class="pager_nav"><?php echo __("Type") ; ?> :</span></td>
          <td>
            <span><?php echo ($specimen->getIndividualTypeSearch()=="undefined"?"-":$specimen->getIndividualTypeSearch()) ; ?></span>
          </td>
        </tr>
        <tr>
          <td><span class="pager_nav"><?php echo __("Sex") ; ?> :</span></td>
          <td>
            <span><?php echo ($specimen->getIndividualSex()=="undefined"?"-":$specimen->getIndividualSex()) ; ?></span>
          </td>
        </tr>
        <tr>
          <td><span class="pager_nav"><?php echo __("Stage") ; ?> :</span></td>
          <td>
            <span><?php echo ($specimen->getIndividualStage()=="undefined"?"-":$specimen->getIndividualStage()) ; ?></span>
          </td>
        </tr>
        <tr>
          <td><span class="pager_nav"><?php echo __("Country") ; ?> :</span></td>
          <td>
            <?php if($tags) : ?> 
            <ul class="name_tags_view">
              <?php foreach($tags as $key=>$tag):?>
                <?php if($tag == "") echo "-" ; ?>
                <li class="tag_size_2"><?php echo $tag ;?></li>
              <?php endforeach;?>
            </ul>
            <?php else : ?>
              <span>-</span>
            <?php endif ; ?>
          </td>
        </tr>
      </table>
    </div>
  <div class="check_right"> 
    <input type="button" id="close_butt" value="<?php echo __('Close this record'); ?>">
  </div>  
  <script>
    $('#close_butt').click(function(){
      window.close() ;
    });
  </script> 
</div>
