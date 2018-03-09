<article class="pd-h-3 text-wrap row bkg-green col-md-8 col-md-offset-2">
    <header>
        <h2>報修單詳情</h2>
    </header>
    <section class="mg-v-2">
        <h4>單號： <span><?=$uid;?></span></h4>
    </section>
    <section class="mg-v-2">
        <h4>位置： <span><?=$place;?></span></h4>
    </section>
    <section class="mg-v-2">
        <h4>申請人： <span><?=$sender;?></span></h4>
    </section>
    <section class="mg-v-2">
        <h4>故障原因： <span><?=$situation;?></span></h4>
    </section>
    <section class="mg-v-2">
        <h4>報修日期： <span><?=$cteate_time;?></span></h4>
    </section>
    <section class="mg-v-2">
        <h4>最後回應日期： <span><?=$last_reply_time;?></span></h4>
    </section>
    <section data-status class="mg-v-2">
        <h3>狀態： <span></span></h3>
    </section>
</article>
<script type="text/javascript">
    switch(<?=$status;?>) {
        <?php foreach ($this->config->item('zh_status') as $key => $value): ?>
            case <?=$key;?>:
                status = "<?=$value;?>";
                break;
        <?php endforeach ?>
    }
    $('section[data-status] span').text(status);
</script>