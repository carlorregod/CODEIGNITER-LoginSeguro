<input type="hidden" name="url_base" value="<?=base_url()?>">
<!-- Un segundo token interno para una mejor autenticación --!>
<input type="hidden" name="_token_" id="_token_" value="<?php md5(time());?>">
<!--Scripts js-->
<script type="text/javascript" src="<?=base_url()?>assetts/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assetts/js/popper.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assetts/js/ajax.js"></script>
<script type="text/javascript" src="<?=base_url()?>assetts/js/registrologin.js"></script>
</body>
</html>