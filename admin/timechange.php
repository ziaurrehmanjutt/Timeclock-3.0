<?php
session_start();

include '../config.inc.php';
include '../timezone.php';
include 'header_date.php';
include 'topmain.php';
echo "<title>$title - Update TimeZone</title>\n";

$self = $_SERVER['PHP_SELF'];
$request = $_SERVER['REQUEST_METHOD'];


if (($timefmt == "G:i") || ($timefmt == "H:i")) {
    $timefmt_24hr = '1';
    $timefmt_24hr_text = '24 hr format';
    $timefmt_size = '5';
} else {
    $timefmt_24hr = '0';
    $timefmt_24hr_text = '12 hr format';
    $timefmt_size = '8';
}

if ((!isset($_SESSION['valid_user'])) && (!isset($_SESSION['time_admin_valid_user']))) {

    echo "<table width=100% border=0 cellpadding=7 cellspacing=1>\n";
    echo "  <tr class=right_main_text><td height=10 align=center valign=top scope=row class=title_underline>PHP Timeclock Administration</td></tr>\n";
    echo "  <tr class=right_main_text>\n";
    echo "    <td align=center valign=top scope=row>\n";
    echo "      <table width=200 border=0 cellpadding=5 cellspacing=0>\n";
    echo "        <tr class=right_main_text><td align=center>You are not presently logged in, or do not have permission to view this page.</td></tr>\n";
    echo "        <tr class=right_main_text><td align=center>Click <a class=admin_headings href='../login.php'><u>here</u></a> to login.</td></tr>\n";
    echo "      </table><br /></td></tr></table>\n";
    exit;
}

if ($request != 'POST') {
    echo "<table width=100% height=89% border=0 cellpadding=0 cellspacing=1>\n";
    echo "  <tr valign=top>\n";
    echo "    <td class=left_main width=180 align=left scope=col>\n";
    echo "      <table class=hide width=100% border=0 cellpadding=1 cellspacing=0>\n";
    echo "        <tr><td class=left_rows height=11></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Users</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user.png' alt='User Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='useradmin.php'>User Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user_add.png' alt='Create New User' />&nbsp;&nbsp;
                <a class=admin_headings href='usercreate.php'>Create New User</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/magnifier.png' alt='User Search' />&nbsp;&nbsp;
                <a class=admin_headings href='usersearch.php'>User Search</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Offices</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick.png' alt='Office Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='officeadmin.php'>Office Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick_add.png' alt='Create New Office' />&nbsp;&nbsp;
                <a class=admin_headings href='officecreate.php'>Create New Office</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Groups</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group.png' alt='Group Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='groupadmin.php'>Group Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group_add.png' alt='Create New Group' />&nbsp;&nbsp;
                <a class=admin_headings href='groupcreate.php'>Create New Group</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>In/Out Status</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application.png' alt='Status Summary' />
                &nbsp;&nbsp;<a class=admin_headings href='statusadmin.php'>Status Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application_add.png' alt='Create Status' />&nbsp;&nbsp;
                <a class=admin_headings href='statuscreate.php'>Create Status</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>Miscellaneous</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/clock.png' alt='Add/Edit/Delete Time' />
                &nbsp;&nbsp;<a class=admin_headings href='timeadmin.php'>Add/Edit/Delete Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_border_top height=18 align=left valign=middle><img src='../images/icons/application_edit.png'
                alt='Edit System Settings' /> &nbsp;&nbsp;<a class=admin_headings href='sysedit.php'>Edit System Settings</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/database_go.png'
                alt='Upgrade Database' />&nbsp;&nbsp;&nbsp;<a class=admin_headings href='dbupgrade.php'>Upgrade Database</a></td></tr>\n";
    echo "      </table></td>\n";



    echo "    <td align=left class=right_main scope=col>\n";
    echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
    echo "        <tr class=right_main_text>\n";
    echo "          <td valign=top>\n";
    echo "            <br />\n";
    echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate()\">\n";
    echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
    echo "              <tr>\n";
    echo "                <th class=rightside_heading nowrap halign=left colspan=3><img src='../images/icons/clock_add.png' />&nbsp;&nbsp;&nbsp;Update Time Zone
                    </th>\n";
    echo "              </tr>\n";
  //  echo "              <tr><td colspan=2 style='font-size: 8px'>Start Date Inclued But End Date will not Include</td></tr>\n";
    echo "            <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Start Date: ($tmp_datefmt)</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'><input type='text'
                      size='10' maxlength='10' name='post_date'>&nbsp;*&nbsp;&nbsp;&nbsp;<a href=\"#\" 
                      onclick=\"form.post_date.value='';cal.select(document.forms['form'].post_date,'post_date_anchor','$js_datefmt'); 
                      return false;\" name=\"post_date_anchor\" id=\"post_date_anchor\" style='font-size:11px;color:#27408b;'>Pick Start Date</a></td><tr>\n";

    echo "            <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>End Date: ($tmp_datefmt)</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'><input type='text'
                      size='10' maxlength='10' name='post_date2'>&nbsp;*&nbsp;&nbsp;&nbsp;<a href=\"#\" 
                      onclick=\"form.post_date2.value='';cal.select(document.forms['form'].post_date2,'post_date_anchor2','$js_datefmt'); 
                      return false;\" name=\"post_date_anchor2\" id=\"post_date_anchor2\" style='font-size:11px;color:#27408b;'>Pick End Date</a></td><tr>\n";

    echo "                <input type='hidden' name='timefmt_24hr' value=\"$timefmt_24hr\">\n";
    echo "                <input type='hidden' name='timefmt_24hr_text' value=\"$timefmt_24hr_text\">\n";
    echo "                <input type='hidden' name='timefmt_size' value=\"$timefmt_size\">\n";



    echo "              <tr><td class=table_rows height=25 width=20% style='padding-left:32px;' nowrap>Status:</td><td colspan=2 width=80%
                      style='color:red;font-family:Tahoma;font-size:10px;padding-left:20px;'>
                      <select name='time_to_change'>\n";
    echo "                        <option value ='1'>Add 1 Hour</option>\n";
    echo "                        <option value ='2'>Add 2 Hours</option>\n";
    echo "                        <option value ='3'>Add 3 Hours</option>\n";
    echo "                        <option value ='4'>Add 4 Hours</option>\n";
    echo "                        <option value ='5'>Add 5 Hours</option>\n";
    echo "                        <option value ='6'>Add 6 Hours</option>\n";
    echo "                        <option value ='7'>Add 7 Hours</option>\n";
    echo "                        <option value ='8'>Add 8 Hours</option>\n";
    echo "                        <option value ='9'>Add 9 Hours</option>\n";
    echo "                        <option value ='10'>Add 10 Hours</option>\n";
    echo "                        <option value ='11'>Add 11 Hours</option>\n";
    echo "                        <option value ='12'>Add 12 Hours</option>\n";
    echo "                        <option value ='-1'>Subtract 1 Hour</option>\n";
    echo "                        <option value ='-2'>Subtract 2 Hours</option>\n";
    echo "                        <option value ='-3'>Subtract 3 Hours</option>\n";
    echo "                        <option value ='-4'>Subtract 4 Hours</option>\n";
    echo "                        <option value ='-5'>Subtract 5 Hours</option>\n";
    echo "                        <option value ='-6'>Subtract 6 Hours</option>\n";
    echo "                        <option value ='-7'>Subtract 7 Hours</option>\n";
    echo "                        <option value ='-8'>Subtract 8 Hours</option>\n";
    echo "                        <option value ='-9'>Subtract 9 Hours</option>\n";
    echo "                        <option value ='-10'>Subtract 10 Hours</option>\n";
    echo "                        <option value ='-11'>Subtract 11 Hours</option>\n";
    echo "                        <option value ='-12'>Subtract 12 Hours</option>\n";


    echo "                      </select>&nbsp;*</td></tr>\n";
    echo "              <tr><td class=table_rows align=right colspan=3 style='color:red;font-family:Tahoma;font-size:10px;'>*&nbsp;required&nbsp;</td></tr>\n";
    echo "            </table>\n";
    echo "            <div style=\"position:absolute;visibility:hidden;background-color:#ffffff;layer-background-color:#ffffff;\" id=\"mydiv\"
                 height=200>&nbsp;</div>\n";
    echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
    echo "              <tr><td height=40>&nbsp;</td></tr>\n";
    echo "              <tr><td width=30><input type='image' name='submit' value='Update TimeZone' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timechange.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
    include '../footer.php';
    exit;
}
if ($request == 'POST') {




    echo "<table width=100% height=89% border=0 cellpadding=0 cellspacing=1>\n";
    echo "  <tr valign=top>\n";
    echo "    <td class=left_main width=180 align=left scope=col>\n";
    echo "      <table class=hide width=100% border=0 cellpadding=1 cellspacing=0>\n";
    echo "        <tr><td class=left_rows height=11></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Users</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user.png' alt='User Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='useradmin.php'>User Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/user_add.png' alt='Create New User' />&nbsp;&nbsp;
                <a class=admin_headings href='usercreate.php'>Create New User</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/magnifier.png' alt='User Search' />&nbsp;&nbsp;
                <a class=admin_headings href='usersearch.php'>User Search</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Offices</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick.png' alt='Office Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='officeadmin.php'>Office Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/brick_add.png' alt='Create New Office' />&nbsp;&nbsp;
                <a class=admin_headings href='officecreate.php'>Create New Office</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle>Groups</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group.png' alt='Group Summary' />&nbsp;&nbsp;
                <a class=admin_headings href='groupadmin.php'>Group Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/group_add.png' alt='Create New Group' />&nbsp;&nbsp;
                <a class=admin_headings href='groupcreate.php'>Create New Group</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>In/Out Status</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application.png' alt='Status Summary' />
                &nbsp;&nbsp;<a class=admin_headings href='statusadmin.php'>Status Summary</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/application_add.png' alt='Create Status' />&nbsp;&nbsp;
                <a class=admin_headings href='statuscreate.php'>Create Status</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=33></td></tr>\n";
    echo "        <tr><td class=left_rows_headings height=18 valign=middle colspan=2>Miscellaneous</td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/clock.png' alt='Add/Edit/Delete Time' />
                &nbsp;&nbsp;<a class=admin_headings href='timeadmin.php'>Add/Edit/Delete Time</a></td></tr>\n";
    echo "        <tr><td class=left_rows_border_top height=18 align=left valign=middle><img src='../images/icons/application_edit.png'
                alt='Edit System Settings' /> &nbsp;&nbsp;<a class=admin_headings href='sysedit.php'>Edit System Settings</a></td></tr>\n";
    echo "        <tr><td class=left_rows height=18 align=left valign=middle><img src='../images/icons/database_go.png'
                alt='Upgrade Database' />&nbsp;&nbsp;&nbsp;<a class=admin_headings href='dbupgrade.php'>Upgrade Database</a></td></tr>\n";
    echo "      </table></td>\n";
    echo "    <td align=left class=right_main scope=col>\n";
    echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
    echo "        <tr class=right_main_text>\n";
    echo "          <td valign=top>\n";
    echo "            <br />\n";


    $post_date = $_POST['post_date'];
    $post_date2 = $_POST['post_date2'];
    $time_to_change = $_POST['time_to_change'];





    if (preg_match("/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.](([0-9]{2})|([0-9]{4}))$/i", $post_date2, $date_regs)) {
        if ($calendar_style == "amer") {
            if (isset($date_regs)) {
                $month2 = $date_regs[1];
                $day2 = $date_regs[2];
                $year2 = $date_regs[3];
            }
            if ($month2 > 12 || $day2 > 31) {
                $evil_date = '1';
                if (!isset($evil_post)) {
                    echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                    echo "              <tr>\n";
                    echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
                    echo "            </table>\n";
                }
            }
        } elseif ($calendar_style == "euro") {
            if (isset($date_regs)) {
                $month2 = $date_regs[2];
                $day2 = $date_regs[1];
                $year2 = $date_regs[3];
            }
            if ($month2 > 12 || $day2 > 31) {
                $evil_date = '1';
                if (!isset($evil_post)) {
                    echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                    echo "              <tr>\n";
                    echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
                    echo "            </table>\n";
                }
            }
        }
    } else {
        echo "Something is fishy here.\n";
        exit;
    }

    if (preg_match("/^([0-9]{1,2})[\-\/\.]([0-9]{1,2})[\-\/\.](([0-9]{2})|([0-9]{4}))$/i", $post_date, $date_regs)) {
        if ($calendar_style == "amer") {
            if (isset($date_regs)) {
                $month = $date_regs[1];
                $day = $date_regs[2];
                $year = $date_regs[3];
            }
            if ($month > 12 || $day > 31) {
                $evil_date = '1';
                if (!isset($evil_post)) {
                    echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                    echo "              <tr>\n";
                    echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
                    echo "            </table>\n";
                }
            }
        } elseif ($calendar_style == "euro") {
            if (isset($date_regs)) {
                $month = $date_regs[2];
                $day = $date_regs[1];
                $year = $date_regs[3];
            }
            if ($month > 12 || $day > 31) {
                $evil_date = '1';
                if (!isset($evil_post)) {
                    echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
                    echo "              <tr>\n";
                    echo "                <td class=table_rows width=20 align=center><img src='../images/icons/cancel.png' /></td><td class=table_rows_red>
                    A valid Date is required.</td></tr>\n";
                    echo "            </table>\n";
                }
            }
        }
    } else {
        echo "Something is fishy here.\n";
        exit;
    }

    $theDate    = new DateTime($year . '-' . $month . '-' . $day);
    $timeStart = strtotime($theDate->format('Y-m-d H:i:s'));
    $theDate2    = new DateTime($year2 . '-' . $month2 . '-' . $day2);
    $theDate2->modify('+1 day');
    $endStart = strtotime($theDate2->format('Y-m-d H:i:s'));




    if (($time_to_change > 12) || ($time_to_change < -12)) {
        echo "Something is fishy here.\n";
        exit;
    }


    if ((isset($evil_post)) || (isset($evil_date)) || (isset($evil_time))) {
        echo "            <br />\n";
        echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate()\">\n";
        echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";

        echo "              <tr><td width=30><input type='image' name='submit' value='Update TimeZone' align='middle'
                      src='../images/buttons/next_button.png'></td><td><a href='timechange.php'><img src='../images/buttons/cancel_button.png'
                      border='0'></td></tr></table></form></td></tr>\n";
        include '../footer.php';
        exit;
    } else {

        if($time_to_change > 0){
            $query = "UPDATE " . $db_prefix . "`info` set `timestamp`= `timestamp` + " . ($time_to_change * 3600) . " WHERE `timestamp` > " . $timeStart . " and `timestamp` < " . $endStart;
            $result = mysqli_query($db, $query);
        }else if($time_to_change < 0){
            $time_to_change = $time_to_change * (-1);
            $query = "UPDATE " . $db_prefix . "`info` set `timestamp`= `timestamp` - " . ($time_to_change * 3600) . " WHERE `timestamp` > " . $timeStart . " and `timestamp` < " . $endStart;
            $result = mysqli_query($db, $query);
        }else{
            $result = 0;
        }

        


        echo "            <table align=center class=table_border width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr>\n";
        echo "              <td class=table_rows width=20 align=center><img src='../images/icons/accept.png' /></td><td class=table_rows_green>
                  &nbsp;Time Updated successfully.</td></tr>\n";
        echo "            </table>\n";
        echo "            <br />\n";
        echo "            <form name='form' action='$self' method='post' onsubmit=\"return isDate();\">\n";
        echo "            <table align=center class=table_border width=60% border=0 cellpadding=3 cellspacing=0>\n";
        echo "              <tr>\n";
        echo "                <th class=rightside_heading nowrap halign=left colspan=3><img src='../images/icons/clock_add.png' />&nbsp;&nbsp;&nbsp;Update TimeZone
                    </th>\n";
        echo "              </tr>\n";

        echo "            </table>\n";
        echo "            <table align=center width=60% border=0 cellpadding=0 cellspacing=3>\n";
        echo "              <tr><td height=20 align=left>&nbsp;</td></tr>\n";
        echo "              <tr><td><a href='timechange.php'><img src='../images/buttons/done_button.png' border='0'></td></tr></table></td></tr>\n";
        include '../footer.php';
        exit;
    }
}
