<form action="deleteChange_Product.php" method="post">
<table>
<tr>

<td><input type="text" name="search_cname" placeholder="Cake Name"/></td>

<td><input type="text" name="search_fromprice" placeholder="Search By Cake Price"/></td>
<!--<td><input type="text" name="search_toprice" placeholder="To"/></td>-->
</tr>



<tr>
<td><input type="text" name="search_category" placeholder="Search By Cake Category"/></td>
</tr>
</table>
<input type="submit" name="Sign" id="Signin" value="Search"/>

<input type="hidden" name="SubmitCheck" value="sent"/>
</form>
<form method="post" action="salesManager.php"><input type="submit" name="Back"  id="Signin" value="Back To Home Page"/>
</form>

</body>
</html>
