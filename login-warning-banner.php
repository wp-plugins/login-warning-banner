<?php
/*
Plugin Name: Login Warning Banner
Plugin URI: http://www.cutawaysecurity.com/login-warning-banner/
Description: Adds a Login Warning Banner after the Username and Password fields but before the Login button.
Author: Don C. Weber
Version: 0.2
Author URI: http://www.cutawaysecurity.com/
  
    Copyright 2007  Don C. Weber  

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Hook for adding admin menus 
add_action('admin_menu', 'wb_add_admin');

// Create Option Page
function wb_add_admin(){
   add_options_page('Login Warning Banner', 'Login Warning Banner', 10, login-warning-banner, wb_admin_page);
   $color_array = array("red","white","blue","black","green","orange","yellow");
   add_option('wb_head','Login Warning Banner');
   add_option('wb_head_color', $color_array[0]);
   add_option('wb_mess','Access to this blog is for Authorized Users ONLY.');
   add_option('wb_mess_color', $color_array[0]);
} //END wb_add_admin

// Fill Option Page
function wb_admin_page(){

   // Variables
   $color_array = array("red","white","blue","black","green","orange","yellow");
  
   // Update Options
   if (isset($_POST['submit']) ) {
      update_option('wb_head' ,$_POST['wb_head']);
      update_option('wb_head_color' ,$color_array[$_POST['wb_head_color']]);
      update_option('wb_mess' ,$_POST['wb_mess']);
      update_option('wb_mess_color' ,$color_array[$_POST['wb_mess_color']]);
   }

   $wb_head_txt       = get_option('wb_head');
   $wb_head_color_txt = get_option('wb_head_color');
   $wb_mess_txt       = get_option('wb_mess');
   $wb_mess_color_txt = get_option('wb_mess_color');

   // Start Options Page
   echo '<div class="wrap">';
   echo '<h2>Login Warning Banner</h2>
       <p>
	  This page allows you to choose display options and message text for your login warning banner.
       </p>';

   // Login Warning Banner Resources
   echo '<div class="wrap">
         <h2>Login Warning Banner</h2>
         <p>
            Login Warning Banners are important aspects for system security.  WordPress blogs present a unique challenge as they are designed to provide remote access to multiple users through a publicly accessible authentication mechanism.  By using a pre-authentication Login Warning Banner the blog administrators can be certain that individuals attempting to access the blog have been informed about permissible activities and potential monitoring pertaining to accessing the resource.

             For more information please refer to the following resources.
             <ul>
                <li><a href="http://www.ciac.org/ciac/bulletins/j-043.shtml">CIAC INFORMATION BULLETIN - J-043h: Creating Login Banners</a></li>
                <li><a href="http://www.unixworks.net/papers/wp-007.pdf">Whitepaper [WP-007]: Login Warning Banners</a> by <a href="http://www.unixworks.net/">Bob Radvanovsky</a></li>
             </ul>
         </p></div>';

       // Display Current Banner
       
	echo '<div class="wrap">
              Current Warning Banner:<br><br>
	      <table border="2">
	         <tr bgcolor="silver"><th><strong><font color="';
                 echo $wb_head_color_txt;
                 echo '">';
                 echo $wb_head_txt;
                 echo '</font></strong></th></tr><tr><td><font color="';
                 echo $wb_mess_color_txt;
                 echo '">';
                 echo $wb_mess_txt;
                 echo '</font></td></tr>
              </table>
	   </div>';

   // Create Option Fields
   echo '<div class="wrap">
         <form name="wb_admin" method="post" action="' . $_SERVER[REQUEST_URI] . '">';
         wp_nonce_field('update-options');

   echo '<table border="0"><tr><td>
         Banner Header: <br><input type="text" name="wb_head" value="' . $wb_head_txt . '" /><br></td>
         <td>Banner Header Color: <br><select name="wb_head_color">';
            $wb_counter=0;
            foreach ($color_array as $nc){
               echo '<option ';
               // Test for current color and select it
               if ("$nc"=="$wb_head_color_txt") { echo 'selected '; }
               echo 'value="' . $wb_counter . '">' . $nc . '</option>';
               $wb_counter++;
            }
   echo '</select><br></td></tr>
         <tr><td>Banner Message:<br><textarea name="wb_mess" rows="20" cols="50">' . $wb_mess_txt . '</textarea><br></td>
         <td>Banner Message Color: <br><select name="wb_mess_color">';
            $wb_counter=0;
            foreach ($color_array as $nc){
               echo '<option ';
               // Test for current color and select it
               if ("$nc"=="$wb_mess_color_txt") { echo 'selected '; }
               echo 'value="' . $wb_counter . '">' . $nc . '</option>';
               $wb_counter++;
            }

   echo '</select><br></td></tr>
         <tr><td></td><td align="right"><input type="submit" name="submit" value="Update Options" />
         </td></tr></table>
         </form>
         </div>
	</div>';
  

/* Debugging

   echo '<div class="wrap">---TEST---<br>';
   echo "Header: " . $wb_head_txt . "<br>";
   echo "Head Color: " . $wb_head_color_txt . "<br>";
   echo "Message: " . $wb_mess_txt . "<br>";
   echo "Mess_color: " . $wb_mess_color_txt . "<br><br></div>";
*/

   	return;

} //END wb_add_admin

// Place Warning Banner On Page
function warn_banner(){

   // Variables
   $color_array = array("red","white","blue","black","green","orange","yellow");
   $wb_head_txt       = get_option('wb_head');
   $wb_head_color_txt = get_option('wb_head_color');
   $wb_mess_txt       = get_option('wb_mess');
   $wb_mess_color_txt = get_option('wb_mess_color');

   // Warning Banner Header $wb_head_txt
   // Warning Banner Header Font Color $wb_head_color_txt
   echo '<p><font color="' . $wb_head_color_txt . '"><strong>';
   echo $wb_head_txt;

   echo "</strong></font></p>";

   // Warning Banner Message $wb_mess_txt
   // Warning Banner Message Font Color $wb_mess_color_txt
   echo '<p><font color="' . $wb_mess_color_txt . '">';

   echo $wb_mess_txt . '<br>';

   echo "</font></p>";

/*
   echo "---TEST---<br>";
   echo "Header: " . $wb_head_txt . "<br>";
   echo "Head Color: " . $wb_head_color_txt . "<br>";
   echo "Message: " . $wb_mess_txt . "<br>";
   echo "Mess_color: " . $wb_mess_color_txt . "<br><br>";
*/

}// END warn_banner

// Run Warning Banner Function
add_action('login_form', 'warn_banner');

?>
