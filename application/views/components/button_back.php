<div class="row col-md-8 col-md-offset-2 pd-0">
    <button back class="btn btn-info btn-square btn-block">回上頁</button>
</div>
<script type="text/javascript">
    $('button[back]').click(function(){
        history.length > 1 ? history.back() : $(location).attr('href',"<?=base_url('index.php/request_list');?>");
    })
</script>