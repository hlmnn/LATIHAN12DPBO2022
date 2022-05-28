<?php

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");

$pasien = new ProsesPasien();

if (isset($_GET['id_delete']))
{
    $pasien->deleteDataPasien($_GET['id_delete']);
    header('location:index.php');
}

if(isset($_GET['id_add']))
{
    if(isset($_POST['submit']))
    {
        $pasien->addDataPasien($_POST);
        header('location:index.php');
    }
}

if (isset($_GET['id_update']))
{
    $pasien->getDetailPasien($_GET['id_update']);
    $nik = $pasien->getNik(0);
    $nama = $pasien->getNama(0);
    $tempat = $pasien->getTempat(0);
    $tl = $pasien->getTl(0);
    $gender = $pasien->getGender(0); 

    if ($gender == 'Laki-laki') $gender = 'checked';
    else $gender = 'checked';

    $email = $pasien->getEmail(0);
    $notelp = $pasien->getTelp(0);

    if(isset($_POST['submit']))
    {
        $pasien->updateDataPasien($_GET['id_update'], $_POST);
        header('location:index.php');
    }   
}

$tpl = new Template("templates/form.html");
$tpl->replace("DATA_NIK", $nik);
$tpl->replace("DATA_NAMA", $nama);
$tpl->replace("DATA_TEMPAT", $tempat);
$tpl->replace("DATA_TL", $tl);
$tpl->replace("DATA_GENDER", $gender);
$tpl->replace("DATA_EMAIL", $email);
$tpl->replace("DATA_TELP", $notelp);
$tpl->write();
?>