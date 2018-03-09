<div class="row bkg-green pd-t-1 col-md-8 col-md-offset-2 text-center">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
      <label class="btn btn-success active">
        <input type="radio" name="status" id="option2" autocomplete="off" checked> 未修好
      </label>
      <label class="btn btn-success">
        <input type="radio" name="status" id="option1" autocomplete="off"> 已修好
      </label>
      <label class="btn btn-success">
        <input type="radio" name="status" id="option3" autocomplete="off"> 資訊不足
      </label>
    </div>
</div>
<article class="row pd-0 bkg-white col-md-8 col-md-offset-2">
    <div>
        <section class="table-responsive noscrollbar box-shadow pd-0 bd-n">
            <table class="table table-status">
                <thead class="bkg-green">
                    <?php foreach ($columns as $value): ?>
                    <th><?=$value;?></th>
                    <?php endforeach; ?>
                </thead><!--
                --><tbody>
                    <?php foreach ($lists as $data): ?>
                    <tr data-uid="<?=$data['uid']?>" data-status="<?=$data['status']?>">
                        <?php foreach ($columns as $key => $value): ?>
                        <td><?=$data[$key]?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
              </tbody>
            </table>
        </section>
    </div>
    <?=$pagination;?>
    <script type="text/javascript">
        url = "<?=base_url('index.php/request_detail/');?>";
        $('tr[data-status]').each(function(){
            var status_arr = ['bg-danger', 'bg-success', 'bg-primary', 'bg-warning'];
            var x = parseInt($(this).attr('data-status'));
            $(this).addClass(status_arr[x]).click(function(){
                $(location).attr('href',url + $(this).attr('data-uid'));
            })
        })
        $('th, td').addClass('text-center');
    </script>
</article>