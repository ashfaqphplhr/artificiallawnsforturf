<?PHP

// DO NOT EDIT UNLESS YOU KNOW WHAT THE FOLLOWING CODE MEANS
// OR IF YOU HAVE BEEN INSTRUCTED TO DO SO BY OUR SUPPORT STAFF
// .............................................................

if (strnatcmp(phpversion(),'5.2.3') >= 0) {
mysql_select_db($dbname,$db);
mysql_set_charset('utf8',$db) or die ($db_connection_failure);
} else {
mysql_select_db($dbname,$db) or die ($db_connection_failure);
}

?>