<?php
// root path of the shop
$shop_root='/home/buyizy/public_html/';
// limit number of image files to check, set to 10 for testing
$limit=100000;
 
 
include $shop_root . '/config/settings.inc.php';
$pdo = new PDO( 'mysql:host='._DB_SERVER_.';dbname='._DB_NAME_, _DB_USER_, _DB_PASSWD_ );
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$r=$pdo->query('select count(1) cnt from ps_image')->fetch();
echo 'count images database: '.$r['cnt'] . "<Br />";
 
// reset some counters
$cnt_files=0;
$cnt_checked=0;
$cnt_not_found=0;
$cnt_found=0;

for($ii=1; ($ii<=9) && ($cnt_files != $limit); $ii++)
{
	$path=$shop_root.'img/p/'.$ii;
	delImage($path);
	for($jj=0; ($jj<=9) && ($cnt_files != $limit); $jj++)
	{	
		$path=$shop_root.'img/p/'.$ii.'/'.$jj;
		delImage($path);
		for($kk=0; ($kk<=9) && ($cnt_files != $limit); $kk++)
		{
			$path=$shop_root.'img/p/'.$ii.'/'.$jj.'/'.$kk;
			delImage($path);
			for($ll=0; ($ll<=9) && ($cnt_files != $limit); $ll++)
			{
				$path=$shop_root.'img/p/'.$ii.'/'.$jj.'/'.$kk.'/'.$ll;
				delImage($path);
			}	
		}
 	}
 		
}
echo 'files: '.$cnt_files.' checked: '.$cnt_checked.' not_found: '.$cnt_not_found.' found: '.$cnt_found;

function delImage($imageDir)
{
	global $limit, $pdo, $cnt_files, $cnt_checked, $cnt_not_found, $cnt_found;
	if ($handle = @opendir($imageDir)) {			//@ is wriiten to avoid warning message and is handled in else condition
		echo $imageDir."<BR />";
    		while ($cnt_files != $limit && false !== ($entry = readdir($handle))) {
        		if ($entry != "." && $entry != "..") {
                		$cnt_files++;
                		$pi = explode('-',$entry);
                		if($pi[0]>0 && !empty($pi[1])) {
                        		$cnt_checked++;
                        		if(!checkExistsDb($pdo,$pi[0])) {
                                		$cnt_not_found++;
                                		echo 'rm '.$imageDir.'/'.$entry."<BR />";
			        		unlink($imageDir.'/'.$entry);
                        		} else {
                                		$cnt_found++;
                       			}
                		}
        		}
    		}
    			closedir($handle);
	}
	else
	{
		echo $imageDir." doesn't exist".'<BR />';
	}

}
 
function checkExistsDb($pdo, $id_image) {
        $r=$pdo->query($q='select \'ok\' ok, (select id_image from ps_image where id_image = '.(int)$id_image.') id_image');
        $row=$r->fetch();
        if($row['ok']!='ok') die( 'Problem with query, please correct');
        return $row['id_image']?true:false;
}