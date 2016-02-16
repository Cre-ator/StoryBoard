<?php

class storyboard_print_api
{
   /**
    * Get suffix of mantis version
    *
    * @return string
    */
   public function getMantisVersion()
   {
      return substr( MANTIS_VERSION, 0, 4 );
   }

   /**
    * Prints head elements of a page
    * @param $string
    */
   public function print_page_head( $string )
   {
      echo '<link rel="stylesheet" href="' . STORYBOARD_FILES_URI . 'storyboard.css">';
      html_page_top1( $string );
      html_page_top2();
      if ( plugin_is_installed( 'WhiteboardMenu' ) )
      {
         require_once WHITEBOARDMENU_CORE_URI . 'whiteboard_print_api.php';
         $whiteboard_print_api = new whiteboard_print_api();
         $whiteboard_print_api->printWhiteboardMenu();
      }
      $this->print_plugin_menu();
   }

   /**
    * Prints the plugin specific menu
    */
   public function print_plugin_menu()
   {
      echo '<table align="center">';
      echo '<tr><td colspan="4" class="center" ><font color="#8b0000" size="5">*** Plugin befindet sich in Entwicklungsphase ***</font></td></tr>';
      echo '</table>';
   }

   /**
    * Starts a new row in a table
    */
   public function printRow()
   {
      if ( $this->getMantisVersion() == '1.2.' )
      {
         echo '<tr ' . helper_alternate_class() . '>';
      }
      else
      {
         echo '<tr>';
      }
   }

   /**
    * Prints the specific plugin fields in the bug-view user interface
    * @param $card_name
    * @param $card_type
    * @param $card_priority
    * @param $card_risk
    * @param $card_story_pt
    * @param $card_story_pt_post
    * @param $card_text
    * @param $card_acc_crit
    */
   public function printBugViewFields( $card_name, $card_type, $card_priority, $card_risk, $card_story_pt, $card_story_pt_post, $card_text, $card_acc_crit )
   {
      $this->printRow();
      echo '<td class="form-title" colspan="6">' . plugin_lang_get( 'menu_title' ) . '</td>';
      echo '</tr>';

      $this->printRow();
      echo '<td class="category" colspan="1">' . plugin_lang_get( 'card_name' ) . '</td>';
      echo '<td colspan="5" id="card_name">' . $card_name . '</td>';
      echo '</tr>';

      $this->printRow();
      echo '<td class="category" colspan="1">' . plugin_lang_get( 'card_type' ) . '</td>';
      echo '<td colspan="5" id="card_type">' . $card_type . '</td>';
      echo '</tr>';

      $this->printRow();
      echo '<td class="category" colspan="1">' . plugin_lang_get( 'card_priority' ) . '</td>';
      echo '<td colspan="1" id="card_priority">' . $card_priority . '</td>';
      echo '<td class="category" colspan="1">' . plugin_lang_get( 'card_risk' ) . '</td>';
      echo '<td colspan="1" id="card_risk">' . $card_risk . '</td>';
      echo '<td class="category" colspan="1">' . plugin_lang_get( 'card_story_pt' ) . '</td>';
      echo '<td colspan="1" id="card_story_pt">' . $card_story_pt . '</td>';
      echo '</tr>';

      $this->printRow();
      echo '<td class="category">' . plugin_lang_get( 'card_story_pt_post' ) . '</td>';
      echo '<td colspan="1" id="card_story_pt_post">' . $card_story_pt_post . '</td>';
      echo '<td class="category">' . plugin_lang_get( 'card_text' ) . '</td>';
      echo '<td colspan="1" id="card_text">' . $card_text . '</td>';
      echo '<td class="category">' . plugin_lang_get( 'card_acc_crit' ) . '</td>';
      echo '<td colspan="1" id="card_acc_crit">' . $card_acc_crit . '</td>';
      echo '</tr>';
   }

   /**
    * Prints the specific plugin fields in the bug-report user interface
    */
   public function printBugReportFields()
   {
      if ( $this->getMantisVersion() == '1.2.' )
      {
         $this->printRow();
         echo '<td class="form-title" colspan="2">' . plugin_lang_get( 'menu_title' ) . '</td>';
         echo '</tr>';
      }
      else
      {
         echo '<legend><span>' . plugin_lang_get( 'menu_title' ) . '</span></legend>';
      }
      $this->printBugReportTextInput( 'card_name' );
      $this->printBugReportSelectInput( 'card_type' );
      $this->printBugReportTextInput( 'card_priority' );
      $this->printBugReportTextInput( 'card_risk' );
      $this->printBugReportTextInput( 'card_story_pt' );
      $this->printBugReportTextInput( 'card_story_pt_post' );
      $this->printBugReportTextInput( 'card_text' );
      $this->printBugReportTextInput( 'card_acc_crit' );
      if ( $this->getMantisVersion() == '1.2.' )
      {
         $this->printRow();
         echo '<td class="form-title" colspan="2"></td>';
         echo '</tr>';
      }
      else
      {
         echo '<legend><span></span></legend>';
      }
   }

   /**
    * Prints the specific plugin fields in the bug-update user interface
    *
    * @param $card_name
    * @param $card_type
    * @param $card_priority
    * @param $card_risk
    * @param $card_story_pt
    * @param $card_story_pt_post
    * @param $card_text
    * @param $card_acc_crit
    */
   public function printBugUpdateFields( $card_name, $card_type, $card_priority, $card_risk, $card_story_pt, $card_story_pt_post, $card_text, $card_acc_crit )
   {

      $this->printRow();
      echo '<td class="form-title" colspan="6">' . plugin_lang_get( 'menu_title' ) . '</td>';
      echo '</tr>';

      $this->printBugUpdateTextInput( 'card_name', $card_name );
      $this->printBugUpdateSelectInput( 'card_type', $card_type );
      $this->printBugUpdateTextInput( 'card_priority', $card_priority );
      $this->printBugUpdateTextInput( 'card_risk', $card_risk );
      $this->printBugUpdateTextInput( 'card_story_pt', $card_story_pt );
      $this->printBugUpdateTextInput( 'card_story_pt_post', $card_story_pt_post );
      $this->printBugUpdateTextInput( 'card_text', $card_text );
      $this->printBugUpdateTextInput( 'card_acc_crit', $card_acc_crit );
   }

   /**
    * @param $input
    */
   public function printBugReportTextInput( $input )
   {
      if ( $this->getMantisVersion() == '1.2.' )
      {
         $this->printRow();
         echo '<td class="category">';
         echo '<label><span>' . plugin_lang_get( $input ) . '</span></label>';
         echo '</td>';
         echo '<td>';
         echo '<span class="input">';
         echo '<input ' . helper_get_tab_index() . ' type="text" id="' . $input . '" name="' . $input . '" size="50" maxlength="50" value="" />';
         echo '</span>';
         echo '<span class="label-style"></span>';
         echo '</td>';
         echo '</tr>';
      }
      else
      {
         echo '<div class="field-container">';
         echo '<label><span>' . plugin_lang_get( $input ) . '</span></label>';
         echo '<span class="input">';
         echo '<input ' . helper_get_tab_index() . ' type="text" id="' . $input . '" name="' . $input . '" size="50" maxlength="50" value="" />';
         echo '</span>';
         echo '<span class="label-style"></span>';
         echo '</div>';
      }
   }

   /**
    * @param $input
    */
   public function printBugReportSelectInput( $input )
   {
      $db_api = new db_api();

      $types = array();
      $type_rows = $db_api->selectAllTypes();
      foreach ( $type_rows as $type_row )
      {
         $types[] = $type_row[1];
      }

      if ( $this->getMantisVersion() == '1.2.' )
      {
         $this->printRow();
         echo '<td class="category">';
         echo '<label><span>' . plugin_lang_get( $input ) . '</span></label>';
         echo '</td>';
         echo '<td>';
         echo '<span class="select">';
         echo '<select ' . helper_get_tab_index() . ' id="' . $input . '" name="' . $input . '">';
         if ( !is_null( $types ) )
         {
            foreach ( $types as $type )
            {
               echo '<option value="' . $type . '">' . $type . '</option>';
            }
         }
         echo '</select>&nbsp';
         echo '</td>';
         echo '</tr>';
      }
      else
      {
         echo '<div class="field-container">';
         echo '<label><span>' . plugin_lang_get( $input ) . '</span></label>';
         echo '<span class="select">';
         echo '<select ' . helper_get_tab_index() . ' id="' . $input . '" name="' . $input . '">';
         if ( !is_null( $types ) )
         {
            foreach ( $types as $type )
            {
               echo '<option value="' . $type . '">' . $type . '</option>';
            }
         }
         echo '</select>&nbsp';
         echo '</span>';
         echo '<span class="label-style"></span>';
         echo '</div>';
      }
   }

   /**
    * @param $input
    * @param $value
    */
   public function printBugUpdateTextInput( $input, $value )
   {
      $this->printRow();
      echo '<td class="category"><label for="' . $input . '">' . plugin_lang_get( $input ) . '</label></td>';
      echo '<td colspan="5">';
      echo '<input ' . helper_get_tab_index() . ' type="text" id="' . $input . '" name="' . $input . '" size="50" maxlength="50" value="' . $value . '" />';
      echo '</td>';
      echo '</tr>';
   }

   /**
    * @param $input
    * @param $value
    */
   public function printBugUpdateSelectInput( $input, $value )
   {
      $db_api = new db_api();
      $types = array();
      $type_rows = $db_api->selectAllTypes();
      foreach ( $type_rows as $type_row )
      {
         $types[] = $type_row[1];
      }

      $this->printRow();
      echo '<td class="category"><label for="' . $input . '">' . plugin_lang_get( $input ) . '</label></td>';
      echo '<td colspan="5">';
      echo '<span class="select">';
      echo '<select ' . helper_get_tab_index() . ' id="' . $input . '" name="' . $input . '">';
      if ( !is_null( $types ) )
      {
         foreach ( $types as $type )
         {
            echo '<option value="' . $type . '"';
            if ( $type == $value )
            {
               echo ' selected';
            }
            echo '>' . $type . '</option>';
         }
      }
      echo '</select>&nbsp';
      echo '</td>';
      echo '</tr>';
   }
}