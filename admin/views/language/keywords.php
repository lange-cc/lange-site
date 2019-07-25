  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<!-- Main content -->
<section class="content">
  
<div class="container" style="padding-left: 17px;padding-right: 52px;">
<div class="row">

<?php
$Defaultlang = $this->ondefaultLang;
$DefaultlangData = json_decode($Defaultlang);
if ($DefaultlangData[0]->keywords != 'none')
{
?>
<div class="col-lg-6 widget widget-one">
   <div class="language-name">
 <span class="fa fa-language"></span> <?=$DefaultlangData[0]->name?> (Default)

 <a href="javascript:void(0)" data-abrev="<?=$this->abrev;?>" data-id="<?=$DefaultlangData[0]->id?>" data-edit="<?=$this->langId?>" class="copy-btn pull-right"><span class="fa fa-copy"></span> Copy</a>
  </div>
<br>

<?php
$data = $DefaultlangData[0]->keywords;
foreach ($data as $key => $value) {
  $numbe = $key;
  $numbe = $numbe + 1; 
?>

<div class="keyword-list">
   <ul>
    <li class="list-number"><?=$numbe?></li>
    <li class="key-name"><span><?=$data[$key]->keyword?></span></li>
    <li class="key"><?=$data[$key]->key?></li>
   </ul>
</div>

<?php
}
?>

</div>
<?php
}
?>


<?php
$Editlang = $this->onEditLang;
$EditlangData = json_decode($Editlang);
?>

<div class="col-lg-6 widget" id="div1">
   <div class="language-name">
 <span class="fa fa-language"></span> <?=$EditlangData[0]->name?> (In editing <span class="fa fa-pencil"></span>)
  </div>
<br>
<div class="onedit-key-list">
<?php
if ($EditlangData[0]->keywords != 'none') 
{
$data = $EditlangData[0]->keywords;
foreach ($data as $key => $value) {
  $numbe = $key;
  $numbe = $numbe + 1; 
?>
<div class="keyword-list keyword-list2 count-list" id="row_<?=$data[$key]->id?>">
  <form class="keywords-list-form" action="" method="post">
    <span class="key-not"></span>
   <ul>
    <li class="list-number"><?=$numbe?></li>
    <li class="key-name key-margin-input"><span><input class="lang-input2" placeholder="Keyword" type="text" value="<?=$data[$key]->keyword?>" name="keyword"></span></li>
    <li class="key key-margin-input"><input class="lang-input2" placeholder="Key" type="text" name="key" value="<?=$data[$key]->key?>"><input  type="hidden" name="id" value="<?=$data[$key]->id?>"></li>
     <li class="key-margin-input"> <input type="submit" class="btn key-btn" value="update"></li>
   </ul>
  </form>

  <a href="javascript:void(0)" data-id="<?=$data[$key]->id;?>" class="delete-key-btn" title="Delete"><span class="fa fa-eraser"></span></a>
</div>

<?php
}
}
else
{
?>
<div class="alert alert-success">No keywords available</div>
<?php
}
?>

</div>

<div class="keyword-list keyword-list2" style="background: linear-gradient(to right, #c3c3c3 , #c4d5f8);">
  <form id="add-keyword-form" action="" method="post">
   <ul>
    <li class="list-number">new</li>
    <li class="key-name key-margin-input"><input class="lang-input" placeholder="Keyword" type="text" name="keyword"></li>
    <li class="key key-margin-input"><input class="lang-input" placeholder="Key" type="text" name="key"> <input type="hidden" name="abrev" value="<?=$this->abrev;?>"><input type="hidden" name="langId" value="<?=$this->langId?>"></li>
    <li class="key-margin-input"> <input type="submit" class="btn key-btn" value="Add"></li>
   </ul>
       </form>
       <div class="notification"></div>
</div>

<br>
</div>




</div>
</div>
  

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>


