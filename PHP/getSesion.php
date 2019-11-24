<?php
session_start();
if($_SESSION["inicio"]==true){
	echo'1';
}else{
	echo'0';
}
?>