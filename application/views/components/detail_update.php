<div class="row bkg-dark-gray pd-b-2 pd-t-1 col-md-8 col-md-offset-2">
    <label>狀態更新：</label>
    <select class="selectpicker" name="status" data-width="100%">
        <option value="0">待處理</option>
        <option value="1">已完成</option>
        <option value="2">待廠商維護中</option>
        <option value="3">待料中</option>
    </select>
</div>
<script type="text/javascript">
    $('option').eq(<?=$status;?>).prop('selected', true).parent().selectpicker('refresh');
    $('.selectpicker').first().change(function(){
        value = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?=base_url('index.php/detail_update');?>",
            data: {uid:"<?=$uid;?>", status: value},
            success: function(response){
                location.reload();
            }
        })
    })
</script>