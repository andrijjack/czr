<?
/*
Plugin Name:  13 запитань
Plugin URI: http://ged.org.ua/13-zapytan/
Description: Виводить запитання, які повинен задати собі кожен блоґер перед публікацією.
Author: G3D
Version: 0.1.2
Author URI: http://ged.org.ua/
*/

/* Use the admin_menu action to define the custom boxes */
add_action('admin_menu', 'question_add_custom_box');

/* Adds a custom section to the "advanced" Post and Page edit screens */
function question_add_custom_box() {

  if( function_exists( 'add_meta_box' )) {
    add_meta_box( 'question_sectionid', __( 'А ти задав собі ці 13 запитань?', 'question_textdomain' ), 
                'question_inner_custom_box', 'post', 'advanced' );
    add_meta_box( 'question_sectionid', __( 'А ти задав собі ці 13 запитань?', 'question_textdomain' ), 
                'question_inner_custom_box', 'page', 'advanced' );
   } else {
    add_action('dbx_post_advanced', 'question_old_custom_box' );
    add_action('dbx_page_advanced', 'question_old_custom_box' );
  }
}

function question_inner_custom_box() {
  echo '<ul id="13questions" style="padding-left:15px;">
            <li>Яка основна ідея допису? Чи вдалося мені чітко її окреслити?</li>
            <li>Яких дій я очікую від читачів після прочитання допису? Чи спонукає запис до цих дій?</li>
            <li>Чи вдалося мені написати щось корисне?</li>
            <li>Чи вдалося мені написати щось унікальне?</li>
            <li>Написане наблизило чи віддалило мене від цілей блоґа?</li>
            <li>Наскільки вдалий заголовок я обрав і чи зможе він привабити читачів?</li>
            <li>Чи вдалося уникнути граматичних та орфографічних помилок у тексті?</li>
            <li>Чи міг би я сказати те саме більш лаконічно?</li>
            <li>Чи достатньо авторитетні цитати та джерела я обрав?</li>
            <li>Чи існують в моєму або інших блоґах статті, в яких би піднімалася подібна проблема? Чи не забув я поставити посилання на них?</li>
            <li>Чи залишив я можливість для читачів додати щось до запису? Чи запропонував їм долучитися до дискусії?</li>
            <li>За якими словами люди повинні знаходити мій допис? Чи оптимізував я пост відповідно до цих пошукових слів?</li>
            <li>Чи можу я розширити цей пост наступними публікаціями у блозі? </li> 
        </ul>
        <span>Спасибі за список <a href="http://blogosphere.com.ua/2008/05/08/13-zapytan-jaki-slid-zadaty-sobi-pered-publikacijeju-v-blozi/">Українській блогосфері</a></span>';

}

/* Prints the edit form for pre-WordPress 2.5 post/page */
function question_old_custom_box() {

  echo '<div class="dbx-b-ox-wrapper">' . "\n";
  echo '<fieldset id="question_fieldsetid" class="dbx-box">' . "\n";
  echo '<div class="dbx-h-andle-wrapper"><h3 class="dbx-handle">' . 
        __( 'А ти задав собі ці 13 запитань?', 'question_textdomain' ) . "</h3></div>";   
   
  echo '<div class="dbx-c-ontent-wrapper"><div class="dbx-content">';

  // output editing form

  question_inner_custom_box();

  // end wrapper

  echo "</div></div></fieldset></div>\n";
}

?>