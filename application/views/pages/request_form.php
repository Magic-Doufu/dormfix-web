<header class="row bkg-red pd-v-1 pd-h-3 col-md-8 col-md-offset-2">
    <h2>說明</h2>
    <ol class="font-important">
        <li>以下基本資料必填。</li>
        <li>電腦服務僅檢測偵錯。</li>
		<li>零組件購買與RMA流程可提供協助。</li>
		<li>電腦服務非宿網組業務，宿網組可決定是否受理。</li>
    </ol>
	<ul class="font-important">
		<li>宿舍為減低維修工資花費，採取兩段式維修：</li>
		<li>第一階段維修：由同學組成維修小組實施基礎維修，每周一和周四晚上19時至21時，住宿生如關心維修進度，維修期間請儘量留在寢室。</li>
		<li>第二階段維修：若損壞超出維修小組能力，則請廠商到校維修(本校協力廠商因負責全校修繕工作，必須安排工作優先順序，故會有時間延遲情形，甚而因待料延後維修情形)。</li>
		<li>住宿服務組會以最快的速度，協助同學完成修繕，但維修的完成有一定期程，請同學體諒。</li>
    </ul>
    <h2>注意</h2>
	<ol class="font-important">
		<li>維修資料請填寫詳細以利儘速維修，填寫不正確將造成作業延誤。</li>
		<li>如果要追蹤維修進度，可回本網頁查詢。(預計下周開通此服務)</li>
		<li>住宿服務中心電話：3814526轉3493</li>
		<li>不同的維修項目請分開填寫</li>
		<li><S>維修不填好，好人當到老。</S></li>
	</ol>
</header>
<div class="pd-h-3 pd-t-1 row bkg-red text-white col-md-8 col-md-offset-2">
<form action="request_sent">
    <div class="form-group">
        <label>位置</label>
        <div>
        <select class="selectpicker" placeholder="樓別" name="place[]" data-width="fit" title="選擇樓別">
            <option>弘德樓</option>
            <option>慧樓</option>
            <option>勤業樓</option>
        </select>
        <select class="selectpicker" placeholder="樓層" name="place[]" data-width="fit" title="選擇樓層">
        </select>
        <select class="selectpicker" placeholder="類別" name="place[]" data-width="fit" title="選擇區域別">
            <option>公共區域</option>
            <option>房間內</option>
            <option>網路(含無線)</option>
			<option>電腦</option>
        </select>
        <select class="selectpicker hidden" placeholder="請選擇地點..." name="place[]" data-width="fit" title="選擇故障點">
            <optgroup label="公共區域">
            </optgroup>
            <option>其它</option>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label>故障點/原因</label>
        <textarea class="form-control" name="situation" rows="4" placeholder="如果選擇其它則必填原因"></textarea>
    </div>
    <div class="form-group">
        <label>報修人</label>
        <input type="text" name="sender[]" class="form-control" placeholder="房床號 ex.1105-3">
        <input type="text" name="sender[]" class="form-control" placeholder="姓名">
    </div>
	<script type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="form-group">
		<div class="g-recaptcha" data-sitekey="6Lcwx0oUAAAAAI4My9l3DVwQWulQtvpdQ1uKF5R8"></div>
    </div>
    <div class="form-group" style="text-align: right;">
        <button type="submit" onclick="return check_empty($(this));" class="btn btn-default">送出</button>
        <a class="btn btn-default" href="request_list">返回</a>
    </div>
</form>
</div>
<div class="row col-md-8 col-md-offset-2 pd-0">
    <div space class="hidden bkg-red msg-box">有必填的選項未填</div>
</div>
<script type="text/javascript">
    function check_empty(button) {
		button.addClass('disabled');
        var x = true;
        var roomnum = new RegExp(/[0-9]{4}-[1-4]/);
        var teacher = new RegExp(/[0-9]{5}/);
        $('form .form-control').each(function(){
            if ($(this).val().length < 1) {
                $('div[space]').removeClass('hidden');
                x = false;
				button.removeClass('disabled');
                setTimeout(function(){$('div[space]').addClass('hidden')}, 3000);
            }
        })
        var rnval = $('input[name^="sender"]').eq(0).val();
        if (!(roomnum.test(rnval) || teacher.test(rnval))) {
            $('div[space]').removeClass('hidden');
            x = false;
			button.removeClass('disabled');
            setTimeout(function(){$('div[space]').addClass('hidden')}, 3000);   
        }
		console.log($(this));
        return x;
    }
    $(document).ready(function(){
        $("select[name^='place']").eq(2).change(function(){
            if ($(this).val() == '公共區域') {
                $("select[name^='place']").eq(3).removeClass('hidden').parent().removeClass('hidden').selectpicker('refresh');
            } else {
                $("select[name^='place']").eq(3).val(0).addClass('hidden').selectpicker('refresh');
            }
        })
        $("select[name^='place']").eq(0).change(function(){
            pages = $(this).prop('selectedIndex') - 1;
            $.getJSON('get_building_data/' + pages,function(response) {
                $("select[name^='place']").eq(2).val(0).selectpicker('refresh');
                $(".selectpicker").eq(1).empty().append(function(){
                    var x = '';
                    $.each(response.floors,function(index, value) {
                        x += '<option>' + value + 'F</option>';
                    })
                    return x;
                }).selectpicker('refresh');
                /*$('optgroup').eq(1).empty().append(function(){
                    var x = '';
                    $.each(response.inroom,function(index, value) {
                        x += '<option>' + value + '</option>';
                    })
                    return x;
                });*/
                $('optgroup').eq(0).empty().append(function(){
                    var x = '';
                    $.each(response.publicside,function(index, value) {
                        x += '<option>' + value + '</option>';
                    });
                    return x;
                }).parent().selectpicker('refresh');
            })
        })
    });
</script>