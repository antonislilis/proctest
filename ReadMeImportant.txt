This site was made from Antonis Lilis for a test
It is better to run this with Google Chrome browser.
The demo link is http://procontest.co.nf/


How to make this work
0)Check you are using PHP5. In localhost i used PHP5.4 but on my domain it works only when i use PHP5.5.21
	its because i use OOP and DUST PHP.
	
1)You can create your database. Just import cur_calc.sql to your database. Otherwise this is the table 
Table = currencies
id = Auto increment, primary key, integer
name = varchar(45)
value = double
shortname = varchar(45)
symbol = varchar(10)

2)At first go to config/database.php and define your database variables

3)on config/paths.php insert your root url for example http://yourdomain.com/

4)Go to public/ajax/dispatcher.php and complete in the second line your database type,host,name,username,password
	$pdo = new PDO('type:host=yourhost;dbname=yourdatabasename', 'youruser', 'yourpassword');
	
5)If you have an internal error please check the .htaccess file. Maybe you should delete the / on 
	RewriteRule ^(.+)$ /index.php?url=$1 [QSA,L]  do it like this RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]