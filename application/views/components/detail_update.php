<div class="row bkg-dark-gray pd-b-2 pd-t-1 col-md-8 col-md-offset-2">
    <div>
        <label>目前選擇：</label><span name="uid"></span>
    </div>
    <div>
        <label>故障原因：</label><span name="situation"></span>
    </div>
    <label>狀態更新：</label>
    <select class="selectpicker" disabled name="status" data-width="100%">
        <?php foreach ($this->config->item('zh_status') as $key => $value): ?>
            <option value="<?=$key;?>"><?=$value;?></option> 
        <?php endforeach ?>
    </select>
</div>
<script type="text/javascript">
    $('option').eq($('tr').first().attr('data-status')).prop('selected', true).parent().selectpicker('refresh');
    $('.selectpicker').first().change(function(){
        value = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?=base_url('index.php/detail_update');?>",
            data: {uid:selectuid, status: value},
            success: function(response){
                location.reload();
            }
        })
    })
    $('tr').unbind('click').click(function() {
        $('.selectpicker').removeAttr('disabled');
        var thisele =  $(this)
        selectuid = thisele.attr('data-uid');
        $('span[name="uid"]').text(thisele.attr('data-uid'));
        $('span[name="situation"]').text(thisele.children('td').eq(3).text());
        $('option').eq(thisele.attr('data-status')).prop('selected', true).parent().selectpicker('refresh');
        return false;
    })
</script>