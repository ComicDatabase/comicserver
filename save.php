<html>
<head>
<?php include_once("analyticstracking.php") ?>
<meta http-equiv="Content-Type" content="text/html; charset=" utf-8" />

</head>
<body>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=utf-8");

$JSON = base64_decode ($_POST["data"]);
//echo $JSON;
$data = json_decode($JSON);
//var_dump( $data->{'comic'});
$mid = $data->{'comic'}->{'id'};
$cid = $data->{'chapter'}->{'cid'};

//if (!file_exists('comic'))
    mkdir ('comic');
//if (!file_exists('comic' . '/' . $mid))
    mkdir ('comic' . '/' . $mid);

if ($mid != '' && $cid != '') //����ַ��գ�
{
    if (file_exists('comic' . '/' . $mid . '/' . $cid . '.tx.list')) {//�����ڣ�
        echo 'exist';
    }
    else{//������
        //дurl�б�
        $f = fopen('comic' . '/' . $mid . '/' . $cid . '.tx.list','w');
        foreach($data->{'picture'} as $pic)
        {
            //echo $pic->{'url'};
            //echo "\n";
            fwrite($f,$pic->{'url'} . "\t" . $pic->{'pid'} . "\n");
        }
        fclose($f);

        //д����
        $listfile = fopen('downtxlist.txt','a');
        fwrite($listfile,$mid . "\t" . $cid . "\n");
        fclose($listfile);

        echo "save!";
    }
}
else
{
    echo "{error:true,message:text not valued}";
}

?>
</body>
</html>
