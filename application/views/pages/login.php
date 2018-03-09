<div class="bg-primary row col-md-8 col-md-offset-2">
    <div class="pd-3 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
    <form action="<?=base_url('index.php/manage/login');?>" method="post">
        <div class="form-group">
            <label>帳號</label>
            <input type="text" name="account" autocapitalize="off" autocorrect="off" class="form-control" placeholder="僅限管理員">
        </div>
        <div class="form-group">
            <label>密碼</label>
            <input type="password" name="passwd" class="form-control" placeholder="密碼">
        </div>
		<script type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
		<div class="form-group">
			<div class="g-recaptcha" data-sitekey="6Lcwx0oUAAAAAI4My9l3DVwQWulQtvpdQ1uKF5R8"></div>
		</div>
        <div class="mg-t-3">
            <button type="submit" data-login class="btn btn-primary btn-lg btn-block btn-square">登入</button>
        </div>
    </form>
    </div>
</div>