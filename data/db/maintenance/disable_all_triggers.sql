 ALTER TABLE darwin2.catalogue_people DISABLE TRIGGER trg_chk_arerole;
 ALTER TABLE darwin2.catalogue_people DISABLE TRIGGER trg_clr_referencerecord_cataloguepeople;
 ALTER TABLE darwin2.catalogue_properties DISABLE TRIGGER trg_clr_referencerecord_catalogueproperties;
 ALTER TABLE darwin2.catalogue_properties DISABLE TRIGGER trg_cpy_fulltoindex_catalogueproperties;
 ALTER TABLE darwin2.catalogue_properties DISABLE TRIGGER trg_cpy_unified_values;
 ALTER TABLE darwin2.catalogue_properties DISABLE TRIGGER trg_trk_log_table_catalogue_properties;
 ALTER TABLE darwin2.catalogue_relationships DISABLE TRIGGER trg_clr_referencerecord_cataloguerelationships;
 ALTER TABLE darwin2.catalogue_relationships DISABLE TRIGGER trg_nbr_in_relation;
 ALTER TABLE darwin2.catalogue_relationships DISABLE TRIGGER trg_trk_log_table_catalogue_relationships;
 ALTER TABLE darwin2.chronostratigraphy DISABLE TRIGGER trg_chk_upper_level_for_childrens_chronostratigraphy;
 ALTER TABLE darwin2.chronostratigraphy DISABLE TRIGGER trg_clr_referencerecord_chronostratigraphy;
 ALTER TABLE darwin2.chronostratigraphy DISABLE TRIGGER trg_cpy_fulltoindex_chronostratigraphy;
 ALTER TABLE darwin2.chronostratigraphy DISABLE TRIGGER trg_cpy_path_chronostratigraphy;
 ALTER TABLE darwin2.chronostratigraphy DISABLE TRIGGER trg_trk_log_table_chronostratigraphy;
 ALTER TABLE darwin2.chronostratigraphy DISABLE TRIGGER trg_update_chronostratigraphy_darwin_flat;
 ALTER TABLE darwin2.chronostratigraphy DISABLE TRIGGER trg_words_ts_cpy_chronostratigraphy;
 ALTER TABLE darwin2.classification_keywords DISABLE TRIGGER trg_cpy_fulltoindex_classification_keywords;
 ALTER TABLE darwin2.classification_keywords DISABLE TRIGGER trg_trk_log_table_classification_keywords;
 ALTER TABLE darwin2.classification_synonymies DISABLE TRIGGER trg_nbr_in_synonym;
 ALTER TABLE darwin2.classification_synonymies DISABLE TRIGGER trg_trk_log_table_classification_synonymies;
 ALTER TABLE darwin2.class_vernacular_names DISABLE TRIGGER trg_cpy_fulltoindex_classvernacularnames;
 ALTER TABLE darwin2.class_vernacular_names DISABLE TRIGGER trg_trk_log_table_class_vernacular_names;
 ALTER TABLE darwin2.codes DISABLE TRIGGER trg_cpy_fulltoindex_codes;
 ALTER TABLE darwin2.codes DISABLE TRIGGER trg_trk_log_table_codes;
 ALTER TABLE darwin2.codes DISABLE TRIGGER trg_words_ts_cpy_codes;
 ALTER TABLE darwin2.collecting_methods DISABLE TRIGGER trg_cpy_fulltoindex_collecting_methods;
 ALTER TABLE darwin2.collecting_methods DISABLE TRIGGER trg_trk_log_table_collecting_methods;
 ALTER TABLE darwin2.collecting_tools DISABLE TRIGGER trg_cpy_fulltoindex_collecting_tools;
 ALTER TABLE darwin2.collecting_tools DISABLE TRIGGER trg_trk_log_table_collecting_tools;
 ALTER TABLE darwin2.collection_maintenance DISABLE TRIGGER trg_clr_referencerecord_mysavedsearches;
 ALTER TABLE darwin2.collection_maintenance DISABLE TRIGGER trg_cpy_tofulltext_collectionmaintenance;
 ALTER TABLE darwin2.collection_maintenance DISABLE TRIGGER trg_trk_log_table_collection_maintenance;
 ALTER TABLE darwin2.collection_maintenance DISABLE TRIGGER trg_words_ts_cpy_collection_maintenance;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_chk_parentcollinstitution;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_clr_referencerecord_collections;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_cpy_fulltoindex_collection;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_cpy_path_collections;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_cpy_updatecollectionrights;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_cpy_updatecollinstitutioncascade;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_cpy_updateuserrightscollections;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_trk_log_table_collections;
 ALTER TABLE darwin2.collections DISABLE TRIGGER trg_update_collections_darwin_flat;
 ALTER TABLE darwin2.collections_rights DISABLE TRIGGER trg_chk_canupdatecollectionsrights;
 ALTER TABLE darwin2.collections_rights DISABLE TRIGGER trg_cpy_updatemywidgetscollrights;
 ALTER TABLE darwin2.collections_rights DISABLE TRIGGER trg_cpy_updateuserrights;
 ALTER TABLE darwin2.collections_rights DISABLE TRIGGER trg_trk_log_table_collections_rights;
 ALTER TABLE darwin2.comments DISABLE TRIGGER trg_cpy_tofulltext_comments;
 ALTER TABLE darwin2.comments DISABLE TRIGGER trg_trk_log_table_comments;
 ALTER TABLE darwin2.comments DISABLE TRIGGER trg_words_ts_cpy_comments;
 ALTER TABLE darwin2.expeditions DISABLE TRIGGER trg_clr_referencerecord_expeditions;
 ALTER TABLE darwin2.expeditions DISABLE TRIGGER trg_cpy_fulltoindex_expeditions;
 ALTER TABLE darwin2.expeditions DISABLE TRIGGER trg_cpy_tofulltext_expeditions;
 ALTER TABLE darwin2.expeditions DISABLE TRIGGER trg_trk_log_table_expeditions;
 ALTER TABLE darwin2.expeditions DISABLE TRIGGER trg_update_expeditions_darwin_flat;
 ALTER TABLE darwin2.expeditions DISABLE TRIGGER trg_words_ts_cpy_expeditions;
 ALTER TABLE darwin2.ext_links DISABLE TRIGGER trg_cpy_tofulltext_ext_links;
 ALTER TABLE darwin2.ext_links DISABLE TRIGGER trg_trk_log_table_ext_links;
 ALTER TABLE darwin2.ext_links DISABLE TRIGGER trg_words_ts_cpy_ext_links;
 ALTER TABLE darwin2.gtu DISABLE TRIGGER trg_clr_referencerecord_gtu;
 ALTER TABLE darwin2.gtu DISABLE TRIGGER trg_cpy_idtocode_gtu;
 ALTER TABLE darwin2.gtu DISABLE TRIGGER trg_cpy_location;
 ALTER TABLE darwin2.gtu DISABLE TRIGGER trg_cpy_path_gtu;
 ALTER TABLE darwin2.gtu DISABLE TRIGGER trg_trk_log_table_gtu;
 ALTER TABLE darwin2.gtu DISABLE TRIGGER trg_update_gtu_darwin_flat;
 ALTER TABLE darwin2.habitats DISABLE TRIGGER trg_clr_referencerecord_habitats;
 ALTER TABLE darwin2.habitats DISABLE TRIGGER trg_cpy_fulltoindex_expeditions;
 ALTER TABLE darwin2.habitats DISABLE TRIGGER trg_cpy_path_habitats;
 ALTER TABLE darwin2.habitats DISABLE TRIGGER trg_cpy_tofulltext_habitats;
 ALTER TABLE darwin2.habitats DISABLE TRIGGER trg_trk_log_table_habitats;
 ALTER TABLE darwin2.habitats DISABLE TRIGGER trg_words_ts_cpy_habitats;
 ALTER TABLE darwin2.identifications DISABLE TRIGGER trg_clr_referencerecord_identifications;
 ALTER TABLE darwin2.identifications DISABLE TRIGGER trg_cpy_fulltoindex_identifications;
 ALTER TABLE darwin2.identifications DISABLE TRIGGER trg_cpy_tofulltext_identifications;
 ALTER TABLE darwin2.identifications DISABLE TRIGGER trg_trk_log_table_identifications;
 ALTER TABLE darwin2.identifications DISABLE TRIGGER trg_words_ts_cpy_identification;
 ALTER TABLE darwin2.igs DISABLE TRIGGER trg_cpy_fulltoindex_igs;
 ALTER TABLE darwin2.igs DISABLE TRIGGER trg_trk_log_table_igs;
 ALTER TABLE darwin2.igs DISABLE TRIGGER trg_update_igs_darwin_flat;
 ALTER TABLE darwin2.insurances DISABLE TRIGGER trg_clr_referencerecord_insurances;
 ALTER TABLE darwin2.insurances DISABLE TRIGGER trg_trk_log_table_insurances;
 ALTER TABLE darwin2.lithology DISABLE TRIGGER trg_chk_upper_level_for_childrens_lithology;
 ALTER TABLE darwin2.lithology DISABLE TRIGGER trg_clr_referencerecord_lithology;
 ALTER TABLE darwin2.lithology DISABLE TRIGGER trg_cpy_fulltoindex_lithology;
 ALTER TABLE darwin2.lithology DISABLE TRIGGER trg_cpy_path_lithology;
 ALTER TABLE darwin2.lithology DISABLE TRIGGER trg_trk_log_table_lithology;
 ALTER TABLE darwin2.lithology DISABLE TRIGGER trg_update_lithology_darwin_flat;
 ALTER TABLE darwin2.lithology DISABLE TRIGGER trg_words_ts_cpy_lithology;
 ALTER TABLE darwin2.lithostratigraphy DISABLE TRIGGER trg_chk_upper_level_for_childrens_lithostratigraphy;
 ALTER TABLE darwin2.lithostratigraphy DISABLE TRIGGER trg_clr_referencerecord_lithostratigraphy;
 ALTER TABLE darwin2.lithostratigraphy DISABLE TRIGGER trg_cpy_fulltoindex_lithostratigraphy;
 ALTER TABLE darwin2.lithostratigraphy DISABLE TRIGGER trg_cpy_path_lithostratigraphy;
 ALTER TABLE darwin2.lithostratigraphy DISABLE TRIGGER trg_trk_log_table_lithostratigraphy;
 ALTER TABLE darwin2.lithostratigraphy DISABLE TRIGGER trg_update_lithostratigraphy_darwin_flat;
 ALTER TABLE darwin2.lithostratigraphy DISABLE TRIGGER trg_words_ts_cpy_lithostratigraphy;
 ALTER TABLE darwin2.mineralogy DISABLE TRIGGER trg_chk_upper_level_for_childrens_mineralogy;
 ALTER TABLE darwin2.mineralogy DISABLE TRIGGER trg_clr_referencerecord_mineralogy;
 ALTER TABLE darwin2.mineralogy DISABLE TRIGGER trg_cpy_fulltoindex_mineralogy;
 ALTER TABLE darwin2.mineralogy DISABLE TRIGGER trg_cpy_path_mineralogy;
 ALTER TABLE darwin2.mineralogy DISABLE TRIGGER trg_trk_log_table_mineralogy;
 ALTER TABLE darwin2.mineralogy DISABLE TRIGGER trg_update_mineralogy_darwin_flat;
 ALTER TABLE darwin2.mineralogy DISABLE TRIGGER trg_words_ts_cpy_mineralogy;
 ALTER TABLE darwin2.multimedia DISABLE TRIGGER trg_clr_referencerecord_multimedia;
 ALTER TABLE darwin2.multimedia DISABLE TRIGGER trg_cpy_fulltoindex_multimedia;
 ALTER TABLE darwin2.multimedia DISABLE TRIGGER trg_cpy_path_multimedia;
 ALTER TABLE darwin2.multimedia DISABLE TRIGGER trg_cpy_tofulltext_multimedia;
 ALTER TABLE darwin2.multimedia DISABLE TRIGGER trg_trk_log_table_multimedia;
 ALTER TABLE darwin2.multimedia DISABLE TRIGGER trg_words_ts_cpy_multimedia;
 ALTER TABLE darwin2.multimedia_keywords DISABLE TRIGGER trg_cpy_fulltoindex_multimediakeywords;
 ALTER TABLE darwin2.people_addresses DISABLE TRIGGER trg_cpy_tofulltext_peopleaddresses;
 ALTER TABLE darwin2.people_addresses DISABLE TRIGGER trg_trk_log_table_people_addresses;
 ALTER TABLE darwin2.people_addresses DISABLE TRIGGER trg_words_ts_cpy_people_addresses;
 ALTER TABLE darwin2.people_comm DISABLE TRIGGER trg_trk_log_table_people_comm;
 ALTER TABLE darwin2.people DISABLE TRIGGER trg_chk_peopletype;
 ALTER TABLE darwin2.people DISABLE TRIGGER trg_clr_referencerecord_people;
 ALTER TABLE darwin2.people DISABLE TRIGGER trg_cpy_formattedname;
 ALTER TABLE darwin2.people DISABLE TRIGGER trg_trk_log_table_people;
 ALTER TABLE darwin2.people DISABLE TRIGGER trg_words_ts_cpy_people;
 ALTER TABLE darwin2.people_multimedia DISABLE TRIGGER trg_trk_log_table_people_multimedia;
 ALTER TABLE darwin2.people_relationships DISABLE TRIGGER trg_cpy_path_peoplerelationships;
 ALTER TABLE darwin2.people_relationships DISABLE TRIGGER trg_trk_log_table_people_relationships;
 ALTER TABLE darwin2.properties_values DISABLE TRIGGER trg_cpy_unified_values;
 ALTER TABLE darwin2.properties_values DISABLE TRIGGER trg_trk_log_table_properties_values;
 ALTER TABLE darwin2.soortenregister DISABLE TRIGGER trg_clr_referencerecord_soortenregister;
 ALTER TABLE darwin2.soortenregister DISABLE TRIGGER trg_trk_log_table_soortenregister;
 ALTER TABLE darwin2.specimen_collecting_methods DISABLE TRIGGER trg_trk_log_table_specimen_collecting_methods;
 ALTER TABLE darwin2.specimen_collecting_tools DISABLE TRIGGER trg_trk_log_table_specimen_collecting_tools;
 ALTER TABLE darwin2.specimen_individuals DISABLE TRIGGER trg_chk_specimenindcollectionallowed;
 ALTER TABLE darwin2.specimen_individuals DISABLE TRIGGER trg_clr_referencerecord_specimenindividuals;
 ALTER TABLE darwin2.specimen_individuals DISABLE TRIGGER trg_clr_specialstatus_specimenindividuals;
 ALTER TABLE darwin2.specimen_individuals DISABLE TRIGGER trg_delete_specimen_individuals_darwin_flat;
 ALTER TABLE darwin2.specimen_individuals DISABLE TRIGGER trg_trk_log_table_specimen_individuals;
 ALTER TABLE darwin2.specimen_individuals DISABLE TRIGGER trg_update_specimen_individuals_darwin_flat;
 ALTER TABLE darwin2.specimen_parts DISABLE TRIGGER trg_chk_specimenpartcollectionallowed;
 ALTER TABLE darwin2.specimen_parts DISABLE TRIGGER trg_clr_referencerecord_specimenparts;
 ALTER TABLE darwin2.specimen_parts DISABLE TRIGGER trg_cpy_path_specimen_parts;
 ALTER TABLE darwin2.specimen_parts DISABLE TRIGGER trg_cpy_specimensmaincode_specimenpartcode;
 ALTER TABLE darwin2.specimen_parts DISABLE TRIGGER trg_delete_specimen_parts_darwin_flat;
 ALTER TABLE darwin2.specimen_parts DISABLE TRIGGER trg_trk_log_table_specimen_parts;
 ALTER TABLE darwin2.specimen_parts DISABLE TRIGGER trg_update_specimen_parts_darwin_flat;
 ALTER TABLE darwin2.specimens_accompanying DISABLE TRIGGER trg_clr_referencerecord_specimensaccompanying;
 ALTER TABLE darwin2.specimens_accompanying DISABLE TRIGGER trg_trk_log_table_specimens_accompanying;
 ALTER TABLE darwin2.specimens DISABLE TRIGGER trg_chk_specimencollectionallowed;
 ALTER TABLE darwin2.specimens DISABLE TRIGGER trg_clr_referencerecord_specimens;
 ALTER TABLE darwin2.specimens DISABLE TRIGGER trg_cpy_updatehosts;
 ALTER TABLE darwin2.specimens DISABLE TRIGGER trg_cpy_updatespechostimpact;
 ALTER TABLE darwin2.specimens DISABLE TRIGGER trg_trk_log_table_specimens;
 ALTER TABLE darwin2.specimens DISABLE TRIGGER trg_update_specimens_darwin_flat;
 ALTER TABLE darwin2.tag_groups DISABLE TRIGGER trg_cpy_fulltoindex_taggroups;
 ALTER TABLE darwin2.tag_groups DISABLE TRIGGER trg_cpy_gtutags_taggroups;
 ALTER TABLE darwin2.tag_groups DISABLE TRIGGER trg_trk_log_table_tag_groups;
 ALTER TABLE darwin2.tag_groups DISABLE TRIGGER trg_update_tag_groups_darwin_flat;
 ALTER TABLE darwin2.taxonomy DISABLE TRIGGER trg_chk_upper_level_for_childrens_taxonomy;
 ALTER TABLE darwin2.taxonomy DISABLE TRIGGER trg_clr_referencerecord_taxa;
 ALTER TABLE darwin2.taxonomy DISABLE TRIGGER trg_cpy_fulltoindex_taxa;
 ALTER TABLE darwin2.taxonomy DISABLE TRIGGER trg_cpy_path_taxonomy;
 ALTER TABLE darwin2.taxonomy DISABLE TRIGGER trg_trk_log_table_taxonomy;
 ALTER TABLE darwin2.taxonomy DISABLE TRIGGER trg_update_taxonomy_darwin_flat;
 ALTER TABLE darwin2.taxonomy DISABLE TRIGGER trg_words_ts_cpy_taxonomy;
 ALTER TABLE darwin2.users_addresses DISABLE TRIGGER trg_cpy_tofulltext_usersaddresses;
 ALTER TABLE darwin2.users DISABLE TRIGGER trg_clr_referencerecord_users;
 ALTER TABLE darwin2.users DISABLE TRIGGER trg_cpy_formattedname;
 ALTER TABLE darwin2.users DISABLE TRIGGER trg_unpromotion_remove_cols;
 ALTER TABLE darwin2.users DISABLE TRIGGER trg_words_ts_cpy_users;
 ALTER TABLE darwin2.vernacular_names DISABLE TRIGGER trg_clr_referencerecord_vernacularnames;
 ALTER TABLE darwin2.vernacular_names DISABLE TRIGGER trg_cpy_fulltoindex_vernacularnames;
 ALTER TABLE darwin2.vernacular_names DISABLE TRIGGER trg_cpy_tofulltext_vernacularnames;
 ALTER TABLE darwin2.vernacular_names DISABLE TRIGGER trg_trk_log_table_vernacular_names;
 ALTER TABLE darwin2.vernacular_names DISABLE TRIGGER trg_words_ts_cpy_vernacular_names;

