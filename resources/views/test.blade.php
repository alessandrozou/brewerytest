
<div>

{{ $par1 ?? 'ciao' }}

<?php if(isset($par1)) {
    echo $par1;
} else {
    var_dump($par1);
}

?>

</div>