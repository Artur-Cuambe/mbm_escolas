<input type="hidden" id="url" value="<?php echo URL; ?>"/>
</div>
<!-- FOOTER -->
<div id="footer">
    <p>&copy;  &nbsp;<?=date('Y')?> &nbsp;</p>
</div>
<!--END FOOTER -->
<!-- GLOBAL SCRIPTS -->
<script src="<?php echo URL; ?>assets/plugins/jquery-2.0.3.min.js"></script>
<script src="<?php echo URL; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<!-- END GLOBAL SCRIPTS -->
<!-- PAGE LEVEL SCRIPTS -->
<script src="<?php echo URL; ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo URL; ?>/assets/js/requisicoes.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
<!-- END BODY -->
</html>